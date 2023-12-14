<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use CodeIgniter\I18n\Time;

class AdminControllerCrudBookstore extends BaseController
{
    public function Add_bookstore()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'bookstore_name' => 'required|is_unique[users.name]',
            'bookstore_email' => 'required|valid_email',
            'bookstore_contact' => 'required|is_unique[users.contact]',
            'bookstore_password' => 'required|min_length[8]',
            'bookstore_image' => 'uploaded[bookstore_image]|mime_in[bookstore_image,image/jpg,image/jpeg,image/png]|max_size[bookstore_image,2048]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {
            $file = $this->request->getFile('bookstore_image');
            $filename = $file->getRandomName();
            $input_pass = $_POST['bookstore_password'];
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [
                'name' => $this->request->getPost('bookstore_name'),
                'email' => $this->request->getPost('bookstore_email'),
                'contact' => $this->request->getPost('bookstore_contact'),
                'password' => $encrypted_pass,
                'image' => $filename,
                'user_type' => 'bookstore',
                'created_at' => Time::now('Asia/Manila', 'en_US'),

            ];
            $file->move('assets/images/uploads/', $filename);
            $department = new DepartmentModel();
            $department->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }


    public function Edit_bookstore()
    {
        // Show value of old bookstore data in the table when clicked by the edit button
        $departmentModel = new DepartmentModel();
        $bookstore_id = $this->request->getPost('id');
        $data['bookstore'] = $departmentModel->find($bookstore_id);


        return $this->response->setJSON($data);
    }
    public function Update_bookstore()
    {
        // update department modal form
        $bookstore = new DepartmentModel();
        $bookstore_update_id = $this->request->getPost('bookstore_id');
        $validation = \Config\Services::validation();
        $old_image = $bookstore->find($bookstore_update_id)['image'];
        $file = $this->request->getFile('bookstore_image');

        if ($file == '') {
            $currentimage = $old_image;
        } else {
            $currentimage = $file->getRandomName();
        }
        $input_pass = $_POST['bookstore_password'];
        if ($input_pass != '') {
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [
                'name' => $this->request->getPost('bookstore_name'),
                'email' => $this->request->getPost('bookstore_email'),
                'contact' => $this->request->getPost('bookstore_contact'),
                'password' => $encrypted_pass,
                'image' => $currentimage,
            ];
        } else {
            $data = [
                'name' => $this->request->getPost('bookstore_name'),
                'email' => $this->request->getPost('bookstore_email'),
                'image' => $currentimage,
            ];
        }


        $validation->setRules([
            'name' => 'is_unique[users.name]',
            'email' => 'is_unique[users.email]',
            'image' => 'mime_in[bookstore_image,image/jpg,image/jpeg,image/png]|max_size[bookstore_image,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {
            if ($file->isValid() && !$file->hasMoved()) {
                unlink('assets/images/uploads/' . $old_image);
                $file->move('assets/images/uploads/', $currentimage);
            }

            $bookstore->update($bookstore_update_id, $data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }
    public function Delete_bookstore()
    {
        $bookstore = new DepartmentModel();
        $bookstore_delete_id = $bookstore->find($this->request->getPost('bookstore_id'));

        unlink('assets/images/uploads/' . $bookstore_delete_id['image']);
        $bookstore->delete($bookstore_delete_id);
        return $this->response->setJSON([
            'message' => 'Successfully Deleted',
        ]);
    }
}
