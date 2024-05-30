<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\SupplierModel;
use App\Models\DepartmentModel;
use App\Models\Requisition;
use App\Models\Invoice;
use App\Models\InventoryModel;

// dompdf
use Dompdf\Dompdf;


class BookstoreController extends BaseController
{

    public function __construct()
    {
        if (session()->get('user_type') != "bookstore") {
            echo view('frontend/pages/layout/errors/403error.php');
            exit;
        }
    }

    public function dashboard()
    {
        $requisition = new Requisition();
        $supplierModel = new SupplierModel();
        $inventoryModel = new InventoryModel();
        // get the requisition data within the last 30 days
        $dashboardData['requisition'] = $requisition->where('created_at >=', date('Y-m-d', strtotime('-30 days')))->findAll();

        // count the rows in the supplier table
        $dashboardData['supplier'] = $supplierModel->countAll();

        // get the pending requisition forms
        $dashboardData['pending_requisitions'] = $requisition->where(['status' => 'pending'])->findAll();

        // get the active inventories
        $dashboardData['active_inventories'] = $inventoryModel->where(['status' => 'active'])->findAll();
        return view('frontend/pages/bookstore/bookstore-dashboard', $dashboardData);
    }

    public function supplier()
    {
        $staff_view = new SupplierModel();
        $data['supplier'] = $staff_view->findAll();
        return view('frontend/pages/bookstore/bookstore-supplier', $data);
    }
    public function budget()
    {
        $budget_view = new DepartmentModel();
        $data['department'] = $budget_view->where(['user_type' => 'department'])->findAll();
        return view('frontend/pages/bookstore/bookstore-budget', $data);
    }



    public function monitor_approvers_lower()
    {
        $invoices = new Invoice();
        $data['invoice'] = $invoices->where(['approver_lower_checked_by !=' => ''])->findAll();
        return view('frontend/pages/bookstore/bookstore-monitor-approvers-lower', $data);
    }
    public function monitor_approvers_higher()
    {
        $invoices = new Invoice();
        $data['invoice'] = $invoices->where(['approver_higher_checked_by !=' => ''])->findAll();
        return view('frontend/pages/bookstore/bookstore-monitor-approvers-higher', $data);
    }





    public function monitor_requestors()
    {
        $requestors = new Requisition();
        $data['requisition'] = $requestors->findAll();
        return view('frontend/pages/bookstore/bookstore-monitor-requestors', $data);
    }
    public function backlog()
    {
        $requestors = new Invoice();
        $data['invoice'] = $requestors->where(['created_invoice_by' => session()->get('name')])->findAll();
        return view('frontend/pages/bookstore/bookstore-backlog', $data);
    }
    public function inventory()
    {
        $inventory_view = new InventoryModel();
        $data['inventory'] = $inventory_view->findAll();
        return view('frontend/pages/bookstore/bookstore-inventory', $data);
    }
    public function request()
    {

        $request = new Requisition();
        $data['requisition'] = $request->where(['status' => 'pending'])->findAll();
        return view('frontend/pages/bookstore/bookstore-request', $data);
    }


    public function create_invoice($id)
    {
        // fetch the data id from the database
        $invoice = new Requisition();
        $data['invoice'] = $invoice->where(['id' => $id])->findAll();
        // pass the data to the view

        // print_r($data['invoice']);
        return view('frontend/pages/bookstore/bookstore-create-invoice', $data);
    }

    public function see_invoices($id)
    {
        // fetch the data id from the database
        $invoice = new Invoice();

        $invoicedata['requisitions'] = $invoice->where(['id' => $id])->findAll();

        return view('frontend/pages/bookstore/bookstore-see-invoice', $invoicedata);
    }

    public function print_requisition($id)
    {
        $requisition = new Requisition();
        $data['print'] = $requisition->where(['id' => $id])->findAll();
        return view('frontend/pages/bookstore/bookstore-print-requisition', $data);
    }

    public function orders_claim()
    {
        $invoice = new Invoice();
        $data['invoice'] = $invoice->where(['status' => 'approved_by_higher'])->findAll();

        return view('frontend/pages/bookstore/bookstore-orders-claim', $data);
    }


    // claim the order
    public function orders_claimed()
    {
        $invoice = new Invoice();
        date_default_timezone_set('Asia/Manila');
        $data = [
            'status' => 'claimed',
            'claimed_timestamp' => date('Y-m-d'),
        ];
        $invoiceId = $this->request->getVar('invoice_id');

        $claimed = $invoice->update($invoiceId, $data);
        if ($claimed) {
            $invoicedata = $invoice->find($invoiceId);

            $email = \Config\Services::email();
            // Set the email configuration
            $email->setFrom('purchasingdepttest@protonmail.com', 'Purchasing Department');
            $email->setTo($this->request->getVar('email'));
            $email->setSubject('Your Invoice (' . $this->request->getVar('receipt') . ') has been Claimed ');

            $message = "Your order has been claimed \n\n Date Of Claim: " . $data['claimed_timestamp'] . "\n\n Confirmed Claimed By: " . session()->get('name');
            $email->setMessage($message, 'text/html');
            $email->send();
        }

        return $this->response->setJSON([
            'message' => 'Successfully Claimed',
            'status' => 'success',
            'data' => $invoicedata
        ]);

    }





    // Add invoice
    public function Add_invoice()
    {
        //insert the value to the database
        $invoice = new Invoice();

        $bookstore = session()->get('name');
        $data = [
            'id' => $this->request->getPost('id'),
            'receipt' => $this->request->getPost('receipt_num'),
            'department' => $this->request->getPost('department'),
            'department_id' => $this->request->getPost('department_id'),
            'name' => $this->request->getPost('requestor'),
            'email' => $this->request->getPost('email'),

            // Convert arrays to JSON before storing in the database
            'item' => json_encode($this->request->getPost('item')),
            'quantity' => json_encode($this->request->getPost('quantity')),
            'unit_price' => json_encode($this->request->getPost('unit_price')),
            'total_price' => json_encode($this->request->getVar('total_price')),
            'total_amount' => $this->request->getVar('total_amount'),
            'created_invoice_by' => $bookstore,
            'status' => 'pending',
        ];

        $email = \Config\Services::email();

        // Set the email configuration
        $email->setTo($data['email']);
        $email->setSubject('Your Order of Requisition number:' . $data['receipt'] . ' has been created by the Bookstore');

        $message = 'Hello ' . $data['name'] . ",\n\nThe Bookstore has created an invoice for your order. \n\nPlease wait for the Approvers to Verify and Approve.\n\nYour Order of Requisition number: " . $data['receipt'] . "\n\nInvoice created by: " . $data['created_invoice_by'] . ' from the Bookstore';
        $email->setMessage($message, 'text/html');
        $email->send();


        $update_requisition = new Requisition();

        $updated_data = ['status' => 'created_invoice'];
        $update_requisition->update($this->request->getPost('invoice_id'), $updated_data);

        $invoice->insert($data);

        // Set response in JSON if email was sent successfully
        $response = [
            'status' => 'success',
            'message' => 'Email sent successfully',
        ];

        return $this->response->setJSON($response);
    }

    public function delete_order()
    {
        $requisition = new Requisition();
        $requisition_delete_id = $this->request->getPost('order_id');
        $requisition->delete($requisition_delete_id);

        return $this->response->setJSON([
            'message' => 'Successfully Deleted',
            'status' => 'success',
        ]);
    }
}
