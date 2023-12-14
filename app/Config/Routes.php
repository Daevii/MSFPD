<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('admin/user_management', 'AdminController::user_management');




// login routes

$routes->match(['get', 'post'], 'login', 'Login::login', ["filter" => "noauth"]);

// Admin routes login
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "AdminController::dashboard");
});
// Department routes Login  
$routes->group("department", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "RequestorController::dashboard");
});
// ApproverLower routes login
$routes->group("approver_lower", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "ApproverController::dashboard");
});
// ApproverHigher routes login
$routes->group("approver_higher", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "ApproverController::dashboard");
});
// bookstore routes login
$routes->group("bookstore", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "BookstoreController::dashboard");
});

$routes->get('logout', 'Login::logout');


//admin routes on the Sidebar
$routes->get('admin/department', 'AdminController::department');
$routes->get('admin/departments', 'AdminController::departments');
$routes->get('admin/approvers', 'AdminController::approvers');
$routes->get('admin/requestors', 'AdminController::requestors');
$routes->get('admin/bookstore', 'AdminController::bookstore');
$routes->get('admin/backlog', 'AdminController::backlog');
$routes->get('admin/inventory', 'AdminController::inventory');
$routes->get('admin/monitor/approvers/lower', 'AdminController::monitor_approvers_lower');
$routes->get('admin/monitor/approvers/higher', 'AdminController::monitor_approvers_higher');
$routes->get('admin/monitor/requestor', 'AdminController::monitor_requestors');
$routes->get('admin/supplier', 'AdminController::supplier');
$routes->get('admin/budget/allocation', 'AdminController::budget');
$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->get('admin/staff', 'AdminController::staff');

// crud routes (admin - department)
$routes->post('admin/add-department', 'AdminControllerCrudDepartment::Add_department');
$routes->post('admin/add-department', 'AdminControllerCrudDepartment::Admin_department');
$routes->post('admin/edit-department', 'AdminControllerCrudDepartment::Edit_department');
$routes->post('admin/update-department', 'AdminControllerCrudDepartment::Update_department');
$routes->post('admin/delete-department', 'AdminControllerCrudDepartment::Delete_department');

// crud routes (admin - approvers)
$routes->post('admin/add-approvers', 'AdminControllerCrudApprovers::Add_approvers');
$routes->post('admin/edit-approvers', 'AdminControllerCrudApprovers::Edit_approvers');
$routes->post('admin/update-approvers', 'AdminControllerCrudApprovers::Update_approvers');
$routes->post('admin/delete-approvers', 'AdminControllerCrudApprovers::Delete_approvers');

//crud routes (admin - staff)
$routes->post('admin/add-staff', 'AdminControllerCrudStaff::Add_staff');
$routes->post('admin/edit-staff', 'AdminControllerCrudStaff::Edit_staff');
$routes->post('admin/update-staff', 'AdminControllerCrudStaff::Update_staff');
$routes->post('admin/delete-staff', 'AdminControllerCrudStaff::Delete_staff');

// crud routes (admin - bookstore)
$routes->post('admin/add-bookstore', 'AdminControllerCrudBookstore::Add_bookstore');
$routes->post('admin/edit-bookstore', 'AdminControllerCrudBookstore::Edit_bookstore');
$routes->post('admin/update-bookstore', 'AdminControllerCrudBookstore::Update_bookstore');
$routes->post('admin/delete-bookstore', 'AdminControllerCrudBookstore::Delete_bookstore');

// crud routes (admin - budget)
$routes->post('admin/edit-budget', 'DeptBudget::Edit_budget');
$routes->post('admin/update-budget', 'DeptBudget::Update_budget');

// crud routes (admin / bookstore - inventory)
$routes->post('add-inventory', 'InventoryController::Add_inventory');
$routes->post('edit-inventory', 'InventoryController::Edit_inventory');
$routes->post('update-inventory', 'InventoryController::Update_inventory');
$routes->post('delete-inventory', 'InventoryController::Delete_inventory');

