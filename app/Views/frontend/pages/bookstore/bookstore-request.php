<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>

<?php $this->section('content'); ?>
<!-- Your content goes here -->


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Invoice Request</li>
  </ol>
</nav>

<!-- Breadcrums End -->

<!-- Datatable Start -->
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Invoice Request</h5>
      <div class="table-responsive">
        <table id="DataTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Order Date</th>
              <th>Receipt#</th>
              <th>invoice</th>
              <th>Dean Name</th>
              <th>Email</th>
              <th>Item</th>
              <th>Quantity</th>
              <th>Reason</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
            <?php $requisition_id = 1;
            foreach ($requisition as $requisition_list) : ?>
              <tr>

                <td class="text-center p-1" width="10px">
                  <div style="visibility: hidden">
                    <?= $requisition_list['id'] ?>
                  </div>
                  <p id="depart_id">
                    <?= $requisition_id++; ?>
                  </p>
                </td>


                <td><?= $requisition_list['created_at'] ?></td>
                <td><?= $requisition_list['receipt_num'] ?></td>
                <td><?= $requisition_list['department'] ?></td>
                <td><?= $requisition_list['requestor_name'] ?></td>
                <td><?= $requisition_list['requestor_email'] ?></td>
                <td>
                  <?php
                  $decodeitem = json_decode($requisition_list['item']);
                  foreach ($decodeitem as $item) {
                    echo $item . ',<br><br>';
                  }
                  ?>

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
                <td align="center">
                  <a href="<?= base_url('bookstore/request-form/add/invoice/' . $requisition_list['id']); ?>" title="Create Invoice" class="btn btn-sm">
                    <span class="btn btn-primary btn-sm"><i class="bi bi-receipt"></i></span>
                  </a>
                  <a href="<?= base_url('bookstore/request-form/print/' . $requisition_list['id']) ?>" title="Print" class="btn btn-sm ">
                    <span class="btn btn-info btn-sm"><i class="bi bi-printer"></i></span>
                  </a>

                  <a class="delete_btn btn btn-sm" title="Delete">
                    <span class=" btn btn-danger btn-sm"><i class="fa fa-times"></i></span>
                  </a>
                <?php endforeach; ?>
              </tr>
          <tbody>




        </table>
        <!-- add modal -->


      </div>
    </div>
  </div>
</div>

<?php $this->endSection() ?>
<?php $this->section('ajax') ?>
<script>
  $(document).on('click', '.delete_btn', function() {
    const order_id_del = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column

    swal({
        title: "Delete Order",
        text: "Are you sure you want to delete the Order?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '<?= base_url('bookstore/delete-order') ?>',
            type: 'POST',
            data: {
              'order_id': order_id_del
            },
            success: function(response) {
              swal("Staff Deleted", {
                icon: "success",
                text: response.message
              }).then(function() {
                location.reload();
              });
            }
          })

        } else {
          swal("Order Deletion Process Cancelled");
        }
      });
  });
</script>
<?php $this->endSection() ?>