<?= $this->extend('frontend/pages/layout/requestormain'); ?>

<?php $this->section('content'); ?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('requestor/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Supplier</li>
    </ol>
</nav>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Requestors Datatable of <?= session()->get('name'); ?></h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="fw-bolder">Order Date</th>
                            <th class="fw-bolder">Receipt#</th>
                            <th class="fw-bolder">Name</th>
                            <th class="fw-bolder">Email</th>
                            <th class="fw-bolder">Item</th>
                            <th class="fw-bolder">Quantity</th>
                            <th class="fw-bolder">Reason</th>
                            <th class="fw-bolder">Status</th>
                            <th>Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($backlog as $backlog_list) : ?>
                            <tr>
                                <td><?= $backlog_list['created_at'] ?></td>
                                <td><?= $backlog_list['receipt_num'] ?></td>
                                <td><?= $backlog_list['requestor_name'] ?></td>
                                <td><?= $backlog_list['requestor_email'] ?></td>

                                <td>
                                    <?php
                                    $decodeitem = json_decode($backlog_list['item']);
                                    foreach ($decodeitem as $item) {
                                        echo $item . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $decodequantity = json_decode($backlog_list['quantity']);
                                    foreach ($decodequantity as $quantity) {
                                        echo $quantity . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $decodedReason = json_decode($backlog_list['reason']);
                                    foreach ($decodedReason as $reason) {
                                        echo $reason . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($backlog_list['status'] === 'created_invoice') {
                                        echo '<span class="badge badge-success"> Invoice Created </span>';
                                    } else {
                                        echo '<span class="badge badge-warning"> Pending </span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('requestor/print/requisition/' . $backlog_list['id']) ?>" title="See Invoice" class="btn btn-primary btn-sm edit_btn">
                                        <i class="bi bi-receipt"></i>
                                    </a>

                                </td>



                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>