<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentMethodModel;
use App\Models\PaymentMethodRecordsModel;

class Accounts extends BaseController
{
    public function __construct()
    {
        helper([
            'form',
            'date',
            'size',
            'storage',
            'material',
            'type',
            'unit',
            'brand',
            'color',
            'meta',
            'client',
            'bookmark'
        ]);

    }

    public function index($id)
    {
        $model = new PaymentMethodModel();
        return view('Accounts/index', [
            'account' => $model->find($id)
        ]);
    }

    public function add($id)
    {
        $model = new PaymentMethodRecordsModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'amount' => $this->request->getPost('amount'),
            'payment_method' => $id
        ];
       $result = $model->insert($data);
       if (!$result){
           return redirect()
               ->back()
               ->with('errors', $model->errors())
               ->with('warning', 'لم يتم تسجيل الايداع');
       } else {
           return redirect()
               ->back()
               ->with('info', 'تم تسجيل الايداع');
       }
    }

    public function withdraw($id)
    {
        $model = new PaymentMethodRecordsModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'withdraw' => $this->request->getPost('amount'),
            'payment_method' => $id
        ];
        $result = $model->insert($data);
        if (!$result){
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'لم يتم تسجيل الايداع');
        } else {
            return redirect()
                ->back()
                ->with('info', 'تم تسجيل السحب');
        }
    }
}
