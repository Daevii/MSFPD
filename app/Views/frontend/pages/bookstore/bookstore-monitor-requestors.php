<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>
<?php $this->section('content'); ?>


<!-- Breadcrums Start -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active">
            <a class="link-light">Monitor</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Requestors</li>
    </ol>
</nav>
<!-- Breadcrums End -->

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Requestors Datatable </h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="fw-bolder">Order Date</th>
                            <th colspan="4" class="fw-bolder text-center border-1">Department Info</th>
                            <th colspan="4" class="fw-bolder text-center border-1">Order</th>

                        </tr>
                        <tr>

                            <th class="fw-bold">Receipt#</th>
                            <th class="fw-bold">Department</th>
                            <th class="fw-bold">Name</th>
                            <th class="fw-bold">Email</th>
                            <th class="fw-bold">Item</th>
                            <th class="fw-bold">Quantity</th>
                            <th class="fw-bold">Reason</th>
                            <th class="fw-bold">Status</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($requisition as $requisition_list) : ?>
                            <tr>
                                <td><?= $requisition_list['created_at'] ?></td>
                                <td><?= $requisition_list['receipt_num'] ?></td>
                                <td class="fw-bold"><?= $requisition_list['department'] ?></td>
                                <td><?= $requisition_list['requestor_name'] ?></td>
                                <td><?= $requisition_list['requestor_email'] ?></td>

                                <td>
                                    <?php
                                    $decodeitem = json_decode($requisition_list['item']);
                                    foreach ($decodeitem as $item) {
                                        echo $item . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $decodequantity = json_decode($requisition_list['quantity']);
                                    foreach ($decodequantity as $quantity) {
                                        echo $quantity . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $decodedReason = json_decode($requisition_list['reason']);
                                    foreach ($decodedReason as $reason) {
                                        echo $reason . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if ($requisition_list['status'] === 'created_invoice') {
                                        echo '<span class="badge badge-success"> Invoice Created </span>';
                                    } else {
                                        echo '<span class="badge badge-warning"> Pending </span>';
                                    }

                                    ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <?php $this->endSection() ?>