<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {

        
        $data['users'] = $this->userModel->where('role', 'admin')->findAll();
        return view('admin/users/index', $data);
    }

    public function new()
    {
        return view('admin/users/new');
    }

    public function create()
    {

        
        $data = [
            'nom'      => $this->request->getPost('nom'),
            'prenom'   => $this->request->getPost('prenom'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => 'admin', 
        ];

        if (!$this->userModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/admin/users')->with('success', 'Administrateur cree avec succes.');
    }

    public function edit($id)
    {

        $data['user'] = $this->userModel->find($id);
        
        if (!$data['user']) {
            return redirect()->to('/admin/users')->with('error', 'Administrateur introuvable.');
        }

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {

        
        $data = [
            'nom'      => $this->request->getPost('nom'),
            'prenom'   => $this->request->getPost('prenom'),
            'email'    => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = $password;
        }

        if (!$this->userModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/admin/users')->with('success', 'Administrateur mis a jour avec succes.');
    }

    public function delete($id)
    {

        
        // Empecher de se supprimer soi-meme
        if ($id == session()->get('user_id')) {
            return redirect()->to('/admin/users')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'Administrateur supprime avec succes.');
    }
}
