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

class Settings extends BaseController
{

    /**
     * @var ProductModel
     */
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

    public function index()
    {
        return view("Settings/index");
    }

    public function product()
    {
        return view('Settings/product/index');
    }

    public function newProduct()
    {
        return view('Settings/product/new',
        [
            'materials' => $this->materialsModel->findAll(),
            'brands' => $this->brandsModel->findAll(),
            'sizes' => $this->sizeCollection->findAll(),
            'types' => $this->typesModel->findAll(),
            'units' => $this->unitModel->findAll(),
            'storages' => $this->storage->findAll()
        ]);
    }



    public function color()
    {
        $model = $this->colorModel->findAll();
        return view('Settings/product/color', [
            'data' => $model,
            'type' => 'color',
            'btnText' => 'اضف لون',
            'title' => 'لون جديد'
        ]);
    }

    public function material()
    {
        $model = $this->materialsModel->findAll();
        return view('Settings/product/material', [
            'data' => $model,
            'type' => 'material',
            'btnText' => 'اضف خامة',
            'title' => 'خامة جديدة'
        ]);
    }

    public function size()
    {
        $model = $this->sizesModel->findAll();
        return view('Settings/product/size', [
            'data' => $model,
            'type' => 'size',
            'btnText' => 'اضف المقاس',
            'title' => 'مقاس جديد'
        ]);
    }

    public function sizeCollection()
    {
        $model = $this->sizeCollection->findAll();
        $Availablesizes = $this->sizesModel->findAll();
        return view('Settings/product/size-collection', [
            'data' => $model,
            'Availablesizes' => $Availablesizes,
            'type' => 'size-collection',
            'btnText' => 'اضف مجموعة',
            'title' => 'مجموعة جديدة'
        ]);
    }

    public function brand()
    {
        $model = $this->brandsModel->findAll();
        return view('Settings/product/brand', [
            'data' => $model,
            'type' => 'brand',
            'btnText' => 'اضف الماركة',
            'title' => 'ماركة جديدة'
        ]);
    }
    public function unit()
    {
        $model = $this->unitModel->findAll();
        return view('Settings/product/unit', [
            'data' => $model,
            'type' => 'unit',
            'btnText' => 'اضف الوحدة',
            'title' => 'وحدة مخزنية جديدة'
        ]);
    }

