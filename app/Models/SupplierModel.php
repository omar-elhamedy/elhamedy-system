<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'supplier';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\SupplierEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone_number',
        'amount',
        'bank_account'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_supplier';
    protected $updatedField  = 'updated_at_supplier';
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

    public function getSupplierByName($name)
    {
        return $this->where('name', $name)->first();
    }

    public function getSupplierId($name)
    {
        if ($this->getSupplierByName($name) === null){
            return null;
        }
        return $this->getSupplierByName($name)->id;
    }

    public function getSupplierWithAmount()
    {
        return $this->where('amount >', '0')->findAll();
    }

    public function addAmount($supplierID, $amount)
    {
        return $this->db->query("UPDATE `supplier` SET amount=  amount+$amount WHERE id=$supplierID ");
    }

    public function removeAmount($supplierID, $amount)
    {
        return $this->db->query("UPDATE `supplier` SET amount=  amount-$amount WHERE id=$supplierID ");
    }


    public function getAmountTotal()
    {

        $result = $this->where('amount >', '0')->selectSum('amount')->first();
        return $result->amount;
    }
}
