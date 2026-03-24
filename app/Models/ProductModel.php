<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['name', 'description', 'quantity', 'min_stock', 'price', 'id_category', 'active'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'id'          => 'permit_empty|integer',
        'name'        => 'required|min_length[3]|max_length[150]|is_unique[products.name,id,{id}]',
        'description' => 'required|min_length[20]|max_length[300]',
        'quantity'    => 'required|integer|greater_than_equal_to[0]',
        'min_stock'   => 'required|integer|greater_than_equal_to[0]',
        'price'       => 'required|decimal|greater_than_equal_to[0]',
        'id_category' => 'required|is_not_unique[categories.id]',
    ];

    protected $validationMessages = [
        'name'        => ['is_unique' => 'A product with this name already exists.'],
        'description' => ['min_length' => 'Description must be at least 20 characters long.'],
        'quantity'    => ['greater_than_equal_to' => 'Stock quantity cannot be negative'],
    ];

    protected $skipValidation = false;

    public function getProductsWithCategory()
    {
        return $this->select('products.*,categories.name as category_name')
            ->join('categories', 'categories.id = products.id_category')
            ->where('products.active', 1)
            ->findAll();
    }
}
