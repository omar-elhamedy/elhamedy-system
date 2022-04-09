<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\ClientRecordsModel;
use App\Models\PaymentMethodModel;
use App\Models\PaymentMethodRecordsModel;

class Client extends BaseController
{
    public function index()
    {

        $model = new ClientRecordsModel();
        $clientModel = new ClientModel();
        $paymentMethods = new PaymentMethodModel();
        $clients = $model->getAllClients();
        //dd($clients);
        //dd($clientModel->getTotal());
        return view("Client/index",
        [
            'clients' => $clients,
            'total' => $clientModel->getTotal(),
            'paymentMethods' => $paymentMethods->findAll()
        ]
        );
    }

    public function new()
    {
        return view("Client/new");
    }

    public function addClient()
    {
        $clientModel = new ClientModel();
        $result = $clientModel->insert([
            'name' =>  $this->request->getPost("client_name"),
            'phone_number' => $this->request->getPost("phone_number")
        ]);
        if ($result === false){
            return redirect()->to('/clients')->with('errors', $clientModel->errors());
        }else{
            return redirect()->back()->with('info', 'تم تسجيل العميل بنجاح');
            //dd($model->getInsertID());
        }
    }

    public function edit($clientID)
    {
        $model = new ClientModel();
        return view('Client/edit', [
            'client' => $model->find($clientID)
        ]);
    }

    public function update($clientID)
    {
        $model = new ClientModel();
       $result = $model->update($clientID, [
            'name' => $this->request->getPost("client_name"),
            'phone_number' => $this->request->getPost("phone_number")
        ]);
        if ($result === false) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $model->errors())
                ->with('warning', 'خطأ بالبيانات');

        } else {
            return redirect()->back()->with('info', 'تم تعديل بيانات المورد بنجاح');
        }
    }

    public function show($id)
    {
        $clientModel = new ClientModel();
        $client = $clientModel->find($id);
        $clientRecords = new ClientRecordsModel();
        $data = $clientRecords->getClientHistory($id);
        if ($this->request->getGet('date') != null){
            $data = $clientRecords->getClientHistoryByDate($id,$this->request->getGet('date') );
        }
       // dd($data);
        return view("Client/show", [
            'client' => $client,
            'amount' => $client->amount,
            'data' => $data,
            'pager' => $clientRecords->pager,
            'date' => $this->request->getGet('date')
        ]);
    }

    public function getClientByName()
    {
        $clientModel = new ClientModel();
        $clientId = $clientModel->getUserId($this->request->getPost("client_name_2"));
        if ($clientId === null){
            return redirect()->back()->with('errors', 'العميل غير مسجل');
        }
        return redirect()->to('/clients/' . $clientId);
    }

    public function create()
    {
        $clientModel = new ClientModel();

        $clientId = $clientModel->getUserId($this->request->getPost("client_name"));
        if ($clientId === null){
            return redirect()->back()->with('errors', 'العميل غير مسجل');
        }
        $model = new ClientRecordsModel();

        $result = $model->insert([
                'client_id' => $clientId,
                'amount_due' => $this->request->getPost("amount_due")
        ]);

        if ($result === false){
            return redirect()->to('/clients')->with('errors', $model->errors());
        }else{
           $clientModel->update($clientId, [
               'amount' => $this->request->getPost("amount_due") + $clientModel->getAmount($clientId)
           ]);
           return redirect()->back()->with('info', 'تم التسجيل بنجاح');
           //dd($model->getInsertID());
        }

    }

    public function paid()
    {
        $clientModel = new ClientModel();

        $clientId = $clientModel->getUserId($this->request->getPost("client_name_pay"));
        $model = new ClientRecordsModel();

        $result = $model->insert([
            'client_id' => $clientId,
            'amount_paid' => $this->request->getPost("amount_paid"),
            'payment_method_id' => $this->request->getPost('payment_method')
        ]);
        $paymentMethodRecordModel = new PaymentMethodRecordsModel();
        $paymentMethodRecordModel->insert([
            'payment_method' => $this->request->getPost('payment_method'),
            'amount' => $this->request->getPost("amount_paid"),
            'client_id' => $clientId
        ]);

        if ($result === false){
            return redirect()->to('/clients')->with('errors', $model->errors());
        }else{
            $clientModel->update($clientId, [
                'amount' => $clientModel->getAmount($clientId) - $this->request->getPost("amount_paid")
            ]);
            return redirect()->to('/clients');
            //dd($model->getInsertID());
        }
    }

    public function search()
    {
        $model = new ClientModel();
        $customers = $model->search($this->request->getGet('q'));
        return $this->response->setJSON($customers);
    }
}