// crud routes (admin - supplier)
$routes->post('admin/add-supplier', 'CrudSupplier::Add_supplier');
$routes->post('admin/edit-supplier', 'CrudSupplier::Edit_supplier');
$routes->post('admin/update-supplier', 'CrudSupplier::Update_supplier');
$routes->post('admin/delete-supplier', 'CrudSupplier::Delete_supplier');

// admin routes to print the requisition order
$routes->get('admin/print/invoice/(:any)', 'AdminController::print_invoice/$1');


// bookstore routes on the Sidebar
$routes->get('bookstore/dashboard', 'BookstoreController::dashboard');
$routes->get('bookstore/request-form', 'BookstoreController::request');
$routes->get('bookstore/supplier', 'bookstoreController::supplier');
$routes->get('bookstore/budget', 'bookstoreController::budget');
$routes->get('bookstore/monitor/approvers/lower', 'BookstoreController::monitor_approvers_lower');
$routes->get('bookstore/monitor/approvers/higher', 'BookstoreController::monitor_approvers_higher');
$routes->get('bookstore/monitor/requestors', 'BookstoreController::monitor_requestors');
$routes->get('bookstore/backlog', 'BookstoreController::backlog');
$routes->get('bookstore/inventory', 'BookstoreController::inventory');
$routes->get('bookstore/orders/claim', 'BookstoreController::orders_claim');

// bookstore routes to print the requisition order
$routes->get('bookstore/request-form/print/(:any)', 'BookstoreController::print_requisition/$1');

// bookstore routes to claim the order 
$routes->post('bookstore/orders/claimed', 'BookstoreController::orders_claimed');

// bookstore create invoice routes
$routes->get('bookstore/request-form/add/invoice/(:any)', 'BookstoreController::create_invoice/$1');
$routes->post('bookstore/create-invoice', 'BookstoreController::Add_invoice');

// bookstore routes to see invoices
$routes->get('bookstore/see/invoice/(:any)', 'BookstoreController::see_invoices/$1');

// crud routes (bookstore - supplier)
$routes->post('bookstore/add-supplier', 'CrudSupplier::Add_supplier');
$routes->post('bookstore/edit-supplier', 'CrudSupplier::Edit_supplier');
$routes->post('bookstore/update-supplier', 'CrudSupplier::Update_supplier');
$routes->post('bookstore/delete-supplier', 'CrudSupplier::Delete_supplier');


// routes for approver lower on the sidebar
$routes->get('approver/lower/dashboard', 'ApproverController::ApproverLower_dashboard');
$routes->get('approver/lower/accept', 'ApproverController::ApproverLower_accept');
$routes->get('approver/lower/backlog', 'ApproverController::ApproverLower_backlog');
$routes->get('approver/lower/budget', 'ApproverController::ApproverLower_budget');

// routes for approver higher on the sidebar
$routes->get('approver/higher/dashboard', 'ApproverController::Approverhigher_dashboard');
$routes->get('approver/higher/accept', 'ApproverController::Approverhigher_accept');
$routes->get('approver/higher/backlog', 'ApproverController::Approverhigher_backlog');
$routes->get('approver/higher/budget', 'ApproverController::Approverhigher_budget');

// routes for action request for approvers
$routes->post('approver/invoice/setstatus/approved', 'ApproverController::Approver_action_request_approved');
$routes->post('approver/invoice/setstatus/rejected', 'ApproverController::Approver_action_request_rejected');



// routes for requester on the sidebar
$routes->get('requester/dashboard', 'RequesterController::dashboard');
$routes->get('requester/requisition', 'RequesterController::requester_requisition');
$routes->get('requester/backlog', 'RequesterController::requester_backlog');
$routes->get('requester/orders', 'RequesterController::requester_orders');
$routes->get('requester/see/invoice/(:any)', 'RequesterController::see_invoice/$1');

// requisition routes (requestor - requisition)
$routes->post('requestor/add-requisition', 'RequestorRequisition::Add_requisition');


//requestor routes to see invoices
$routes->get('requestor/print/requisition/(:any)', 'RequesterController::print_requisition/$1');
