<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Reports extends BaseController
{
    public function criticalStock()
    {
        $productModel = new ProductModel();
        $search = $this->request->getVar('search');

        $query = $productModel->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.id_category')
            ->where('quantity <= min_stock');

        if (!empty($search)) {
            $query->groupStart()
                ->like('products.name', $search)
                ->orLike('categories.name', $search)
                ->groupEnd();
        }

        $data['products'] = $query->paginate(5);
        $data['pager'] = $productModel->pager;
        $data['search'] = $search;

        if ($this->request->isAJAX()) {
            return view('reports/critical', $data);
        }

        return view('reports/critical', $data);
    }

    public function exportPdf()
    {
        $productModel = new ProductModel();

        $data['products'] = $productModel->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.id_category')
            ->where('quantity <= min_stock')
            ->findAll();

        return view('reports/print_view', $data);
    }
}
