<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Invoice;
use App\Models\DepartmentModel;


class ApproverController extends BaseController
{
    public function __construct()
    {
        if (session()->get('user_type') != "approver_higher" && session()->get('user_type') != "approver_lower") {
            echo view('frontend/pages/layout/errors/403error.php');
            exit;
        }
    }
    // Approver Lower controller
    public function ApproverLower_dashboard()
    {
        $invoice = new Invoice();

        // get the accepted invoice within the last 30 days
        $requisitionData['accepted_invoice'] = $invoice->where(['status' => 'approved_by_higher', 'approver_higher_timestamp >=' => date('Y-m-d', strtotime('-30 days'))])->findAll();
        // get the rejected invoice within the last 30 days
        $requisitionData['rejected_invoice'] = $invoice->where(['status' => 'rejected', 'approver_lower_timestamp >=' => date('Y-m-d', strtotime('-30 days')) or ['status' => 'rejected', 'approver_higher_timestamp >=' => date('Y-m-d', strtotime('-30 days'))]])->findAll();
        return view('frontend/pages/approver/approver_lower-dashboard', $requisitionData);
    }
    public function ApproverLower_accept()
    {
        $invoice = new Invoice();
        $data['invoice'] = $invoice->where(['status' => 'pending'])->findAll();

        return view('frontend/pages/approver/approver_lower-accept', $data);
    }
    public function ApproverLower_backlog()
    {
        $invoice = new Invoice();
        $data['invoice'] = $invoice->where(['approver_lower_checked_by' => session()->get('name')])->findAll();
        return view('frontend/pages/approver/approver_lower-backlog', $data);
    }

    public function ApproverLower_budget()
    {
        $budget_view = new DepartmentModel();
        $data['department'] = $budget_view->where(['user_type' => 'department'])->findAll();
        return view('frontend/pages/approver/approver_lower-budget', $data);
    }





    // Approver higher controller

    public function Approverhigher_dashboard()
    {
        $invoice = new Invoice();

        // get the accepted invoice within the last 30 days
        $requisitionData['accepted_invoice'] = $invoice->where(['status' => 'approved_by_higher', 'approver_higher_timestamp >=' => date('Y-m-d', strtotime('-30 days'))])->findAll();
        // get the rejected invoice within the last 30 days
        $requisitionData['rejected_invoice'] = $invoice->where(['status' => 'rejected', 'approver_lower_timestamp >=' => date('Y-m-d', strtotime('-30 days')) or ['status' => 'rejected', 'approver_higher_timestamp >=' => date('Y-m-d', strtotime('-30 days'))]])->findAll();
        return view('frontend/pages/approver/approver_higher-dashboard', $requisitionData);
    }
    public function Approverhigher_accept()
    {
        $invoice = new Invoice();
        $data['invoice'] = $invoice->where(['status' => 'approved_by_lower'])->findAll();
        return view('frontend/pages/approver/approver_higher-accept', $data);
    }
    public function Approverhigher_backlog()
    {
        $invoice = new Invoice();
        $data['invoice'] = $invoice->where(['approver_higher_checked_by' => session()->get('name')])->findAll();
        return view('frontend/pages/approver/approver_higher-backlog', $data);
    }

    public function Approverhigher_budget()
    {
        $budget_view = new DepartmentModel();
        $data['department'] = $budget_view->where(['user_type' => 'department'])->findAll();
        return view('frontend/pages/approver/approver_higher-budget', $data);
    }




    // Approver action request
    public function Approver_action_request_approved()
    {
        // Update the status of the invoice
        $invoice = new Invoice();
        // set the timezone to Asia/Manila
        date_default_timezone_set('Asia/Manila');

        if (session()->get('user_type') == "approver_higher") {
            $data = [
                'status' => 'approved_by_higher',
                'higher_approver_check' => 'Approved',
                'approver_higher_checked_by' => session()->get('name'),
                'approver_higher_timestamp' => date('Y-m-d'),
            ];


            $approver = "Higher Approver";
        } elseif (session()->get('user_type') == 'approver_lower') {
            $data = [
                'lower_approver_check' => 'Approved',
                'status' => 'approved_by_lower',
                'approver_lower_checked_by' => session()->get('name'),
                'approver_lower_timestamp' => date('Y-m-d'),
            ];


            $approver = "Lower Approver";
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Approved Not Sent',
            ]);
        }
        $invoiceId = $this->request->getVar('invoice_id');
        $invoice->update($invoiceId, $data);
        $invoicedata = $invoice->find($invoiceId);

        $email = \Config\Services::email();
        // Set the email configuration
        $email->setTo($invoicedata['email']);
        $email->setSubject('Your Invoice (' . $invoicedata['receipt'] . ') has been approved by ' . $approver);

        $message = 'Hello ' . $invoicedata['name'] . ', Your Invoice (' . $invoicedata['receipt'] . ') has been approved by ' . $approver  . "\n\n Approved by: " . session()->get('name') . "\n\n Approved Date: " . $invoicedata['approver_lower_timestamp'];
        $email->setMessage($message, 'text/html');
        $email->send();
    }


    public function Approver_action_request_rejected()
    {
        // Update the status of the invoice
        $invoice = new Invoice();

        if (session()->get('user_type') == "approver_higher") {
            $data = [
                'higher_approver_check' => 'Rejected',
                'status' => 'rejected',
                'approver_higher_checked_by' => session()->get('name'),
                'reason' => $this->request->getVar('reason'),
                'approver_higher_timestamp' => date('Y-m-d'),
            ];
            $approver = "Higher Approver";
        } elseif (session()->get('user_type') == 'approver_lower') {
            $data = [
                'lower_approver_check' => 'Rejected',
                'status' => 'rejected',
                'approver_lower_checked_by' => session()->get('name'),
                'approver_lower_timestamp' => date('Y-m-d'),
                'reason' => $this->request->getVar('reason'),
            ];
            $approver = "Lower Approver";
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Rejected Not Sent',
            ]);
        }
        $invoiceId = $this->request->getVar('invoice_id');
        $invoice->update($invoiceId, $data);
        $invoicedata = $invoice->find($invoiceId);

        $email = \Config\Services::email();
        // Set the email configuration
        $email->setFrom('purchasingdepttest@protonmail.com', 'Purchasing Department');
        $email->setTo($invoicedata['email']);
        $email->setSubject('Your Invoice (' . $invoicedata['receipt'] . ') has been Rejected by ' . $approver);

        $message = 'Hello ' . $invoicedata['name'] . ', Your Invoice (' . $invoicedata['receipt'] . ') has been Rejected by ' . $approver  . "\n\n Rejected by: " . session()->get('name') . "\n\n Rejected Date: " . $invoicedata['approver_lower_timestamp'] . "\n\n Reason: " . $this->request->getVar('reason');
        $email->setMessage($message, 'text/html');
        $email->send();

        return $this->response->setJSON([
            'success' => true,
            'message' => $data,
        ]);
    }
}
