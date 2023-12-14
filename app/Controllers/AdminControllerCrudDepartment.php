<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use CodeIgniter\I18n\Time;

class AdminControllerCrudDepartment extends BaseController
{
    // handling add new department
    public function Add_department()
    {
        // add department form to the database

        $validation = \Config\Services::validation(); // initialize and validate the form
        $validation->setRules([
            'department_name' => 'required|is_unique[users.name]',
            'dean_name' => 'required',
            'dean_email' => 'required|valid_email',
            'contact' => 'required',
            'department_password' => 'required|min_length[8]',
            'department_image' => 'uploaded[department_image]|mime_in[department_image,image/jpg,image/jpeg,image/png]|max_size[department_image,2048]',
        ]);
        if (!$validation->withRequest($this->request)->run()) { // run the validation
            return $this->response->setJSON([ // message the user that there is an error in the form data that the validation failed
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {

            // get the info from the form
            $file = $this->request->getFile('department_image');
            $filename = $file->getRandomName();


            $input_pass = $_POST['department_password'];
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [ // insert the value into the database
                'name' => $this->request->getPost('department_name'),
                'dean_name' => $this->request->getPost('dean_name'),
                'email' => $this->request->getPost('dean_email'),
                'contact' => $this->request->getPost('contact'),
                'password' => $encrypted_pass,
                'image' => $filename,
                'user_type' => 'department',
                'created_at' => Time::now('Asia/Manila', 'en_US'),

            ];
            // insert the value into the database

            $file->move('assets/images/uploads/', $filename);

            $department = new DepartmentModel();
            $department->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }


    public function Edit_department()
    {
        // Show value of old department data in the table when clicked by the edit button
        $departmentModel = new DepartmentModel();
        $dept_id = $this->request->getPost('id');
        $data['department'] = $departmentModel->find($dept_id);


        return $this->response->setJSON($data);
    }
    public function Update_department()
    {
        // update department modal form
        $department = new DepartmentModel();
        $department_update_id = $this->request->getPost('department_id');
        $validation = \Config\Services::validation();
        $old_image = $department->find($department_update_id)['image'];
        $file = $this->request->getFile('department_image');

        // check if the file is valid
        if ($file == '') {
            $currentimage = $old_image;
        } else {
            $currentimage = $file->getRandomName();
        }

        $input_pass = $_POST['department_password'];
        if ($input_pass != '') {
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [
                'name' => $this->request->getPost('department_name'),
                'dean_name' => $this->request->getPost('dean_name'),
                'email' => $this->request->getPost('dean_email'),
                'contact' => $this->request->getPost('contact'),
                'password' => $encrypted_pass,
                'image' => $currentimage,
            ];
        } else {
            // insert the value into the database variable
            $data = [
                'name' => $this->request->getPost('department_name'),
                'dean_name' => $this->request->getPost('dean_name'),
                'email' => $this->request->getPost('dean_email'),
                'contact' => $this->request->getPost('contact'),
                'image' => $currentimage,
            ];
        }
        // validation kung tama ang data na ininput
        $validation->setRules([
            'name' => 'is_unique[users.name]',
            'dean_name' => 'required',
            'email' => 'is_unique[users.email]',
            'contact' => 'required',
            'department_image' => 'mime_in[department_image,image/jpg,image/jpeg,image/png]|max_size[department_image,2048]',
            'image' => 'mime_in[department_image,image/jpg,image/jpeg,image/png]|max_size[department_image,2048]',
        ]);
        // kung hindi mag popop up ang error message
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
            // insert the data into the database and update it
            $department->update($department_update_id, $data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }

    public function Delete_department()
    {

        $department = new DepartmentModel();
        $department_delete_id = $department->find($this->request->getPost('department_id'));

        unlink('assets/images/uploads/' . $department_delete_id['image']);
        $department->delete($department_delete_id);
        return $this->response->setJSON([
            'message' => 'Successfully Deleted',
        ]);
    }
}
