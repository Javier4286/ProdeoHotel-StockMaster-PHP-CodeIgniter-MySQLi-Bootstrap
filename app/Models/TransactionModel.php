<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['quantity', 'movement', 'id_user', 'id_product'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';

    protected $validationRules = [
        'quantity' => 'required|integer|greater_than[0]',
        'movement' => 'required|in_list[in,out]',
        'id_user' => 'required|is_not_unique[users.id]',
        'id_product' => 'required|is_not_unique[products.id]',
    ];

    protected $validationMessages = [
        'movement' => ['in_list' => 'The movement must be either "in" or "out".'],
        'quantity' => ['greater_than' => 'Quantity must be a positive number.', 'required' => 'The quantity is mandatory'],
    ];

    protected $skipValidation = false;
}
