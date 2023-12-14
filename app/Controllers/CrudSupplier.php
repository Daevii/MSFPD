<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SupplierModel;
use CodeIgniter\I18n\Time;


class CrudSupplier extends BaseController
{
    public function Add_supplier()
    {
        $validation = \Config\Services::validation(); // initialize and validate the form
        $validation->setRules([
            'name' => 'required|is_unique[suppliers.name]',
            'email' => 'required|valid_email',
            'contact' => 'required',
            'location' => 'required',
            'rating' => 'required',
        ]);
        if (!$validation->withRequest($this->request)->run()) { // run the validation
            return $this->response->setJSON([ // message the user that there is an error in the form data that the validation failed
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {

            $rating = match ($this->request->getPost('rating')) {
                'strongly_not_recommended' => 'strongly_not_recommended',
                'not_recommended' => 'not_recommended',
                'neutral' => 'neutral',
                'recommended' => 'recommended',
                'strongly_recommended' => 'strongly_recommended',
                default => '',
            };

            // get the info from the form
            $data = [ // insert the value into the database
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'contact' => $this->request->getPost('contact'),
                'location' => $this->request->getPost('location'),
                'supplier_rating' => $rating,
                'created_at' => Time::now('Asia/Manila', 'en_US'),

            ];
            // insert the value into the database
            $supplier = new SupplierModel();
            $supplier->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }
    public function Edit_supplier()
    {
        $supplier = new SupplierModel();
        $supplier_id = $this->request->getPost('supplier_id');
        $data['supplier'] = $supplier->find($supplier_id);
        return $this->response->setJSON($data);
    }
    public function Update_supplier()
    {
        // update the supplier table
        $supplier = new SupplierModel();
        $supplier_id = $this->request->getPost('id');

        //validate the form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'contact' => 'required',
            'location' => 'required',
            'rating' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        }
        $rating = match ($this->request->getPost('rating')) {
            'strongly_not_recommended' => 'strongly_not_recommended',
            'not_recommended' => 'not_recommended',
            'neutral' => 'neutral',
            'recommended' => 'recommended',
            'strongly_recommended' => 'strongly_recommended',
            default => '',
        };


        // Get the updated data from the request
        $updated_data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'contact' => $this->request->getPost('contact'),
            'location' => $this->request->getPost('location'),
            'supplier_rating' => $rating,
        ];

        // Update the supplier in the database
        $supplier->update($supplier_id, $updated_data);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Supplier updated successfully',
        ]);
    }
    public function Delete_supplier()


    {
        $supplier = new SupplierModel();
        $supplier_id = $this->request->getPost('supplier_id');
        $supplier->delete($supplier_id);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Supplier deleted successfully',
        ]);
    }
}
