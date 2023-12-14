<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;


class Login extends BaseController
{
    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'name' => 'required',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[name,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Username or Password didn't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('frontend/pages/login', [
                    "validation" => $this->validator,
                ]);
            } else {
                $model = new DepartmentModel();

                $user = $model->where('name', $this->request->getVar('name'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if ($user['user_type'] == "admin") {

                    return redirect()->to(base_url('admin/dashboard'));
                } elseif ($user['user_type'] == "department") {

                    return redirect()->to(base_url('requester/dashboard'));
                } elseif ($user['user_type'] == "approver_lower") {

                    return redirect()->to(base_url('approver/lower/dashboard'));
                } elseif ($user['user_type'] == "approver_higher") {

                    return redirect()->to(base_url('approver/higher/dashboard'));
                } elseif ($user['user_type'] == "bookstore") {

                    return redirect()->to(base_url('bookstore/dashboard'));
                }
            }
        }
        return view('frontend/pages/login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'department_budget' => $user['department_budget'],
            'image' => $user['image'],
            'isLoggedIn' => true,
            "user_type" => $user['user_type'],
            'email' => $user['email'],
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
