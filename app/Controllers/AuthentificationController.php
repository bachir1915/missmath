<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LogModel;

class AuthentificationController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] !== 'admin') {
                return redirect()->back()->with('error', 'Accès refusé. Cette zone est réservée aux administrateurs.');
            }

            $sessionData = [
                'user_id'    => $user['id'],
                'username'   => $user['prenom'] . ' ' . $user['nom'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ];

            session()->set($sessionData);

            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Identifiants invalides.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
