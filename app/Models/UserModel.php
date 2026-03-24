<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['first_name', 'last_name', 'email', 'password', 'address', 'phone', 'is_admin', 'deleted_at'];

    protected $useTimestamps = true;
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'first_name' => 'required|min_length[2]',
        'last_name'  => 'required|min_length[2]',
        'is_admin'   => 'required|in_list[0,1]',
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password']) || empty($data['data']['password'])) {
            if (isset($data['data']['password'])) unset($data['data']['password']);
            return $data;
        }

        if (str_starts_with($data['data']['password'], '$2y$')) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}
