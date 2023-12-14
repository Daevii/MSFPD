<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>
<!-- Your content goes here -->


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Backlog</li>
    </ol>
</nav>

<!-- Breadcrums End -->

<!-- Datatable Start -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Backlogs</h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Reciept</th>
                            <th>Department</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Total Amount</th>
                            <th>Invoice Created</th>
                            <th>Order Date</th>
                            <th>Approver Lower Status</th>
                            <th>Approver Lower Name</th>
                            <th>Approver Lower Timestamp</th>
                            <th>Approver Higher Status</th>
                            <th>Approver Higher Name</th>
                            <th>Approver Higher Timestamp</th>
                            <th>Reason</th>
                            <th>Claimed Timestamp</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($invoice as $invoice) : ?>
                            <tr>
                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('admin/print/invoice/' . $invoice['id']) ?>" title="See Invoice" class="btn btn-primary btn-sm edit_btn">
                                        <i class="bi bi-receipt"></i>
                                    </a>
                                </td>
                                <td><?= $invoice['receipt']; ?></td>
                                <td><?= $invoice['department']; ?></td>
                                <td><?= $invoice['name']; ?></td>
                                <td><?= $invoice['email']; ?></td>
                                <td><?php $jsondecode = json_decode($invoice['item']);
                                    foreach ($jsondecode as $item) {
                                        echo $item . ',<br><br>';
                                    } ?></td>
                                <td><?php $jsondecode = json_decode($invoice['quantity']);
                                    foreach ($jsondecode as $quantity) {
                                        echo $quantity . ',<br><br>';
                                    } ?></td>
                                <td><?php $jsondecode = json_decode($invoice['unit_price']);
                                    foreach ($jsondecode as $unit_price) {
                                        echo '₱' .  $unit_price . ',<br><br>';
                                    } ?></td>
                                <td><?php $jsondecode = json_decode($invoice['total_price']);
                                    foreach ($jsondecode as $total_cost) {
                                        echo '₱' . $total_cost . ',<br><br>';
                                    } ?></td>
                                <td><a>₱ </a><?= $invoice['total_amount']; ?></td>
                                <td><?= $invoice['created_invoice_by']; ?></td>
                                <td><?= $invoice['created_at']; ?></td>
                                <td><?php if ($invoice['lower_approver_check'] == 'Approved') {
                                        echo '<span class="badge badge-success">Approved</span>';
                                    } elseif ($invoice['lower_approver_check'] == 'Rejected') {
                                        echo '<span class="badge badge-danger">Rejected</span>';
                                    } else {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    } ?></td>
                                <td><?= $invoice['approver_lower_checked_by']; ?></td>
                                <td><?= $invoice['approver_lower_timestamp']; ?></td>

                                <td><?php if ($invoice['higher_approver_check'] == 'Approved') {
                                        echo '<span class="badge badge-success">Approved</span>';
                                    } elseif ($invoice['higher_approver_check'] == 'Rejected') {
                                        echo '<span class="badge badge-danger">Rejected</span>';
                                    } elseif ($invoice['lower_approver_check'] == 'Rejected') {
                                        echo '<span class="badge badge-danger">Already Rejected</span>';
                                    } else {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    } ?></td>
                                <td><?php if ($invoice['lower_approver_check'] == 'Rejected') {
                                        echo '<span class="badge badge-danger">Already Rejected</span>';
                                    } else {
                                        echo $invoice['approver_higher_checked_by'];
                                    } ?></td>
                                <td><?= $invoice['approver_higher_timestamp']; ?></td>
                                <td><?php if ($invoice['reason'] == '') {
                                        echo '<span class="badge badge-success">No Reason</span>';
                                    } else {
                                        echo $invoice['reason'];
                                    } ?></td>
                                <td><?= $invoice['claimed_timestamp']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>