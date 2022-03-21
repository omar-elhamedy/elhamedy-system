<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductUnitModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_unit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ProductUnitEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_unit';
    protected $updatedField  = 'updated_at_unit';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[product_unit.name]'
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'يجب ادخال وحدة مخزنية',
            'is_unique' => 'هذه الوحدة مسجلة من قبل'
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
