<?= $this->extend('frontend/pages/layout/requestormain'); ?>

<?php $this->section('content'); ?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('requestor/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Track Orders</li>
    </ol>
</nav>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Orders of <?= session()->get('name'); ?></h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="fw-bolder">Order Date</th>
                            <th class="fw-bolder">Receipt#</th>

                            <th class="fw-bolder">Item</th>
                            <th class="fw-bolder">Quantity</th>
                            <th class="fw-bolder">Total Amount</th>
                            <th class="fw-bolder">Status</th>
                            <th>Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $orders_list) : ?>
                            <tr>
                                <td><?= $orders_list['created_at'] ?></td>
                                <td><?= $orders_list['receipt'] ?></td>
                                <td>
                                    <?php
                                    $decodeitem = json_decode($orders_list['item']);
                                    foreach ($decodeitem as $item) {
                                        echo $item . ',<br><br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $decodequantity = json_decode($orders_list['quantity']);
                                    foreach ($decodequantity as $quantity) {
                                        echo $quantity . ',<br><br>';
                                    }
                                    ?>
                                </td>

                                <td><?= $orders_list['total_amount'] ?></td>
                                <td><?php $status = $orders_list['status'];
                                    echo match ($status) {
                                        'pending' => '<span class="badge badge-warning">Pending</span>',
                                        'approved_by_lower' => '<span class="badge badge-primary">Approved by Lower</span>',
                                        'approved_by_higher' => '<span class="badge badge-success">Approved by Higher</span>',
                                        'rejected' => '<span class="badge badge-danger">Rejected</span>',
                                        default => '<span class="badge badge-info">Delivered</span>',
                                    }; ?></td>
                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('requester/see/invoice/' . $orders_list['id']) ?>" title="See Invoice" class="btn btn-primary btn-sm edit_btn">
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