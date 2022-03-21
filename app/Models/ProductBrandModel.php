<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductBrandModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_brand';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ProductBrandEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_brand';
    protected $updatedField  = 'updated_at_brand';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[product_brand.name]'
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'يجب ادخال ماركة',
            'is_unique' => 'هذا الماركة مسجلة من قبل'
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

    public function findByName($name)
    {
        return $this->where('name', $name)->first();
    }
}
