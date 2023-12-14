<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InventoryModel;
use CodeIgniter\I18n\Time;

class InventoryController extends BaseController
{
    public function Add_inventory()
    {
        // validate the form
        $validation = \Config\Services::validation();
        // Set the validation rules
        $validation->setRules([
            'item' => 'required|is_unique[inventory.item]',
            'brand' => 'required',
            'unit_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'max_length[100]',
            'status' => 'required',
        ]);

        // Run the validation
        if (!$validation->withRequest($this->request)->run()) {
            // Handle validation errors
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {

            if ($this->request->getPost('description') == null) {
                $description = 'No Description';
            } else {
                $description = $this->request->getPost('description');
            }
            // Get the form data
            $data = [
                'item' => $this->request->getPost('item'),
                'brand' => $this->request->getPost('brand'),
                'unit_price' => $this->request->getPost('unit_price'),
                'stock' => $this->request->getPost('stock'),
                'status' => $this->request->getPost('status'),
                'description' => $description,
                'created_at' => Time::now('Asia/Manila', 'en_US'),
            ];

            // Form is valid, continue with your logic here
            $inventoryModel = new InventoryModel();
            $inventoryModel->save($data);
            // Return success response
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Data inserted successfully',
            ]);
        }
    }
    public function Edit_inventory()
    {
        //fetch the data from the database
        $edit_inventory = new InventoryModel();
        $inventory_id = $this->request->getPost('inventory_id');
        $data['inventory'] = $edit_inventory->find($inventory_id);

        return $this->response->setJSON($data);
    }
    public function Update_inventory()
    {
        $inventory_id = $this->request->getPost('inventory_id');
        // validate the form
        $validation = \Config\Services::validation();
        // Set the validation rules
        $validation->setRules([
            'item' => 'required',
            'brand' => 'required',
            'unit_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'max_length[100]',
            'status' => 'required',
        ]);


        // Run the validation
        if (!$validation->withRequest($this->request)->run()) {
            // Handle validation errors
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {

            if ($this->request->getPost('description') == null) {
                $description = 'No Description';
            } else {
                $description = $this->request->getPost('description');
            }
            // Get the form data
            $data = [
                'item' => $this->request->getPost('item'),
                'brand' => $this->request->getPost('brand'),
                'unit_price' => $this->request->getPost('unit_price'),
                'stock' => $this->request->getPost('stock'),
                'status' => $this->request->getPost('status'),
                'description' => $description,
                'created_at' => Time::now('Asia/Manila', 'en_US'),
            ];

            // Form is valid, continue with your logic here
            $inventoryModel = new InventoryModel();
            $inventoryModel->update($inventory_id, $data);
            // Return success response
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Data inserted successfully',
            ]);
        }
    }

    public function Delete_inventory()
    {
        $inventory_id = $this->request->getPost('inventory_id');
        $inventoryModel = new InventoryModel();
        $inventoryModel->delete($inventory_id);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Data deleted successfully',
        ]);
    }
}
