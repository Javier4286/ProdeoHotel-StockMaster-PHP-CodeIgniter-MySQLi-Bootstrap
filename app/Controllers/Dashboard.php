<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $transactionModel = new TransactionModel();

        $data = [
            'title' => 'Dashboard | Prodeo Hotel',
            'total_products' => $productModel->countAll(),
            'low_stock' => $productModel->where('quantity <= min_stock')->countAllResults(),
            'user_name' => session()->get('first_name'),
            'is_admin' => session()->get('is_admin'),
            'recent_moves' => $transactionModel->select('transactions.movement, transactions.quantity, transactions.created_at, products.name as product_name, users.first_name as user_fn')
                ->join('products', 'products.id = transactions.id_product')
                ->join('users', 'users.id = transactions.id_user')
                ->orderBy('transactions.created_at', 'DESC')
                ->limit(5)
                ->find()
        ];

        return view('dashboard/index', $data);
    }
}
