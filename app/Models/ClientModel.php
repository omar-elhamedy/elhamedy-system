<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ClientEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'amount',
        'phone_number'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_customer';
    protected $updatedField  = 'updated_at_customer';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required'
    ];
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

    public function search($term)
    {
        if ($term === null){
            return [];
        }
        return $this->select('id, name')
            ->like('name', $term)
            ->get()
            ->getResultArray();
    }

    public function getAmount($id)
    {
        return $this->find($id)->amount;
    }

    public function getUserByName($name)
    {
        return $this->where('name', $name)->first();
    }

    public function getUserId($name)
    {
        if ($this->getUserByName($name) === null){
            return null;
        }
        return $this->getUserByName($name)->id;
    }

    public function getTotal()
    {
        $result = $this->where('amount >', '0')->selectSum('amount')->first();
        return $result->amount;
    }
}
