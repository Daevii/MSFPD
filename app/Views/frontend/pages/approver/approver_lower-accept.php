<?= $this->extend('frontend/pages/layout/approver_lowermain'); ?>

<?php $this->section('approver_content') ?>

<!-- Your content goes here -->

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('approver/lower/dashboard'); ?>" class="link-light">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Requistion</li>
  </ol>
</nav>

<!-- Breadcrums End -->

<!-- Datatable Start -->
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
                  <a class="btn btn-success btn-sm approve_invoice" title="Approve Table"><i class="fas fa-check" style='color: white;'></i>
                  </a>
                  <a class="btn btn-danger btn-sm reject_invoice" title="Reject Table">
                    <i class="fa fa-times"></i>
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

<?= $this->Section('ajax') ?>

<script>
  $(function() {
    $('.approve_invoice').click(function() {

      const invoiceId = $(this).closest('tr').find('td:eq(0)').text();
      const invoiceemail = $(this).closest('tr').find('td:eq(4)').text();

      swal({
        title: "Accept Request?",
        text: "Are you sure you want to accept the request?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {

          // Perform the AJAX request that sends the invoice ID to the `setstatus` route
          $.ajax({
            url: '<?= base_url('approver/invoice/setstatus/approved') ?>',
            type: 'POST',
            data: {

              'invoice_id': invoiceId,
              'email': invoiceemail
            },
          });


          // Show a success message
          swal("Order Approved", {
            text: "Hintayin mo nalang yung second Approver",
            icon: "success",
          }).then(function() {
            location.reload();
          });


        } else {
          swal("Order Cancelled");
        }
      });
    });
  });
</script>

<script>
  $(function() {
    $('.reject_invoice').click(function() {

      const invoiceId = $(this).closest('tr').find('td:eq(0)').text();
      swal({
        title: "Reject Order?",
        text: "Are you Sure you want to Reject the Order?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          swal("Please State Your Reason", {
            content: {
              element: "input",
              attributes: {
                placeholder: "Reason",
                type: "text",
                name: "reason",
              },
            },
          }).then((value) => {
            if (value) {
              // ajax call that sends the value to the database
              $.ajax({
                url: '<?= base_url('approver/invoice/setstatus/rejected') ?>',
                type: 'POST',
                data: {
                  'invoice_id': invoiceId,
                  'reason': value
                },
              });
              swal({
                title: "Order Rejected",
                text: "You Typed " + value + " for the reason for the order rejection",
                icon: "success",

              }).then(function() {
                location.reload();
              })
            } else {
              swal("Order Deletion Process Cancelled");
            }
          });
        } else {
          swal("Order Deletion Process Cancelled");
        }
      });

    });
  })
</script>
<?= $this->endSection() ?>