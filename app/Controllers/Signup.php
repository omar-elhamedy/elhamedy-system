<?php

namespace App\Controllers;

use App\Entities\UserEntity;
use App\Models\UserModel;

class Signup extends BaseController
{
    public function __construct()
    {
        helper([
            'form',
            'date',
            'size',
            'storage',
            'material',
            'type',
            'unit',
            'brand',
            'color',
            'meta',
            'client',
            'bookmark'
        ]);

    }
    public function new()
    {
        return view('Signup/new');
    }

    public function create()
    {
        $user = new UserEntity($this->request->getPost());
        $model = new UserModel();
        $result = $model->insert($user);
        if  (!$result){
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $model->errors());
        } else {
            return redirect()->to('/')->with('info', 'تم تسجيل المستخدم');
        }

    }
}