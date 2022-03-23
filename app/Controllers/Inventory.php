<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentMethodModel;
use App\Models\ProductBrandModel;
use App\Models\ProductColorModel;
use App\Models\ProductMaterialModel;
use App\Models\ProductMetaModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\ProductTypeModel;
use App\Models\ProductUnitModel;
use App\Models\SizeCollectionModel;
use App\Models\StorageModel;

class Inventory extends BaseController
{
    private $ProductModel;
    private $materialsModel;
    private $brandsModel;
    private $sizesModel;
    private $typesModel;
    private $colorModel;
    private $unitModel;
    private $ProductMeta;
    private $storage;
    private $sizeCollection;
    private $paymentMethod;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->materialsModel = new ProductMaterialModel();
        $this->brandsModel = new ProductBrandModel();
        $this->sizesModel = new ProductSizeModel();
        $this->typesModel = new ProductTypeModel();
        $this->colorModel = new ProductColorModel();
        $this->unitModel = new ProductUnitModel();
        $this->ProductMeta = new ProductMetaModel();
        $this->storage = new storageModel();
        $this->sizeCollection = new sizeCollectionModel();
        $this->paymentMethod = new PaymentMethodModel();
    }

    public function index()
    {
        $model = new ProductMetaModel();

        return view("Inventory/index", [
            'products' => $model->findAll()
        ]);
    }

    public function update($id)
    {
        $model = new ProductMetaModel();
        $results = $model->update($id, [
            'unit_id' => $this->request->getPost('unit'),
            'storage_id' => $this->request->getPost('storage'),
            'price_calc_method' => $this->request->getPost('product_price_calc')
        ]);
        if (!$results){
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'لم يتم تعديل المنتج');
        } else {
            $updateNames = $model->updateNameOf($id);
            $update = $this->ProductModel->updateUnitAndStorage($id);

            if ($update && $updateNames){
                return redirect()
                    ->back()
                    ->with('info', 'تم تعديل المنتجات بنجاح');

            } else {
                return redirect()
                    ->back()
                    ->with('errors', $model->errors())
                    ->with('warning', 'خطأ بتعديل البيانات');
            }

        }
    }

    public function edit($id)
    {
        $model = new ProductMetaModel();
        return view('Inventory/edit', [
            'item' => $model->find($id),
            'materials' => $this->materialsModel->findAll(),
            'brands' => $this->brandsModel->findAll(),
            'sizes' => $this->sizeCollection->findAll(),
            'types' => $this->typesModel->findAll(),
            'units' => $this->unitModel->findAll(),
            'storages' => $this->storage->findAll()
        ]);
    }

    public function delete($id)
    {
        $model = new ProductMetaModel();
        $results = $model->delete($id);
        if (!$results){
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'لم يتم حذف المنتج');
        } else {
            return redirect()
                ->to('/inv')
                ->with('info', 'تم حذف المنتجات بنجاح');

        }
    }

    public function suppliers()
    {
        return view("Inventory/suppliers");
    }
}
