<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {

            if (session()->get('user_type') == "admin") {
                return redirect()->to(base_url('admin/dashboard'));
            }

            if (session()->get('user_type') == "department") {
                return redirect()->to(base_url('requester/dashboard'));
            }
            if (session()->get('user_type') == "approver_lower") {
                return redirect()->to(base_url('approver/lower/dashboard'));
            }
            if (session()->get('user_type') == "approver_higher") {
                return redirect()->to(base_url('approver/higher/dashboard'));
            }
            if (session()->get('user_type') == "bookstore") {
                return redirect()->to(base_url('bookstore/dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
