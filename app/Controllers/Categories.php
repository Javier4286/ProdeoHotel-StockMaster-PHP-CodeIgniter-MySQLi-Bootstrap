<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Categories extends BaseController
{
    public function index()
    {
        $model = new CategoryModel();
        $categories = $model->findAll();
        return view('categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        if (session()->get('is_admin') != 1) {
            return redirect()->to(base_url('categories'))->with('error_admin', 'You do not have administrator permissions to add categories.');
        }
        return view('categories/create');
    }

    public function store()
    {
        if (session()->get('is_admin') != 1) {
            return redirect()->to(base_url('categories'))->with('error_admin', 'You do not have administrator permissions.');
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CategoryModel();
        $model->insert(['name' => $this->request->getPost('name')]);

        return redirect()->to(base_url('categories'))->with('success', 'Category created successfully!');
    }

    public function edit($id = null)
    {
        if (session()->get('is_admin') != 1) {
            return redirect()->to(base_url('categories'))->with('error_admin', 'You do not have administrator permissions to edit categories.');
        }

        $model = new CategoryModel();
        $category = $model->find($id);

        if (!$category) {
            return redirect()->to(base_url('categories'))->with('error', 'Category not found.');
        }

        return view('categories/edit', ['category' => $category]);
    }

    public function update($id = null)
    {
        if (session()->get('is_admin') != 1) {
            return redirect()->to(base_url('categories'))->with('error_admin', 'You do not have administrator permissions.');
        }

        $rules = ['name' => "required|min_length[3]|max_length[100]|is_unique[categories.name,id,$id]"];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CategoryModel();
        $model->update($id, ['name' => $this->request->getPost('name')]);

        return redirect()->to(base_url('categories'))->with('success', 'Category updated successfully!');
    }

    public function delete($id = null)
    {
        if (session()->get('is_admin') != 1) {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => false,
                'message' => 'You do not have administrator permissions to delete categories.'
            ]);
        }

        $model = new CategoryModel();
        $category = $model->find($id);

        if (!$category) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Category not found.'
            ]);
        }

        if ($model->delete($id)) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Category deleted successfully.'
            ]);
        }

        return $this->response->setStatusCode(500)->setJSON([
            'status' => false,
            'message' => 'Internal server error while deleting.'
        ]);
    }
}
