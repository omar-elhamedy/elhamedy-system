<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductMetaModel;
use App\Models\ProductModel;
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

    public function update()
    {
        $productModel = new ProductModel();

        foreach ($this->request->getPost() as $key=>$values){
            if ($key != 'type'){
                $update = $productModel->update($key, [
                    'price' => $values
                ]);
                return $this->redirect($update, $productModel);
            } else {
                if ($key === 'type'){
                    foreach ($values as $type =>$value){

                        if (isset($value['sizes'])){
                            foreach ($value['sizes'] as $size => $price){
                                $update = $productModel->updateAllWithTypeAndSize($price,$type,$size);
                                return $this->redirect($update, $productModel);
                            }

                        } elseif (isset($value['colors'])){
                            foreach ($value['colors'] as $color => $price){
                                $update =  $productModel->updateAllWithTypeAndColor($price, $type, $color);

                                return $this->redirect($update, $productModel);
                            }
                        }
                    }
                } elseif ($key === 'sizes'){
                    foreach ($values as $size => $price){
                        $update = $productModel->updateAllWithSize($price, $size);
                        return $this->redirect($update, $productModel);
                    }
                } elseif ($key === 'colors'){
                    foreach ($values as $color => $price){
                        $update =  $productModel->updateAllWithColor($price, $color);
                        return $this->redirect($update, $productModel);
                    }
                }
            }

            return redirect()
                ->back()
                ->with('info', 'تم تحديث الاسعار');

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

    public function redirect(bool $update, ProductModel $productModel): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$update) {
            return redirect()
                ->back()
                ->with('error', $productModel->errors())
                ->with('warning', 'خطأ بالتحديث');
        } else {
            return redirect()
                ->back()
                ->with('info', 'تم تحديث الاسعار');
        }
    }
}
