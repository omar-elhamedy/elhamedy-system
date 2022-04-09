<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function edit()
    {
        $model = new UserModel();
        return view('User/edit', [
            'user' => $model->find(session()->get('user_id'))
        ]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user = $model->where('id', session()->get('user_id'))->first();
        $post = $this->request->getPost();


        if (empty($post['password'])){
            $model->disablePasswordValidation();
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        $user->fill($post);

        if (!$user->hasChanged()){
            return redirect()
                ->back()
                ->withInput()
                ->with('info', 'لا يوجد تحديث');

        }

        if ($model->save($user)){
            return redirect()
                ->back()
                ->withInput()
                ->with('info', 'تم تحديث البيانات');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $model->errors());
        }

    }
}
