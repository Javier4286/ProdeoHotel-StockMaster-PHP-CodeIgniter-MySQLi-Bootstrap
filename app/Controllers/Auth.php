<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function check()
    {
        $userModel = new UserModel();
        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        $user = $userModel->where('email', $email)->where('active', 1)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin'],
                    'isLoggedIn' => true,
                ];
                session()->set($sessionData);
                return redirect()->to(base_url('dashboard'));
            }
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
