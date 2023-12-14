<?php

namespace App\Validation;

use App\Models\DepartmentModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new DepartmentModel();
        $user = $model->where('name', $data['name'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['password']);
    }
}
