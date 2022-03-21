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
        'updated_at_product'
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
        return $this->where('storage_id', $storageId)->paginate();
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


}
