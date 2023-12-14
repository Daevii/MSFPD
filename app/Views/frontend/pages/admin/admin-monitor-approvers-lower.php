<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>

<!-- Breadcrums Start -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active">
            Monitor</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Approvers</li>
        <li class="breadcrumb-item active text-info" aria-current="page">Lower</li>

    </ol>
</nav>
<!-- Breadcrums End -->

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Approver Lower Datatable</h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="fw-bolder">Order Date</th>
                            <th rowspan="2" class="fw-bolder text-center border-1">Approver Name</th>
                            <th colspan="5" class="fw-bolder text-center border-1">Order</th>
                            <th colspan="3" class="fw-bolder text-center border-1">Action</th>

                        </tr>
                        <tr>
                            <th>Department</th>
                            <th class="fw-bold">Receipt#</th>
                            <th class="fw-bold">Item</th>
                            <th class="fw-bold">Quantity</th>
                            <th class="fw-bold">Total Amount</th>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoice as $invoice_list) : ?>
                            <tr>
                                <td><?= $invoice_list['created_at'] ?></td>
                                <td><?= $invoice_list['approver_lower_checked_by'] ?></td>
                                <td><?= $invoice_list['name'] ?></td>
                                <td><?= $invoice_list['receipt'] ?></td>
                                <td>
                                    <?php
                                    $decodeitem = json_decode($invoice_list['item']);
                                    foreach ($decodeitem as $item) {
                                        echo $item . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    $decodequantity = json_decode($invoice_list['quantity']);
                                    foreach ($decodequantity as $quantity) {
                                        echo $quantity .  ',<br><br>';
                                    } ?>

                                </td>
                                <td><?= $invoice_list['total_amount'] ?></td>
                                <td>
                                    <?php if ($invoice_list['lower_approver_check'] == 'Approved') {
                                        echo '<span class="badge badge-success">Approved</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Rejected</span>';
                                    } ?>
                                </td>
                                <td>
                                    <?php if ($invoice_list['lower_approver_check'] == 'Rejected') {
                                        echo $invoice_list['reason'];
                                    } else {
                                        echo '<span class="badge badge-info">No Reason</span>';
                                    } ?>

                                </td>
                                <td><?= $invoice_list['approver_lower_timestamp'] ?></td>

                            </tr>
                        <?php endforeach; ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<?php $this->endSection() ?>