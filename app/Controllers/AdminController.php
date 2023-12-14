<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\SupplierModel;
use App\Models\InventoryModel;
use App\Models\Requisition;
use App\Models\Invoice;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('user_type') != "admin") {
            echo view('frontend/pages/layout/errors/403error.php');
            exit;
        }
    }
    public function dashboard(): string
    {

        $requisition = new Requisition();
        $invoice = new Invoice();

        // get the requisition data within the last 30 days
        $requisitionData['requisition'] = $requisition->where('created_at >=', date('Y-m-d', strtotime('-30 days')))->findAll();

        // get the pending invoice
        $requisitionData['invoice_pending'] = $invoice->where(['status' => 'pending'])->findAll();

        // get the accepted invoice within the last 30 days
        $requisitionData['accepted_invoice'] = $invoice->where(['status' => 'approved_by_higher', 'approver_higher_timestamp >=' => date('Y-m-d', strtotime('-30 days'))])->findAll();

        // get the rejected invoice within the last 30 days
        $requisitionData['rejected_invoice'] = $invoice->where(['status' => 'rejected', 'approver_lower_timestamp >=' => date('Y-m-d', strtotime('-30 days')) or ['status' => 'rejected', 'approver_higher_timestamp >=' => date('Y-m-d', strtotime('-30 days'))]])->findAll();

        // get the invoice within each month of the year
        $monthlyInvoices = $invoice
            ->where('created_at >=', date('Y-m-d', strtotime('-1 year')))
            ->select("COUNT(*) as count, DATE_FORMAT(created_at, '%Y-%m') as month")
            ->groupBy('month')
            ->findAll();
        $requisitionData['monthly_invoices'] = $monthlyInvoices;

        // get what department got the invoice within 1 year

        $departmentInvoices = $invoice
            ->where('created_at >=', date('Y-m-d', strtotime('-1 year')))
            ->select("COUNT(*) as count, department")
            ->groupBy('department')
            ->findAll();
        $requisitionData['department_invoices'] = $departmentInvoices;
        return view('frontend/pages/admin/admin-dashboard', $requisitionData);
    }
    public function budget(): string
    {
        $budget_view = new DepartmentModel();
        $data['department'] = $budget_view->where(['user_type' => 'department'])->findAll();
        return view('frontend/pages/admin/admin-budget', $data);
    }
    public function budget_report(): string
    {
        return view('frontend/pages/admin/admin-budget-report');
    }
    public function inventory(): string
    {
        $inventory_view = new InventoryModel();
        $data['inventory'] = $inventory_view->findAll();
        return view('frontend/pages/admin/admin-inventory', $data);
    }
    public function monitor_approvers_lower(): string
    {
        $invoices = new Invoice();
        $data['invoice'] = $invoices->where(['approver_lower_checked_by !=' => ''])->findAll();
        return view('frontend/pages/admin/admin-monitor-approvers-lower', $data);
    }
    public function monitor_approvers_higher(): string
    {
        $invoices = new Invoice();
        $data['invoice'] = $invoices->where(['approver_higher_checked_by !=' => ''])->findAll();
        return view('frontend/pages/admin/admin-monitor-approvers-higher', $data);
    }
    public function monitor_requestors(): string
    {
        $requestors = new Requisition();
        $data['requisition'] = $requestors->findAll();
        return view('frontend/pages/admin/admin-monitor-requestors', $data);
    }

    public function bookstore(): string
    {
        $staff_view = new DepartmentModel();
        $data['bookstore'] = $staff_view->where(['user_type' => 'bookstore'])->findAll();
        return view('frontend/pages/admin/admin-bookstore', $data);
    }

    public function supplier(): string
    {
        $staff_view = new SupplierModel();
        $data['supplier'] = $staff_view->findAll();

        return view('frontend/pages/admin/admin-supplier', $data);
    }
    public function approvers(): string
    {
        $approvers_view = new DepartmentModel();
        $data['approvers'] = $approvers_view->whereIn('user_type', ['approver_lower', 'approver_higher'])->findAll();
        return view('frontend/pages/admin/admin-approvers', $data);
    }

    // for admin crud
    public function department(): string
    {
        $department_view = new DepartmentModel();
        $data['department'] = $department_view->where(['user_type' => 'department'])->findAll();
        return view('frontend/pages/admin/admin-department', $data);
    }

    public function staff(): string
    {

        $staff_view = new DepartmentModel();
        $data['staff'] = $staff_view->where(['user_type' => 'admin'])->findAll();
        return view('frontend/pages/admin/admin-staff', $data);
    }
    public function backlog(): string
    {
        $invoice = new Invoice();
        $data['invoice'] = $invoice->findAll();
        return view('frontend/pages/admin/admin-backlog', $data);
    }

    public function print_invoice($id)
    {
        $invoice = new Invoice();
        $data['print'] = $invoice->where('id', $id)->findAll();

        return view('frontend/pages/admin/admin-print-invoice', $data);
    }
}
