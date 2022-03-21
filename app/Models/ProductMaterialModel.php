<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductMaterialModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_material';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ProductMaterialEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_material';
    protected $updatedField  = 'updated_at_material';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[product_material.name]'
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'يجب ادخال خامة',
            'is_unique' => 'هذه الخامة مسجلة من قبل'
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
