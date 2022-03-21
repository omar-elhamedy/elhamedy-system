<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductColorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_color';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ProductColorEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_color';
    protected $updatedField  = 'updated_at_color';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[product_color.name]'
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'يجب ادخال لون',
            'is_unique' => 'هذا اللون مسجل من قبل'
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
        if ($this->where('name', $name)->first() === null){
            $this->insert([
                'name' => $name
            ]);
        }
        return $this->where('name', $name)->first();
    }

    public function getWhiteAndBlack(): array
    {
        $whiteAndBlack = [$this->findByName('ابيض')->id, $this->findByName('اسود')->id];

        return $whiteAndBlack;
    }

    public function getAllColors(): array
    {
        return $this->findAll();
    }
}
