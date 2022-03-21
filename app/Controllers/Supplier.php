<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductMetaModel;
use App\Models\SupplierModel;
use App\Models\SupplierProductModel;

class Supplier extends BaseController
{
    public function index()
    {
        return view('Supplier/index');
    }

    public function new()
    {
        $products = new ProductMetaModel();
        return view('Supplier/new', [
            'products' => $products->findAll()
        ]);
    }

    public function add()
    {
        $supplierModel = new SupplierModel();
        $supplier_ProductModel = new SupplierProductModel();
        $supplierData = [
            'name' => $this->request->getPost('supplier_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'bank_account' => $this->request->getPost('bank_account')
        ];
        $result = $supplierModel->insert($supplierData);
        if ($result === false){
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $supplierModel->errors())
                ->with('warning', 'خطأ بالبيانات');

        } else {
            foreach ($this->request->getPost('products') as $product){
                $relationData = [
                    'supplier_id' => $supplierModel->getInsertID(),
                    'product_id' => $product
                ];
                $result = $supplier_ProductModel->insert($relationData);
                if ($result === false) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', $supplierModel->errors())
                        ->with('warning', 'خطأ بالبيانات');
                }
            }
            return redirect()->back()->with('info', 'تم تسجيل المرد بنجاح');

        }

    }

    public function view($supplierID)
    {
        $model = new SupplierModel();
        $SupplierProductsModel = new SupplierProductModel();
       // dd($SupplierProductsModel->getProductsForSupplierId($supplierID));

        return view('/Supplier/view', [
            'supplier' => $model->find($supplierID),
            'products' => $SupplierProductsModel->getProductsForSupplierId($supplierID)
        ]);
    }
    public function supply()
    {
        $model = new SupplierModel();
        $supplierID = $model->getSupplierId($this->request->getPost('supplier_name_add'));
        return redirect()->to('/suppliers/' . $supplierID);

    }

    public function search()
    {
        $model = new SupplierModel();
        $customers = $model->search($this->request->getGet('q'));
        return $this->response->setJSON($customers);
    }
}
