<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientRecordsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients_records';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\ClientRecordsEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'client_id',
        'amount_paid',
        'amount_due',
        'payment_method_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_client_record';
    protected $updatedField  = 'updated_at_client_record';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'client_id' => 'required'
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

    public function getAllClients()
    {
        return $this->join('clients', 'clients.id = clients_records.client_id')->groupBy('name')->orderBy('created_at_client_record', 'asc')->findAll();
    }

    public function getClientHistory($id)
    {
        return $this->where('client_id', $id)->orderBy('updated_at_client_record', 'DESC')->paginate();
    }

    public function getClientHistoryByDate($id, $date)
    {
        return $this->where('client_id', $id)->like('created_at_client_record', $date)->orderBy('created_at_client_record', 'DESC')->paginate();
    }
}
