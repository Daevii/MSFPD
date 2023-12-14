<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use CodeIgniter\I18n\Time;

class AdminControllerCrudStaff extends BaseController
{
    public function Add_staff()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'staff_name' => 'required|is_unique[users.name]',
            'staff_email' => 'required|valid_email',
            'staff_contact' => 'required|is_unique[users.contact]',
            'staff_password' => 'required|min_length[8]',
            'staff_image' => 'uploaded[staff_image]|mime_in[staff_image,image/jpg,image/jpeg,image/png]|max_size[staff_image,2048]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {
            $file = $this->request->getFile('staff_image');
            $filename = $file->getRandomName();
            $input_pass = $_POST['staff_password'];
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [
                'name' => $this->request->getPost('staff_name'),
                'email' => $this->request->getPost('staff_email'),
                'contact' => $this->request->getPost('staff_contact'),
                'password' => $encrypted_pass,
                'image' => $filename,
                'user_type' => 'admin',
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


    public function Edit_staff()
    {
        // Show value of old staff data in the table when clicked by the edit button
        $departmentModel = new DepartmentModel();
        $staff_id = $this->request->getPost('id');
        $data['staff'] = $departmentModel->find($staff_id);


        return $this->response->setJSON($data);
    }
    public function Update_staff()
    {
        // update department modal form
        $staff = new DepartmentModel();
        $staff_update_id = $this->request->getPost('staff_id');
        $validation = \Config\Services::validation();
        $old_image = $staff->find($staff_update_id)['image'];
        $file = $this->request->getFile('staff_image');

        if ($file == '') {
            $currentimage = $old_image;
        } else {
            $currentimage = $file->getRandomName();
        }

        // check if the password is changed
        $input_pass = $_POST['staff_password'];
        if ($input_pass != '') {
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [
                'name' => $this->request->getPost('staff_name'),
                'email' => $this->request->getPost('staff_email'),
                'contact' => $this->request->getPost('staff_contact'),
                'password' => $encrypted_pass,
                'image' => $currentimage,
            ];
        } else {
            $data = [
                'name' => $this->request->getPost('staff_name'),
                'email' => $this->request->getPost('staff_email'),
                'contact' => $this->request->getPost('staff_contact'),
                'image' => $currentimage,
            ];
        }

        $validation->setRules([
            'name' => 'is_unique[users.name]',
            'email' => 'is_unique[users.email]',
            'image' => 'mime_in[staff_image,image/jpg,image/jpeg,image/png]|max_size[staff_image,2048]',
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

            $staff->update($staff_update_id, $data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }
    public function Delete_staff()
    {
        $staff = new DepartmentModel();
        $staff_delete_id = $staff->find($this->request->getPost('staff_id'));

        unlink('assets/images/uploads/' . $staff_delete_id['image']);
        $staff->delete($staff_delete_id);
        return $this->response->setJSON([
            'message' => 'Successfully Deleted',
        ]);
    }
}
