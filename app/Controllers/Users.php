<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->withDeleted()->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $model = new UserModel();
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password'   => $this->request->getPost('password'),
            'address'    => $this->request->getPost('address'),
            'phone'      => $this->request->getPost('phone'),
            'is_admin'   => $this->request->getPost('is_admin') ? 1 : 0,
        ];

        if ($model->insert($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully');
        }
        return redirect()->back()->withInput()->with('error', implode(' ', $model->errors()));
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->withDeleted()->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => "required|valid_email|is_unique[users.email,id,$id]"
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getError('email'));
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'address'    => $this->request->getPost('address'),
            'phone'      => $this->request->getPost('phone'),
            'is_admin'   => $this->request->getPost('is_admin') ? 1 : 0,
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = $password;
        }

        if ($model->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User updated successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Update failed');
    }

    public function delete($id)
    {
        $model = new UserModel();
        if ($id == session()->get('user_id')) {
            return $this->response->setJSON(['status' => false, 'message' => 'You cannot deactivate yourself']);
        }

        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => true, 'message' => 'Employee deactivated successfully']);
        }
        return $this->response->setJSON(['status' => false, 'message' => 'Could not deactivate employee']);
    }

    public function restore($id)
    {
        $model = new UserModel();
        if ($model->update($id, ['deleted_at' => null])) {
            return $this->response->setJSON(['status' => true, 'message' => 'Employee reactivated successfully']);
        }
        return $this->response->setJSON(['status' => false, 'message' => 'Could not reactivate employee']);
    }
}
