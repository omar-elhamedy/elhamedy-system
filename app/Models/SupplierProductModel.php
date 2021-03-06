<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'supplier_products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\SupplierProductEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'supplier_id',
        'product_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
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

    public function getProductsForSupplierId($supplierId)
    {
        return $this->where('supplier_id', $supplierId)->findAll();
    }

    public function isProductAlreadyAttachedToSupplier($productID)
    {
        $result = $this->where('product_id', $productID)->first();
        if ($result !== null){
            return true;
        }
        return false;
    }

    public function isSupplierGotThisProduct($supplierId, $productID):bool
    {
        $result = $this->where('supplier_id',$supplierId)->having('product_id	', $productID)->first();
        if ($result !== null){
            return true;
        }
        return false;
    }


}
