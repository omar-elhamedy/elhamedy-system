<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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

class Products extends BaseController
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
    private $productMeta;

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
        $this->productMeta = new ProductMetaModel();

    }

    public function index()
    {
        //
    }

    public function createProduct()
    {
        $data = [
            'name' => $this->generateProductUID(
                $this->request->getPost('material'),
                $this->request->getPost('brand'),
                $this->request->getPost('type'),
                $this->request->getPost('unit'),
                $this->request->getPost('color'),
                $this->request->getPost('size-collection')
            ),
            'price_calc_method' => $this->request->getPost('product_price_calc'),
            'material_id' => $this->request->getPost('material'),
            'brand_id' => $this->request->getPost('brand'),
            'type_id' => $this->request->getPost('type'),
            'unit_id' => $this->request->getPost('unit'),
            'color_id' => $this->request->getPost('color'),
            'size_collection_id' => $this->request->getPost('size-collection'),
            'storage_id' => $this->request->getPost('storage')

        ];

        $msg = 'تم انشاء المنتج بنجاح';
        $this->productMeta->db->transStart();
        $result = $this->productMeta->insert($data);
        $this->productMeta->db->transComplete();
        if ($result === false) {
            return redirect()
                ->back()
                ->with('errors', $this->productMeta->errors())
                ->with('warning', 'خطأ بالبيانات');
        } else {

                $this->updateProducts($this->productMeta->getInsertID());
                return redirect()->back()
                    ->with('info', $msg);

        }

    }

    private function generateProductID($material, $brand, $type, $unit, $color, $sizeCollection, $storage): string
    {
        $uid = "$material$brand$type$unit$color$sizeCollection$storage";
        return $uid;
    }

    private function generateProductUID($material, $brand, $type, $unit, $color, $sizeCollection): string
    {
        $material = $this->materialsModel->find($material)->name;
        $brand = $this->brandsModel->find($brand)->name;
        $type = $this->typesModel->find($type)->name;
        $unit = $this->unitModel->find($unit)->name;
        if ($color === '1'){
            $color = 'ابيض و اسود';
        } else if ($color === '0'){
            $color = 'جميع الالوان';
        } else {
            $color = 'لا يوجد لون';
        }

        $sizeCollection = $this->sizeCollection->find($sizeCollection)->name;



        $uid = "$material-$brand-$type-$unit-$color-$sizeCollection";

        return $uid;
    }

    private function updateProducts($meta_id)
    {

    $productMeta = $this->productMeta->find($meta_id);

    //If no product already generated start from scratch
    if (!$this->ProductModel->MetaModelExist($productMeta->id)){
        //dd($this->getSizeList($productMeta->size_collection_id));
        $noSize = empty($this->getSizeList($productMeta->size_collection_id));
        if ($noSize){
            switch ($productMeta->color_id){
                case 1:
                    //dd($this->colorModel->getWhiteAndBlack());
                    foreach ($this->colorModel->getWhiteAndBlack() as $color){
                        $this->ProductModel->insert([
                            'name' => $this->generateName($productMeta->material_id, $productMeta->brand_id, null, $color,$productMeta->type_id),
                            'uid' => $this->generateProductID($productMeta->material_id, $productMeta->brand_id, $productMeta->type_id, $productMeta->unit_id, $color,0, $productMeta->storage_id),
                            'color_id' => $color,
                            'type_id' => $productMeta->type_id,
                            'material_id' => $productMeta->material_id,
                            'size_id' => null,
                            'brand_id' => $productMeta->brand_id,
                            'unit_id' => $productMeta->unit_id,
                            'meta_id' => $productMeta->id,
                            'storage_id' => $productMeta->storage_id,
                            'QTY' => 0
                        ]);
                    }
                    break;
                case 0:
                    foreach ($this->colorModel->getAllColors() as $color){
                        $this->ProductModel->insert([
                            'name' => $this->generateName($productMeta->material_id, $productMeta->brand_id, null, $color->id,$productMeta->type_id),
                            'color_id' => $color->id,
                            'uid' => $this->generateProductID($productMeta->material_id, $productMeta->brand_id, $productMeta->type_id, $productMeta->unit_id, $color,0, $productMeta->storage_id),
                            'type_id' => $productMeta->type_id,
                            'material_id' => $productMeta->material_id,
                            'size_id' => null,
                            'brand_id' => $productMeta->brand_id,
                            'unit_id' => $productMeta->unit_id,
                            'meta_id' => $productMeta->id,
                            'storage_id' => $productMeta->storage_id,
                            'QTY' => 0
                        ]);
                    }
                    break;
                case 2:
                    $this->ProductModel->insert([
                        'name' => $this->generateName($productMeta->material_id, $productMeta->brand_id, null, null,$productMeta->type_id),
                        'color_id' => null,
                        'uid' => $this->generateProductID($productMeta->material_id, $productMeta->brand_id, $productMeta->type_id, $productMeta->unit_id, $color,0, $productMeta->storage_id),
                        'type_id' => $productMeta->type_id,
                        'material_id' => $productMeta->material_id,
                        'size_id' => null,
                        'brand_id' => $productMeta->brand_id,
                        'unit_id' => $productMeta->unit_id,
                        'meta_id' => $productMeta->id,
                        'storage_id' => $productMeta->storage_id,
                        'QTY' => 0
                    ]);
                    break;
            }
        }
        foreach ($this->getSizeList($productMeta->size_collection_id) as $size) {
            switch ($productMeta->color_id){
                case 1:
                    //dd($this->colorModel->getWhiteAndBlack());
                    foreach ($this->colorModel->getWhiteAndBlack() as $color){
                        $this->ProductModel->insert([
                            'name' => $this->generateName($productMeta->material_id, $productMeta->brand_id, $size, $color,$productMeta->type_id),
                            'color_id' => $color,
                            'uid' => $this->generateProductID($productMeta->material_id, $productMeta->brand_id, $productMeta->type_id, $productMeta->unit_id, $color,$size, $productMeta->storage_id),
                            'type_id' => $productMeta->type_id,
                            'material_id' => $productMeta->material_id,
                            'size_id' => $size,
                            'brand_id' => $productMeta->brand_id,
                            'unit_id' => $productMeta->unit_id,
                            'meta_id' => $productMeta->id,
                            'storage_id' => $productMeta->storage_id,
                            'QTY' => 0
                        ]);
                    }
                    break;
                case 0:
                    foreach ($this->colorModel->getAllColors() as $color){
                        $this->ProductModel->insert([
                            'name' => $this->generateName($productMeta->material_id, $productMeta->brand_id, $size, $color->id,$productMeta->type_id),
                            'color_id' => $color->id,
                            'type_id' => $productMeta->type_id,
                            'uid' => $this->generateProductID($productMeta->material_id, $productMeta->brand_id, $productMeta->type_id, $productMeta->unit_id, $color,$size, $productMeta->storage_id),
                            'material_id' => $productMeta->material_id,
                            'size_id' => $size,
                            'brand_id' => $productMeta->brand_id,
                            'unit_id' => $productMeta->unit_id,
                            'meta_id' => $productMeta->id,
                            'storage_id' => $productMeta->storage_id,
                            'QTY' => 0
                        ]);
                    }
                    break;
                case 2:
                    $this->ProductModel->insert([
                        'name' => $this->generateName($productMeta->material_id, $productMeta->brand_id, $size, null,$productMeta->type_id),
                        'color_id' => null,
                        'type_id' => $productMeta->type_id,
                        'uid' => $this->generateProductID($productMeta->material_id, $productMeta->brand_id, $productMeta->type_id, $productMeta->unit_id, 0,$size, $productMeta->storage_id),
                        'material_id' => $productMeta->material_id,
                        'size_id' => $size,
                        'brand_id' => $productMeta->brand_id,
                        'unit_id' => $productMeta->unit_id,
                        'meta_id' => $productMeta->id,
                        'storage_id' => $productMeta->storage_id,
                        'QTY' => 0
                    ]);
                    break;
            }
        }

    }


    if ($productMeta->color_id === '1'){
        $color = 'ابيض و اسود';
    } else if ($productMeta->color_id === '0'){
        $color = 'جميع الالوان';
    } else {
        $color = 'لا يوجد لون';
    }
       $productEntryModel = new ProductModel();

    }

    private function generateName($material, $brand, $size, $color, $type): string
    {
        $material = $this->materialsModel->find($material)->name;
        $brand = $this->brandsModel->find($brand)->name;
        $type = $this->typesModel->find($type)->name;

        if ($size === null){
            if ($color === null){
                return "$material $brand $type";
            }
            $color = $this->colorModel->find($color)->name;
            return "$material $brand $color $type";
        }
        $size = $this->sizesModel->find($size)->name;
        if ($color === null){
            return "$material $brand $size $type";
        }
        $color = $this->colorModel->find($color)->name;
        return "$material $brand $size $color $type";
    }

    private function getSizeList($size_collection_id): array
    {
        if (json_decode($this->sizeCollection->find($size_collection_id)->sizes) === null){
            return [];
        }
        return json_decode($this->sizeCollection->find($size_collection_id)->sizes);
    }


}
