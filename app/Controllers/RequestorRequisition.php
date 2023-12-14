<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Requisition;

class RequestorRequisition extends BaseController
{
    public function Add_requisition()
    {
        $requisition = new Requisition();
        $validation = \Config\Services::validation(); // initialize and validate the form
        $validation->setRules([
            'department' => 'required',
            'requestor' => 'required',
            'receipt_num' => 'required',
            'requestor_email' => 'required|valid_email',
            'item.*' => 'required',
            'reason.*' => 'required',
            'quantity.*' => 'required|numeric'
        ]);

        // Run validation
        if (!$validation->withRequest($this->request)->run()) { // run the validation
            return $this->response->setJSON([ // message the user that there is an error in the form data that the validation failed
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {
            // Get the form data

            $data = [
                'receipt_num' => $this->request->getPost('receipt_num'),
                'department' => $this->request->getPost('department'),
                'requestor_name' => $this->request->getPost('requestor'),
                'requestor_email' => $this->request->getPost('requestor_email'),
                'status' => 'Pending',

                // Add other fields as needed.

                // Convert arrays to JSON before storing in the database
                'item' => json_encode($this->request->getPost('item')),
                'reason' => json_encode($this->request->getPost('reason')),
                'quantity' => json_encode($this->request->getPost('quantity')),


            ];

            // Insert the data into the database
            $inserted = true;
            $requisition->insert($data);
        }

        if ($inserted) {
            $response = [
                'success' => true,
                'message' => 'Requisition added successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to add requisition',

            ];
        }

        return $this->response->setJSON($response);
    }
}
