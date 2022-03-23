<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ProductEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'color_id',
        'type_id',
        'material_id',
        'size_id',
        'brand_id',
        'unit_id',
        'meta_id',
        'QTY',
        'storage_id',
        'created_at_product',
        'updated_at_product',
        'price'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_product';
    protected $updatedField  = 'updated_at_product';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function MetaModelExist($metaID): bool
    {
        if ($this->where('meta_id', $metaID)->first() === null){
            return false;
        }else{
            return true;
        }

    }

    public function getAllMetaProductsByColor($metaID)
    {
        return $this->where('meta_id', $metaID)->groupBy('color_id')->findAll();
    }

    public function getAllMetaProductsBySize($metaID)
    {
        return $this->where('meta_id', $metaID)->groupBy('size_id')->findAll();
    }

    public function getAllMetaProductsCount($metaID)
    {
        return $this->where('meta_id', $metaID)->countAllResults();
    }

    public function getAllProductsInStorage($storageId)
    {
        return $this->where('storage_id',$storageId)->findAll();
    }

    public function getAllProductsWithQTY($storageId)
    {
        return $this->where('storage_id',$storageId)->where('QTY >', '0')->findAll();
    }

    public function getCountOfProductInStorage($storageId)
    {
        return $this->where('storage_id', $storageId)->where('QTY >', '0')->countAllResults();
    }

    public function getActualCountOfProductInStorage($storageId)
    {

        return $this->where('storage_id', $storageId)->selectSum('QTY', 'SUM')->get()->getRow()->SUM;
    }

    public function paginateAllProductsInStorage($storageId)
    {
        return $this->where('storage_id', $storageId)->where('QTY >', 0)->paginate();
    }

    public function sortBy($storageId, mixed $getGet)
    {
        return $this->where('storage_id', $storageId)->orderBy($getGet, 'DESC')->paginate();
    }

    public function filterThese(array $requestedFilters, $storageId)
    {
        $query = [];
        foreach ($requestedFilters as $key => $value){
            $query[]= " `$key`='$value' ";
        }
        $query = "FROM `product` WHERE `storage_id` = '$storageId' AND " . implode('AND', $query);
        //dd($query);
        return $this->db->query("SELECT * " . $query)->getResult();
    }

    public function updateAllNames(): bool
    {
        // $material $brand $size $color $type
        foreach ($this->findAll() as $product){

            $this->update($product->id, [
                'name' => getMaterialName($product->material_id) . ' ' . getBrandName($product->brand_id) . ' ' . getSizeName($product->size_id) . ' ' . getColorName($product->color_id) . ' ' . getTypeName($product->type_id)
            ]);
        }
        return true;
    }

    public function productExist(string $name)
    {
        if ($this->where('name', $name)->first() !== null){
            return true;
        }
        return false;
    }

    public function getMetaProductsWithQTYCount($metaID)
    {
        return $this->where('meta_id', $metaID)->where('QTY >', '0')->countAllResults();
    }

    public function updateUnitAndStorage($id): bool
    {
        $items = $this->where('meta_id', $id)->findAll();
        $productMetaModel = new ProductMetaModel();
        $productMetaModel->find($id);
        foreach ($items as $item){
            $this->update($item->id, [
                'name' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($productMetaModel->find($id)->type_id),
               'unit_id ' => $productMetaModel->find($id)->unit_id,
               'storage_id' => $productMetaModel->find($id)->storage_id
            ]);
        }

        return true;
    }

    public function getAllMetaProducts($metaID)
    {
        return $this->where('meta_id', $metaID)->findAll();
    }

    public function updateAllWithTypeAndSize(string $price, int|string $type, int|string $size)
    {
        foreach ($this->where('type_id', $type)->where('size_id', $size)->findAll() as $item){
           $result =  $this->update($item->id, [
                'price' => $price
            ]);
           if ($result){
               continue;
           }else{
               return false;
           }
        }
        return true;
    }

    public function updateAllWithTypeAndColor($price,$type,$color)
    {
        dd($this->where('type_id', $type)->findAll());

        foreach ($this->where('type_id', $type)->where('color_id', $color)->findAll() as $item){

            $result =  $this->update($item->id, [
                'price' => $price
            ]);
            if ($result){
                continue;
            }else{
                return false;
            }
        }
        return true;
    }

    public function updateAllWithColor(string $price, int|string $color)
    {
        foreach ($this->where('color_id', $color)->findAll() as $item){
            $result =  $this->update($item->id, [
                'price' => $price
            ]);
            if ($result){
                continue;
            }else{
                return false;
            }
        }
        return true;
    }

    public function updateAllWithSize(string $price, int|string $size)
    {
        foreach ($this->where('size_id', $size)->findAll() as $item){
            $result =  $this->update($item->id, [
                'price' => $price
            ]);
            if ($result){
                continue;
            }else{
                return false;
            }
        }
        return true;
    }


}
