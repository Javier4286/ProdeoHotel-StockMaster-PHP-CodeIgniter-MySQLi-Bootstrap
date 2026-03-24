<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController
{
    public function index()
    {
        $search = $this->request->getGet('search');
        $productModel = new ProductModel();

        $builder = $productModel->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.id_category')
            ->where('products.deleted_at', null);

        if (!empty(trim($search))) {
            $builder->groupStart()
                ->like('products.name', $search)
                ->orLike('categories.name', $search)
                ->orLike('products.description', $search)
                ->groupEnd();
        }

        $data = [
            'products' => $builder->orderBy('products.id', 'DESC')->paginate(5, 'default'),
            'pager'    => $productModel->pager,
            'search'   => $search
        ];

        return view('products/index', $data);
    }

    public function new()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('products/create', $data);
    }

    public function store()
    {
        $productModel = new ProductModel();

        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'id_category' => $this->request->getPost('id_category'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
            'min_stock'   => $this->request->getPost('min_stock'),
        ];

        if (!$productModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $productModel->errors());
        }

        return redirect()->to(base_url('products'))->with('success', 'Product created successfully');
    }

    public function edit($id = null)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $data['product'] = $productModel->find($id);
        if (!$data['product']) {
            return redirect()->to(base_url('products'))->with('error', 'Product not found');
        }

        $data['categories'] = $categoryModel->findAll();
        return view('products/edit', $data);
    }

    public function update($id = null)
    {
        $productModel = new ProductModel();

        $data = [
            'id'          => $id,
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'id_category' => $this->request->getPost('id_category'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
            'min_stock'   => $this->request->getPost('min_stock'),
        ];

        if (!$productModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $productModel->errors());
        }

        return redirect()->to(base_url('products'))->with('success', 'Product updated successfully');
    }

    public function delete($id = null)
    {
        $productModel = new ProductModel();

        if ($productModel->delete($id)) {
            return $this->response->setJSON(['status' => true]);
        }

        return $this->response->setJSON(['status' => false], 400);
    }
}
