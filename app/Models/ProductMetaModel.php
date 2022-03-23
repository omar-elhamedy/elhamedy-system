<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductMetaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_meta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ProductMetaEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'color_id',
        'type_id',
        'material_id',
        'size_collection_id',
        'brand_id',
        'unit_id',
        'storage_id',
        'price_calc_method'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_product_meta';
    protected $updatedField  = 'updated_at_product_meta';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[product_meta.name]'
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'يجب ادخال جميع البيانات',
            'is_unique' => 'هذا النوع مسجل من قبل'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getProductsNumberByStorage($storage_id)
    {
        return count($this->where('storage_id', $storage_id)->asArray()->findAll());
    }


    public function createNewColorProduct($newColor): bool
    {
        $productModel = new ProductModel();
        foreach ($this->getProductsWithAllColors() as $product){
            $noSize = empty($this->getSizeList($product->size_collection_id));
            if ($noSize){
                $productModel->insert([
                    'name' => getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getColorName($newColor) . ' ' . getTypeName($product->type_id),
                    'color_id' => $newColor,
                    'type_id' => $product->type_id,
                    'material_id' => $product->material_id,
                    'size_id' => null,
                    'brand_id' => $product->brand_id,
                    'unit_id' => $product->unit_id,
                    'meta_id' => $product->id,
                    'storage_id' => $product->storage_id,

                    'QTY' => 0
                ]);
            } else {
                foreach ($this->getSizeList($product->size_collection_id) as $size){
                    $productModel->insert([
                        'name' => getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName($newColor) . ' ' . getTypeName($product->type_id),
                        'color_id' => $newColor,
                        'type_id' => $product->type_id,
                        'material_id' => $product->material_id,
                        'size_id' => $size,
                        'brand_id' => $product->brand_id,
                        'unit_id' => $product->unit_id,
                        'meta_id' => $product->id,
                        'storage_id' => $product->storage_id,
                        'QTY' => 0
                    ]);
                }
            }

        }
        return true;
    }
    private function getSizeList($size_collection_id): array
    {
        $sizeCollectionModel = new SizeCollectionModel();
        if (json_decode($sizeCollectionModel->find($size_collection_id)->sizes) === null){
            return [];
        }
        return json_decode($sizeCollectionModel->find($size_collection_id)->sizes);
    }

    private function getProductsWithAllColors()
    {
        return $this->where('color_id', '0')->findAll();
    }

    public function updatedSizeCollectionRefresh($id)
    {
        foreach ($this->where('size_collection_id', $id)->findAll() as $product){
                $productModel = new ProductModel();
                $colorModel = new ProductColorModel();

                    foreach ($this->getSizeList($product->size_collection_id) as $size){
                        switch ($product->color_id){
                            case 0:
                                foreach ($colorModel->getAllColors() as $color) {
                                    $name = getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName($color->id) . ' ' . getTypeName($product->type_id);
                                    if ($productModel->productExist($name)){
                                        continue;
                                    }else{
                                        $productModel->insert([
                                            'name' => getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName($color->id) . ' ' . getTypeName($product->type_id),
                                            'color_id' => $color->id,
                                            'type_id' => $product->type_id,
                                            'material_id' => $product->material_id,
                                            'size_id' => $size,
                                            'brand_id' => $product->brand_id,
                                            'unit_id' => $product->unit_id,
                                            'meta_id' => $product->id,
                                            'storage_id' => $product->storage_id,
                                            'QTY' => 0
                                        ]);
                                    }

                                }
                                break;

                            case 1:
                                foreach ($colorModel->getWhiteAndBlack() as $color){
                                    $name = getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName($color->id) . ' ' . getTypeName($product->type_id);
                                    if ($productModel->productExist($name)){
                                        continue;
                                    }else{
                                        $productModel->insert([
                                            'name' => getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName($color->id) . ' ' . getTypeName($product->type_id),
                                            'color_id' => $color->id,
                                            'type_id' => $product->type_id,
                                            'material_id' => $product->material_id,
                                            'size_id' => $size,
                                            'brand_id' => $product->brand_id,
                                            'unit_id' => $product->unit_id,
                                            'meta_id' => $product->id,
                                            'storage_id' => $product->storage_id,
                                            'QTY' => 0
                                        ]);
                                    }

                                }
                                break;
                            case 2:
                                $name = getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName(null) . ' ' . getTypeName($product->type_id);
                                if ($productModel->productExist($name)){
                                    break;
                                }else{
                                    $productModel->insert([
                                        'name' => getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($size) . ' ' . getColorName(null) . ' ' . getTypeName($product->type_id),
                                        'color_id' => null,
                                        'type_id' => $product->type_id,
                                        'material_id' => $product->material_id,
                                        'size_id' => $size,
                                        'brand_id' => $product->brand_id,
                                        'unit_id' => $product->unit_id,
                                        'meta_id' => $product->id,
                                        'storage_id' => $product->storage_id,
                                        'QTY' => 0
                                    ]);
                                }

                        }
                    }



        }
        $this->cleanProducts($id);
        return true;
    }

    public function generateNames($product)
    {
        $material = getMaterialName($product->material_id);
        $brand = getBrandName($product->brand_id);
        $type = getTypeName($product->type_id);
        $unit = getUnitName($product->unit_id);

        if ($product->color_id === '1'){
            $color = 'ابيض و اسود';
        } else if ($product->color_id === '0'){
            $color = 'جميع الالوان';
        } else {
            $color = 'لا يوجد لون';
        }
        $sizeModel = new \App\Models\SizeCollectionModel();
        $sizeCollection = $sizeModel->find($product->size_collection_id)->name;


        return "$material-$brand-$type-$unit-$color-$sizeCollection";
    }
    public function updateNameOf($id): bool
    {

        $name = $this->generateNames($this->find($id));

        $this->update($id, [
            'name' => $name
        ]);

        return true;
    }

    private function cleanProducts($id)
    {

        // get all products with this size collection
        // group products by size
        // check if size is in the collection
        // remove product if not
        $productModel = new ProductModel();
        foreach ($this->where('size_collection_id', $id)->findAll() as $product){

            $productModel = new ProductModel();
            foreach ($productModel->where('meta_id', $product->id)->groupBy('size_id')->findAll() as $item){
                if (in_array($item->size_id, $this->getSizeList($id))){
                    continue;
                }else{
                    foreach ($productModel->where('size_id', $item->size_id)->findAll() as $itemToDelete){
                        $productModel->delete($itemToDelete->id);
                    }
                }
            }



        }
    }
}
