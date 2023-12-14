<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use CodeIgniter\I18n\Time;

class AdminControllerCrudApprovers extends BaseController
{
    // approver crud
    public function Add_approvers()
    {
        // add department form to the database

        $validation = \Config\Services::validation(); // initialize and validate the form
        $validation->setRules([
            'name' => 'required|is_unique[users.name]',
            'email' => 'required|is_unique[users.email]valid_email',
            'contact' => 'required',
            'role' => 'required',
            'password' => 'required|min_length[8]',
            'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
        ]);
        if (!$validation->withRequest($this->request)->run()) { // run the validation
            return $this->response->setJSON([ // message the user that there is an error in the form data that the validation failed
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {

            // get the info from the form
            $file = $this->request->getFile('image');
            $filename = $file->getRandomName();
            $input_pass = $_POST['password'];
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);

            //if  role == approver_higher || approver_lower
            if ($this->request->getPost('role') == 'approver_higher') {
                $approvers_type = 'approver_higher';
            } else {
                $approvers_type = 'approver_lower';
            }
            $data = [ // insert the value into the database
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'contact' => $this->request->getPost('contact'),
                'password' => $encrypted_pass,
                'image' => $filename,
                'user_type' => $approvers_type,
                'created_at' => Time::now('Asia/Manila', 'en_US'),

            ];
            // insert the value into the database
            $file->move('assets/images/uploads/', $filename);
            $approvers = new DepartmentModel();
            $approvers->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }
    public function Edit_approvers()
    {
        // Show value of old department data in the table when clicked by the edit button
        $approverModel = new DepartmentModel();
        $approver_id = $this->request->getPost('id');
        $data['approvers'] = $approverModel->find($approver_id);

        return $this->response->setJSON($data);
    }

    public function Update_approvers()
    {
        // update approver modal form
        $approver = new DepartmentModel();
        $approver_update_id = $this->request->getPost('approvers_id');
        $validation = \Config\Services::validation();
        $old_image = $approver->find($approver_update_id)['image'];
        $file = $this->request->getFile('edit_image');

        // check if the file is valid
        if ($file == '') {
            $currentimage = $old_image;
        } else {
            $currentimage = $file->getRandomName();
        }


        // insert the value into the database variable
        $input_pass = $_POST['password'];
        if ($input_pass != '') {
            $encrypted_pass = password_hash($input_pass, PASSWORD_DEFAULT);
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'contact' => $this->request->getPost('contact'),
                'password' => $encrypted_pass,
                'image' => $currentimage,
                'user_type' => $this->request->getPost('role'),
            ];
        } else {
            $data = [
                'name' => $this->request->getPost('name'),
                'image' => $currentimage,
                'email' => $this->request->getPost('email'),
                'contact' => $this->request->getPost('contact'),
                'user_type' => $this->request->getPost('role'),
            ];
        }

        // validation kung tama ang data na ininput
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'contact' => 'required',
            'edit_image' => 'mime_in[edit_image,edit_image/jpg,image/jpeg,image/png]|max_size[edit_image,2048]',
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
            $approver->update($approver_update_id, $data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }
    public function Delete_approvers()
    {
        $approver = new DepartmentModel();
        $approver_delete_id = $approver->find($this->request->getPost('approvers_id'));
        unlink('assets/images/uploads/' . $approver_delete_id['image']);
        $approver->delete($approver_delete_id);
        return $this->response->setJSON([
            'message' => 'Successfully Deleted',
        ]);
    }
}
