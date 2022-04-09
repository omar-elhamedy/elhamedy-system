<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\UserEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'username',
        'password'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at_user';
    protected $updatedField  = 'updated_at_user';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[4]',
        'password_confirmation' => 'required|matches[password]'
    ];
    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'هذا البريد مستخدم من قبل',
            'required' => 'يجب ادخال بريد الكترونى',
            'valid_email' => 'هذا البريد الاليكترونى غير صحيح'
        ],
        'username' => [
            'required' => 'يجب ادخال اسم المستخدم'
        ],
        'password' => [
            'required' => 'يجب ادخال كلمة مرور',
            'min_length' => 'يجب ادخال 4 حروف او ارقام علي الاقل',

        ],
        'password_confirmation' => [
            'required' => 'يجب ادخال تأكيد كلمة المرور',
            'matches' => 'يجب تطابق كلمات المرور مع بعض'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [
        'hashPassword'
    ];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [
        'hashPassword'
    ];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function disablePasswordValidation()
    {
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    protected function hashPassword(array $data){
        if (isset($data['data']['password'])){
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
        }

        return $data;
    }
}