    public function storage()
    {
        $model = $this->storage->findAll();
        return view('Settings/product/storage', [
            'data' => $model,
            'type' => 'storage',
            'btnText' => 'اضف مخزن',
            'title' => 'مخزن جديد'
        ]);
    }
    public function createStorage()
    {
        $result = $this->insert($this->storage);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->storage->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info', 'تم اضافة المخزن');
        }
    }
    public function removeStorage($id)
    {
        return $this->remove($this->storage, $id, 'تم حذف المخزن');
    }

    public function removeSizeCollection($id)
    {
        return $this->remove($this->sizeCollection, $id, 'تم حذف المجموعة');
    }

    public function updateStorage($id)
    {
        return $this->update($this->storage, $id ,'تم تعديل المخزن');
    }

    public function editSizeCollection($id)
    {
        $model = $this->sizeCollection->find($id);
        $Availablesizes = $this->sizesModel->findAll();
        return view('Settings/product/size-collection-edit', [
            'data' => $model,
            'type' => 'size-collection',
            'Availablesizes' => $Availablesizes,
            'btnText' => 'تعديل',
            'title' => 'تعديل المجموعة'
        ]);
    }
    
    public function updateSizeCollection($id)
    {
        $productMetaModel = new ProductMetaModel();
        $result = $this->sizeCollection->update($id, [
            'name' => $this->request->getPost('name'),
            'sizes' => json_encode($this->request->getPost('sizes'))
        ]);
        $msg = 'تم تعديل المجموعة';

        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $this->sizeCollection->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {
            if ($productMetaModel->updatedSizeCollectionRefresh($id)){
                return redirect()->back()
                    ->with('info', $msg);
            } else {
                return redirect()
                    ->back()
                    ->with('errors', $this->sizeCollection->errors())
                    ->with('warning', 'خطأ بالبيانات');
            }


        }
    }

    public function addSizeCollection()
    {

        $result = $this->sizeCollection->insert([
            'name' => $this->request->getPost("name"),
            'sizes' => json_encode($this->request->getPost('sizes'))
        ]);

        $msg = 'تم اضافة المجموعة';
        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $this->sizeCollection->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {
            return redirect()->back()
                ->with('info', $msg);
        }
    }

    public function editStorage($id)
    {
        $model = $this->storage->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'storage',
            'btnText' => 'تعديل',
            'title' => 'تعديل مخزن'
        ]);
    }

    public function type()
    {
        $model = $this->typesModel->findAll();
        return view('Settings/product/type', [
            'data' => $model,
            'type' => 'type',
            'btnText' => 'اضف النوع',
            'title' => 'نوع جديد'
        ]);
    }

    public function addColor()
    {
        $result = $this->insert($this->colorModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->colorModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {
            $new = $this->ProductMeta->createNewColorProduct($this->colorModel->getInsertID());
            if ($new){
                return redirect()->back()
                    ->with('info', 'تم اضافة اللون');
            }

        }

    }

    public function removeColor($id)
    {
        return $this->remove($this->colorModel, $id, 'تم حذف اللون');
    }

    public function addMaterial()
    {
        $result = $this->insert($this->materialsModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->materialsModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info',  'تم اضافة الخامة');
        }
    }

    public function editColor($id)
    {
        $model = $this->colorModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'color',
            'btnText' => 'تعديل',
            'title' => 'تعديل اللون'
        ]);
    }

    public function updateColor($id)
    {
        return $this->update($this->colorModel, $id ,'تم تعديل اللون');
    }

    public function removeMaterial($id)
    {
        $result = $this->materialsModel->delete($id);
        if ($result === false){
            return redirect()
                ->back()
                ->with('errors', $this->materialsModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        }else{
            return redirect()->back();
            }
    }

    public function editMaterial($id)
    {
        $model = $this->materialsModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'material',
            'btnText' => 'تعديل',
            'title' => 'تعديل خامة'
        ]);
    }

    public function updateMaterial($id)
    {
        return $this->update($this->materialsModel, $id ,'تم تعديل الخامة');
    }

    public function addType()
    {
        $result = $this->insert($this->typesModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->typesModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info', 'تم اضافة النوع');
        }
    }

    public function removeType($id)
    {
        return $this->remove($this->typesModel, $id, 'تم حذف النوع');
    }

    public function editType($id)
    {
        $model = $this->typesModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'type',
            'btnText' => 'تعديل',
            'title' => 'تعديل نوع'
        ]);
    }

    public function updateType($id)
    {
        return $this->update($this->typesModel, $id ,'تم تعديل النوع');
    }

    public function addBrand()
    {

        $result = $this->insert($this->brandsModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->brandsModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info', 'تم اضافة الماركة');
        }
    }

    public function removeBrand($id)
    {

        return $this->remove($this->brandsModel, $id, 'تم حذف الماركة');
    }

    public function editBrand($id)
    {
        $model = $this->brandsModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'brand',
            'btnText' => 'تعديل',
            'title' => 'تعديل الماركة'
        ]);
    }

    public function updateBrand($id)
    {
        return $this->update($this->brandsModel, $id ,'تم تعديل الماركة');
    }

    public function addSize()
    {
        $result = $this->insert($this->sizesModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->sizesModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info', 'تم اضافة المقاس');
        }
    }

    public function removeSize($id)
    {
        return $this->remove($this->sizesModel, $id, 'تم حذف المقاس');
    }

    public function editSize($id)
    {
        $model = $this->sizesModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'size',
            'btnText' => 'تعديل',
            'title' => 'تعديل المقاس'
        ]);
    }

    public function updateSize($id)
    {
        return $this->update($this->sizesModel, $id ,'تم تعديل المقاس');
    }

    public function addUnit()
    {
        $msg = 'تم اضافة الوحدة';
        $result = $this->insert($this->unitModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->unitModel->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info', $msg);
        }

    }

    public function removeUnit($id)
    {
        return $this->remove($this->unitModel, $id, 'تم حذف الوحدة');
    }

    public function editUnit($id)
    {
        $model = $this->unitModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'unit',
            'btnText' => 'تعديل',
            'title' => 'تعديل الوحدة المخزنية'
        ]);
    }

    public function updateUnit($id)
    {
        return $this->update($this->unitModel, $id, 'تم تعديل الوحدة المخزنية');
    }


    public function insert($model)
    {
        return $model->save([
            'name' => $this->request->getPost("name"),
        ]);
    }

    public function remove($model, $id, $msg): \CodeIgniter\HTTP\RedirectResponse
    {
        $result = $model->delete($id);
        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {
            return redirect()->back()->with('info', $msg);
        }
    }

    public function update($model, $id, $msg)
    {
        $result = $model->update($id, [
            'name' => $this->request->getPost('name')
        ]);

        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {
           $update = $this->ProductModel->updateAllNames();
           if ($update){
               return redirect()->back()
                   ->with('info', $msg);
           } else {
               return redirect()
                   ->back()
                   ->with('errors', $model->errors())
                   ->with('warning', 'خطأ بتحديث بالبيانات');
           }

        }

    }

    public function addPayment()
    {
        $msg = 'تم وسيلة الدفع';
        $result = $this->insert($this->paymentMethod);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->paymentMethod->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

            return redirect()->back()
                ->with('info', $msg);
        }

    }

    public function editPayment($id)
    {
        $model = $this->paymentMethod->find($id);
        return view('Settings/editPayment', [
            'data' => $model,
            'type' => 'payment',
            'btnText' => 'تعديل',
            'title' => 'تعديل تم وسيلة الدفع'
        ]);
    }

    public function removePayment($id)
    {
        return $this->remove($this->paymentMethod, $id, 'تم وسيلة الدفع');
    }

    public function updatePayment($id)
    {
        return $this->update($this->paymentMethod, $id, 'تم تعديل وسيلة الدفع');
    }

    public function payment()
    {
        $model = $this->paymentMethod->findAll();
        return view('Settings/payment', [
            'data' => $model,
            'type' => 'payment',
            'btnText' => 'اضف وسيلة الدفع',
            'title' => 'وسيلة دفع جديدة'
        ]);
    }


}
