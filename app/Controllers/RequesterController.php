<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Requisition;
use App\Models\DepartmentModel;
use App\Models\Invoice;

class RequesterController extends BaseController
{
    public function __construct()
    {
        if (session()->get('user_type') != "department") {
            echo view('frontend/pages/layout/errors/403error.php');
            exit;
        }
    }
    public function dashboard()
    {
        $invoice = new Invoice();
        $departmentModel = new DepartmentModel();

        // get the department budget
        $dashboardData['department_budget'] = $departmentModel->where(['name' => session()->get('name')])->first();

        // get the invoice data of the department within the last 30 days
        $dashboardData['invoice'] = $invoice->where('created_at >=', date('Y-m-d', strtotime('-30 days')))
            ->where(['department' => session()->get('name')])
            ->findAll();

        // get the accepted order of the department within the last 30 days
        $dashboardData['accepted_order'] = $invoice->where('created_at >=', date('Y-m-d', strtotime('-30 days')))
            ->where(['department' => session()->get('name'), 'status' => 'approved_by_higher'])
            ->findAll();

        // get the rejected order of the department within the last 30 days

        $dashboardData['rejected_order'] = $invoice->where('created_at >=', date('Y-m-d', strtotime('-30 days')))
            ->where(['department' => session()->get('name'), 'status' => 'rejected'])
            ->findAll();
        return view('/frontend/pages/requestor/requester-dashboard', $dashboardData);
    }
    public function requester_requisition()
    {

        return view('/frontend/pages/requestor/requester-requisition');
    }
    public function requester_backlog()
    {
        $requisition = new Requisition();

        // Find the department name using the session

        $data['backlog'] = $requisition->where(['department' => session()->get('name')])->findAll();
        return view('/frontend/pages/requestor/requester-backlog', $data);
    }
    public function requester_orders()
    {
        $requisition = new Invoice();

        // Find the department name using the session

        $data['orders'] = $requisition->where(['department' => session()->get('name')])->findAll();

        return view('/frontend/pages/requestor/requester-orders', $data);
    }
    public function see_invoice($id)
    {
        // fetch the data id from the database
        $invoice = new Invoice();

        $invoicedata['requisitions'] = $invoice->where(['id' => $id])->findAll();

        return view('frontend/pages/requestor/requester-see-invoice', $invoicedata);
    }

    public function print_requisition($id)
    {
        // fetch the data id from the database
        $print = new Requisition();

        $invoicedata['print'] = $print->where(['id' => $id])->findAll();

        return view('frontend/pages/requestor/requester-print-requisition', $invoicedata);
    }
}
