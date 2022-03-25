<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductMetaModel;
use App\Models\ProductModel;
use App\Models\SupplierModel;
use App\Models\SupplierProductModel;
use App\Models\SupplierRecordsItemsModel;
use App\Models\SupplierRecordsModel;

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

    public function submitSupply($supplierID)
    {
        $recordsModel = new SupplierRecordsModel();
        // insert record
        $recordsModel->insert([
            'supplier_id' => $supplierID,
            'notes' => $this->request->getPost('notes')
        ]);

        $recordProductsModel = new SupplierRecordsItemsModel();
        //insert records items
        // add qty to item in inventory
        $productModel = new ProductModel();
        foreach ($this->request->getPost('products') as $key => $value){
            $recordProductsModel->insert([
                'record_id' => $recordsModel->getInsertID(),
                'product_id' => $key,
                'QTY' => $value['qty'],
                'price' => $value['price']
            ]);
            $productModel->update($key, [
                'price' => $value['price']
            ]);
            $productModel->addQTY($key, $value['qty']);
        }

        session()->remove('cart-' . $supplierID);

        return redirect()->to('suppliers/' . $supplierID)->with('info', 'تم تسجيل الفاتورة بنجاح');


    }

    public function removeItemFromCart($id, $session)
    {
        $supplierID = ltrim($session, 'cart-');

        $sessionID = $session;
        $session = session()->get($session);
        $key = array_search($id, $session);
        if (false !== $key) {
            unset($session[$key]);
        }
        session()->set($sessionID, $session);
        return redirect()->to('suppliers/' . $supplierID . '/supply-items');
        // get a copy of current cart
        // remove $id
        // save to session new cart

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
        if ($result === false) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $supplierModel->errors())
                ->with('warning', 'خطأ بالبيانات');

        } else {
            foreach ($this->request->getPost('products') as $product) {
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

        foreach ($this->request->getPost() as $key => $values) {
            if ($key != 'type') {
                $update = $productModel->update($key, [
                    'price' => $values
                ]);
                if (!$update) {
                    return redirect()
                        ->back()
                        ->with('error', $productModel->errors())
                        ->with('warning', 'خطأ بالتحديث');
                }
            } elseif ($key === 'type') {
                foreach ($values as $type => $value) {

                    if (isset($value['sizes'])) {
                        foreach ($value['sizes'] as $size => $price) {
                            $update = $productModel->updateAllWithTypeAndSize($price, $type, $size);
                            if (!$update) {
                                return redirect()
                                    ->back()
                                    ->with('error', $productModel->errors())
                                    ->with('warning', 'خطأ بالتحديث');
                            }
                        }

                    } elseif (isset($value['colors'])) {
                        foreach ($value['colors'] as $color => $price) {
                            $update = $productModel->updateAllWithTypeAndColor($price, $type, $color);

                            if (!$update) {
                                return redirect()
                                    ->back()
                                    ->with('error', $productModel->errors())
                                    ->with('warning', 'خطأ بالتحديث');
                            }
                        }
                    }
                }
            } elseif ($key === 'sizes') {
                foreach ($values as $size => $price) {
                    $update = $productModel->updateAllWithSize($price, $size);
                    if (!$update) {
                        return redirect()
                            ->back()
                            ->with('error', $productModel->errors())
                            ->with('warning', 'خطأ بالتحديث');
                    }
                }
            } elseif ($key === 'colors') {
                foreach ($values as $color => $price) {
                    $update = $productModel->updateAllWithColor($price, $color);
                    if (!$update) {
                        return redirect()
                            ->back()
                            ->with('error', $productModel->errors())
                            ->with('warning', 'خطأ بالتحديث');
                    }
                }
            }
        }

        return redirect()
            ->back()
            ->with('info', 'تم تحديث الاسعار');


    }

    public function newSupply($supplierID)
    {
        $model = new SupplierModel();
        $SupplierProductsModel = new SupplierProductModel();
        return view('Supplier/new-supply', [
            'supplier' => $model->find($supplierID),
            'products' => $SupplierProductsModel->getProductsForSupplierId($supplierID)
        ]);
    }

    public function addCart()
    {
        session()->set('cart-' . $this->request->getPost('supplier-id'), $this->request->getPost('products'));
       return redirect()->to('suppliers/' . $this->request->getPost('supplier-id') . '/supply-items');
    }

    public function view($supplierID)
    {
        $model = new SupplierModel();
        $SupplierProductsModel = new SupplierProductModel();
       // dd($SupplierProductsModel->getProductsForSupplierId($supplierID));

        return view('/Supplier/view', [
            'supplier' => $model->find($supplierID),
            'products' => $SupplierProductsModel->getProductsForSupplierId($supplierID),

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
