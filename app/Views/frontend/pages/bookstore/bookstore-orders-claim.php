<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>
<?= $this->section('content'); ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Claim Order</li>
    </ol>
</nav>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invoice Datatable </h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="fw-bolder">Order Date</th>
                            <th class="fw-bolder">Receipt</th>
                            <th class="fw-bolder">Department</th>
                            <th class="fw-bolder">Email</th>
                            <th class="fw-bolder">Items</th>
                            <th class="fw-bolder">Quantity</th>
                            <th class="fw-bolder">Unit Price</th>
                            <th class="fw-bolder">Total Cost</th>
                            <th class="fw-bolder">Total Amount</th>
                            <th class="fw-bolder">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $iddept = 1;
                        foreach ($invoice as $row) : ?>
                            <tr>
                                <td class="text-center p-1">
                                    <div style="visibility: hidden">
                                        <?= $row['id'] ?>
                                    </div>
                                    <p id="depart_id">
                                        <?= $iddept++; ?>
                                    </p>
                                </td>
                                <td><?= $row['created_at']; ?></td>
                                <td><?= $row['receipt']; ?></td>
                                <td><?= $row['department']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?php $jsondecode = json_decode($row['item']);
                                    foreach ($jsondecode as $item) {
                                        echo $item . ',<br><br>';
                                    } ?></td>
                                <td><?php $jsondecode = json_decode($row['quantity']);
                                    foreach ($jsondecode as $quantity) {
                                        echo $quantity . ',<br><br>';
                                    } ?></td>
                                <td><?php $jsondecode = json_decode($row['unit_price']);
                                    foreach ($jsondecode as $unit_price) {
                                        echo '₱' .  $unit_price . ',<br><br>';
                                    } ?></td>
                                <td><?php $jsondecode = json_decode($row['total_price']);
                                    foreach ($jsondecode as $total_cost) {
                                        echo '₱' . $total_cost . ',<br><br>';
                                    } ?></td>
                                <td><a>₱ </a><?= $row['total_amount']; ?></td>
                                <td align="center">
                                    <a class="btn btn-success btn-sm claimed_invoice" title="claimed Table"><i class="fas fa-circle-check" style='color: white;'></i>
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


<?= $this->endSection() ?>
<?php $this->section('ajax'); ?>

<script>
    $(function() {
        $('.claimed_invoice').click(function() {

            const invoiceId = $(this).closest('tr').find('td:eq(0)').text();
            const invoicereceipt = $(this).closest('tr').find('td:eq(2)').text();
            const invoicedept = $(this).closest('tr').find('td:eq(3)').text();

            const invoiceemail = $(this).closest('tr').find('td:eq(4)').text();
            swal({
                title: "Order Claim?",
                text: "Does the Department Claimed the Item?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    // Perform the AJAX request that sends the invoice ID to the `setstatus` route
                    $.ajax({
                        url: '<?= base_url('bookstore/orders/claimed') ?>',
                        type: 'POST',
                        data: {

                            'invoice_id': invoiceId,
                            'receipt': invoicereceipt,
                            'email': invoiceemail
                        },

                        success: function(response) {
                            // Show a success message
                            swal("Order claimedd", {
                                text: "The order of " + invoicereceipt + " by " + invoicedept + " has been claimed",
                                icon: "success",
                            }).then(function() {
                                location.reload();
                            });
                        }
                    });
                } else {
                    swal("Order Cancelled");
                }
            });
        });
    });
</script>


<?= $this->endSection(); ?>