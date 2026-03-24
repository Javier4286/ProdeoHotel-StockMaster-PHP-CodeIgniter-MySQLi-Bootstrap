<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ["name"];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name,id,{id}]',
    ];

    protected $validationMessages = [
        'name' => ['is_unique' => 'This category name already exists.', 'min_length' => 'Category name must be at least 3 characters long.']
    ];

    protected $skipValidation = false;
}
