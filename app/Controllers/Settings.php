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
            'btnText' => '?????? ??????',
            'title' => '?????? ????????'
        ]);
    }

    public function material()
    {
        $model = $this->materialsModel->findAll();
        return view('Settings/product/material', [
            'data' => $model,
            'type' => 'material',
            'btnText' => '?????? ????????',
            'title' => '???????? ??????????'
        ]);
    }

    public function size()
    {
        $model = $this->sizesModel->findAll();
        return view('Settings/product/size', [
            'data' => $model,
            'type' => 'size',
            'btnText' => '?????? ????????????',
            'title' => '???????? ????????'
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
            'btnText' => '?????? ????????????',
            'title' => '???????????? ??????????'
        ]);
    }

    public function brand()
    {
        $model = $this->brandsModel->findAll();
        return view('Settings/product/brand', [
            'data' => $model,
            'type' => 'brand',
            'btnText' => '?????? ??????????????',
            'title' => '?????????? ??????????'
        ]);
    }
    public function unit()
    {
        $model = $this->unitModel->findAll();
        return view('Settings/product/unit', [
            'data' => $model,
            'type' => 'unit',
            'btnText' => '?????? ????????????',
            'title' => '???????? ???????????? ??????????'
        ]);
    }

    public function storage()
    {
        $model = $this->storage->findAll();
        return view('Settings/product/storage', [
            'data' => $model,
            'type' => 'storage',
            'btnText' => '?????? ????????',
            'title' => '???????? ????????'
        ]);
    }
    public function createStorage()
    {
        $result = $this->insert($this->storage);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->storage->errors())
                ->with('warning', '?????? ??????????????????');
        } else {

            return redirect()->back()
                ->with('info', '???? ?????????? ????????????');
        }
    }
    public function removeStorage($id)
    {
        return $this->remove($this->storage, $id, '???? ?????? ????????????');
    }

    public function removeSizeCollection($id)
    {
        return $this->remove($this->sizeCollection, $id, '???? ?????? ????????????????');
    }

    public function updateStorage($id)
    {
        return $this->update($this->storage, $id ,'???? ?????????? ????????????');
    }

    public function editSizeCollection($id)
    {
        $model = $this->sizeCollection->find($id);
        $Availablesizes = $this->sizesModel->findAll();
        return view('Settings/product/size-collection-edit', [
            'data' => $model,
            'type' => 'size-collection',
            'Availablesizes' => $Availablesizes,
            'btnText' => '??????????',
            'title' => '?????????? ????????????????'
        ]);
    }
    
    public function updateSizeCollection($id)
    {
        $productMetaModel = new ProductMetaModel();
        $result = $this->sizeCollection->update($id, [
            'name' => $this->request->getPost('name'),
            'sizes' => json_encode($this->request->getPost('sizes'))
        ]);
        $msg = '???? ?????????? ????????????????';

        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $this->sizeCollection->errors())
                ->with('warning', '?????? ??????????????????');
        } else {
            if ($productMetaModel->updatedSizeCollectionRefresh($id)){
                return redirect()->back()
                    ->with('info', $msg);
            } else {
                return redirect()
                    ->back()
                    ->with('errors', $this->sizeCollection->errors())
                    ->with('warning', '?????? ??????????????????');
            }


        }
    }

    public function addSizeCollection()
    {

        $result = $this->sizeCollection->insert([
            'name' => $this->request->getPost("name"),
            'sizes' => json_encode($this->request->getPost('sizes'))
        ]);

        $msg = '???? ?????????? ????????????????';
        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $this->sizeCollection->errors())
                ->with('warning', '?????? ??????????????????');
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
            'btnText' => '??????????',
            'title' => '?????????? ????????'
        ]);
    }

    public function type()
    {
        $model = $this->typesModel->findAll();
        return view('Settings/product/type', [
            'data' => $model,
            'type' => 'type',
            'btnText' => '?????? ??????????',
            'title' => '?????? ????????'
        ]);
    }

    public function addColor()
    {
        $result = $this->insert($this->colorModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->colorModel->errors())
                ->with('warning', '?????? ??????????????????');
        } else {
            $new = $this->ProductMeta->createNewColorProduct($this->colorModel->getInsertID());
            if ($new){
                return redirect()->back()
                    ->with('info', '???? ?????????? ??????????');
            }

        }

    }

    public function removeColor($id)
    {
        return $this->remove($this->colorModel, $id, '???? ?????? ??????????');
    }

    public function addMaterial()
    {
        $result = $this->insert($this->materialsModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->materialsModel->errors())
                ->with('warning', '?????? ??????????????????');
        } else {

            return redirect()->back()
                ->with('info',  '???? ?????????? ????????????');
        }
    }

    public function editColor($id)
    {
        $model = $this->colorModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'color',
            'btnText' => '??????????',
            'title' => '?????????? ??????????'
        ]);
    }

    public function updateColor($id)
    {
        return $this->update($this->colorModel, $id ,'???? ?????????? ??????????');
    }

    public function removeMaterial($id)
    {
        $result = $this->materialsModel->delete($id);
        if ($result === false){
            return redirect()
                ->back()
                ->with('errors', $this->materialsModel->errors())
                ->with('warning', '?????? ??????????????????');
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
            'btnText' => '??????????',
            'title' => '?????????? ????????'
        ]);
    }

    public function updateMaterial($id)
    {
        return $this->update($this->materialsModel, $id ,'???? ?????????? ????????????');
    }

    public function addType()
    {
        $result = $this->insert($this->typesModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->typesModel->errors())
                ->with('warning', '?????? ??????????????????');
        } else {

            return redirect()->back()
                ->with('info', '???? ?????????? ??????????');
        }
    }

    public function removeType($id)
    {
        return $this->remove($this->typesModel, $id, '???? ?????? ??????????');
    }

    public function editType($id)
    {
        $model = $this->typesModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'type',
            'btnText' => '??????????',
            'title' => '?????????? ??????'
        ]);
    }

    public function updateType($id)
    {
        return $this->update($this->typesModel, $id ,'???? ?????????? ??????????');
    }

    public function addBrand()
    {

        $result = $this->insert($this->brandsModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->brandsModel->errors())
                ->with('warning', '?????? ??????????????????');
        } else {

            return redirect()->back()
                ->with('info', '???? ?????????? ??????????????');
        }
    }

    public function removeBrand($id)
    {

        return $this->remove($this->brandsModel, $id, '???? ?????? ??????????????');
    }

    public function editBrand($id)
    {
        $model = $this->brandsModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'brand',
            'btnText' => '??????????',
            'title' => '?????????? ??????????????'
        ]);
    }

    public function updateBrand($id)
    {
        return $this->update($this->brandsModel, $id ,'???? ?????????? ??????????????');
    }

    public function addSize()
    {
        $result = $this->insert($this->sizesModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->sizesModel->errors())
                ->with('warning', '?????? ??????????????????');
        } else {

            return redirect()->back()
                ->with('info', '???? ?????????? ????????????');
        }
    }

    public function removeSize($id)
    {
        return $this->remove($this->sizesModel, $id, '???? ?????? ????????????');
    }

    public function editSize($id)
    {
        $model = $this->sizesModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'size',
            'btnText' => '??????????',
            'title' => '?????????? ????????????'
        ]);
    }

    public function updateSize($id)
    {
        return $this->update($this->sizesModel, $id ,'???? ?????????? ????????????');
    }

    public function addUnit()
    {
        $msg = '???? ?????????? ????????????';
        $result = $this->insert($this->unitModel);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->unitModel->errors())
                ->with('warning', '?????? ??????????????????');
        } else {

            return redirect()->back()
                ->with('info', $msg);
        }

    }

    public function removeUnit($id)
    {
        return $this->remove($this->unitModel, $id, '???? ?????? ????????????');
    }

    public function editUnit($id)
    {
        $model = $this->unitModel->find($id);
        return view('Settings/product/edit', [
            'data' => $model,
            'type' => 'unit',
            'btnText' => '??????????',
            'title' => '?????????? ???????????? ????????????????'
        ]);
    }

    public function updateUnit($id)
    {
        return $this->update($this->unitModel, $id, '???? ?????????? ???????????? ????????????????');
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
                ->with('warning', '?????? ??????????????????');
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
                ->with('warning', '?????? ??????????????????');
        } else {
           $update = $this->ProductModel->updateAllNames();
           if ($update){
               return redirect()->back()
                   ->with('info', $msg);
           } else {
               return redirect()
                   ->back()
                   ->with('errors', $model->errors())
                   ->with('warning', '?????? ???????????? ??????????????????');
           }

        }

    }

    public function addPayment()
    {
        $msg = '???? ?????????? ??????????';
        $result = $this->insert($this->paymentMethod);
        if ($result == false) {
            return redirect()
                ->back()
                ->with('errors', $this->paymentMethod->errors())
                ->with('warning', '?????? ??????????????????');
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
            'btnText' => '??????????',
            'title' => '?????????? ???? ?????????? ??????????'
        ]);
    }

    public function removePayment($id)
    {
        return $this->remove($this->paymentMethod, $id, '???? ?????????? ??????????');
    }

    public function updatePayment($id)
    {
        return $this->update($this->paymentMethod, $id, '???? ?????????? ?????????? ??????????');
    }

    public function payment()
    {
        $model = $this->paymentMethod->findAll();
        return view('Settings/payment', [
            'data' => $model,
            'type' => 'payment',
            'btnText' => '?????? ?????????? ??????????',
            'title' => '?????????? ?????? ??????????'
        ]);
    }


}
