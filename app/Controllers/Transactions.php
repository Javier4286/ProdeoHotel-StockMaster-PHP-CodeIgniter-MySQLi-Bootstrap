<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Transactions extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $search = $this->request->getGet('search');
        $model = new TransactionModel();
        $productModel = new ProductModel();

        $builder = $model->select('transactions.*, products.name as product_name, users.first_name, users.last_name')
            ->join('products', 'products.id = transactions.id_product')
            ->join('users', 'users.id = transactions.id_user');

        if (!empty(trim($search))) {
            $builder->groupStart()
                ->like('products.name', $search)
                ->orLike('users.first_name', $search)
                ->orLike('users.last_name', $search)
                ->groupEnd();
        }

        $data['transactions'] = $builder->orderBy('transactions.created_at', 'DESC')
            ->paginate(5, 'default');
        $data['pager'] = $model->pager;
        $data['products_exist'] = $productModel->countAllResults();
        $data['search'] = $search;

        return view('transactions/index', $data);
    }

    public function create()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        if (empty($data['products'])) {
            return redirect()->to(base_url('products'))->with('error', 'Please create a product first.');
        }

        return view('transactions/create', $data);
    }

    public function store()
    {
        $transactionModel = new TransactionModel();
        $productModel = new ProductModel();

        $id_product = $this->request->getPost('id_product');
        $movement   = $this->request->getPost('movement');
        $quantity   = (int)$this->request->getPost('quantity');
        $id_user    = session('user_id') ?? 1;

        $product = $productModel->find($id_product);

        if (!$product) {
            return $this->respond(['status' => false, 'error' => 'Product not found'], 404);
        }

        if ($movement == 'out' && $product['quantity'] < $quantity) {
            $errorMsg = "Insufficient stock. Available: " . $product['quantity'];
            return $this->respond(['status' => false, 'error' => $errorMsg], 400);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $transactionModel->insert([
            'id_product' => $id_product,
            'movement'   => $movement,
            'quantity'   => $quantity,
            'id_user'    => $id_user
        ]);

        $newQuantity = ($movement == 'in')
            ? $product['quantity'] + $quantity
            : $product['quantity'] - $quantity;

        $productModel->update($id_product, ['quantity' => $newQuantity]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->respond(['status' => false, 'error' => 'Database error'], 500);
        }

        return $this->respond([
            'status' => true,
            'message' => "Movement registered. New stock: $newQuantity"
        ]);
    }
}
