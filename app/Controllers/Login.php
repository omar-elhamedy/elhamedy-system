<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{

    public function new()
    {
        return view('Login/new');
    }

    public function delete()
    {
        session()->destroy();

        return redirect()->to('/logout/confirm');
    }

    public function showLogoutMessage()
    {
        return redirect()->to('/login')->with('info', 'تم تسجيل الخروج');

    }

    public function create()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();
        if ($user === null){
            return redirect()
                ->back()
                ->withInput()
                ->with('info', 'هذا المستخدم غير موجود');
        } else {
           if (password_verify($password, $user->password_hash)){

                $session = session();
                $session->regenerate();
                $prevURL = session('redirect_url') ?? '/';

                unset($_SESSION['redirect_url']);
                $session->set('user_id', $user->id);
                return redirect()
                    ->to($prevURL)
                    ->with('info', 'تم تسجيل الدخول');


           } else {
               return redirect()
                   ->back()
                   ->withInput()
                   ->with('info', 'كلمة المرور غير صحيحة');
           }
        }
    }
}
