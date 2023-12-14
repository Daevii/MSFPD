<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>

<?php $this->section('content'); ?>
<!-- Your content goes here -->


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Backlog</li>
    </ol>
</nav>

<!-- Breadcrums End -->

<!-- Datatable Start -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Backlogs of <?php echo session()->get('name');  ?></h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="fw-bolder">Order Date</th>
                            <th colspan="5" class="fw-bolder text-center border-1">Order</th>
                            <th rowspan="2">Invoices</th>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <th class="fw-bold">Receipt#</th>
                            <th class="fw-bold">Item</th>
                            <th class="fw-bold">Quantity</th>
                            <th class="fw-bold">Total Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoice as $invoice_list) : ?>
                            <tr>
                                <td><?= $invoice_list['created_at'] ?></td>
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

                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('bookstore/see/invoice/' . $invoice_list['id']) ?>" title="See Invoice" class="btn btn-primary btn-sm edit_btn">
                                        <i class="bi bi-receipt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<?php $this->endSection() ?>
<?php $this->Section('ajax') ?>

<?php $this->endSection() ?>