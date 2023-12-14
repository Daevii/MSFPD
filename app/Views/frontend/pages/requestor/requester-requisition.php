<?= $this->extend('frontend/pages/layout/requestormain'); ?>

<?php $this->section('content'); ?>
<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('requestor/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Requisition Form</li>
    </ol>
</nav>
<!-- ============================================================== -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Requesistion Form</h4>
            <form class="form-horizontal" method="post" id="requisition_form">

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="fname" class="col-sm-6 text-start control-label col-form-label">Department</label>
                        <input type="text" class="form-control" name="department" value="<?php echo session()->get('name'); ?>" placeholder="Enter Department Name" readonly />
                    </div>
                    <div class="col-sm-4">
                        <label for="fname" class="col-sm-6 text-start control-label col-form-label">Date
                            Order</label>
                        <?php date_default_timezone_set('Asia/Manila'); ?>
                        <input type="text" class="form-control" id="fname" value="<?= date('m-d-Y // h:i:a');  ?>" readonly />
                    </div>
                    <div class="col-sm-4">
                        <label for="fname" class="col-sm-6 text-start control-label col-form-label">Receipt Num:</label>
                        <input type="text" class="form-control" name="receipt_num" value="<?php echo substr(md5(rand()), 0, 12); ?>" readonly />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="fname" class="col-sm-6 text-start control-label col-form-label">Requestor
                            Name</label>
                        <input type="text" class="form-control" name="requestor" placeholder="Enter Requestor Name" required />
                    </div>


                    <div class="col-sm-4">
                        <label for="fname" class="col-sm-6 text-start control-label col-form-label">Requestor Email</label>
                        <input type="email" class="form-control" name="requestor_email" value="<?php echo session()->get('email'); ?>" readonly />
                    </div>


                </div>



                <div class="table_row" id="requisition">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="item" class="col-sm-6 text-start control-label col-form-label mb-2">Item</label>
                            <input type="text" class="form-control" name="item[]" placeholder="Enter Item" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="reason" class="col-sm-6 text-start control-label col-form-label mb-2">Reason</label>
                            <input type="text" class="form-control" name="reason[]" placeholder="Enter Reason for Requisition" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="qty" class="col-sm-6 text-start control-label col-form-label mb-2">Quantity</label>
                            <input type="number" class="form-control" name="quantity[]" placeholder="Enter Quantity" required>
                        </div>
                        <div class="col-md-2 mb-4 d-grid">
                            <button class="btn btn-success mt-5 mb-5 add_item" type="button">Add Order</button>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary text-white add_requisition" type="submit">
                        Send Procurement
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>

<?php $this->endSection() ?>

<?php $this->section('ajax'); ?>
<script>
    $(document).ready(function() {
        $(".add_item").click(function(e) {
            e.preventDefault();
            $(".table_row").prepend(`
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="item" class="col-sm-6 text-start control-label col-form-label mb-2">Item</label>
              <input type="text" class="form-control" name="item[]" placeholder="Enter Item" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="reason" class="col-sm-6 text-start control-label col-form-label mb-2">Reason</label>
              <input type="text" class="form-control" name="reason[]" placeholder="Enter Reason for Requisition" required>
            </div>
            <div class="col-md-2 mb-3">
              <label for="qty" class="col-sm-6 text-start control-label col-form-label mb-2">Quantity</label>
              <input type="number" class="form-control" name="quantity[]" placeholder="Enter Quantity" required>
            </div>
            <div class="col-md-2 mb-4 d-grid">
              <button class="btn btn-danger mt-5 remove_item" type="button">Remove Order</button>
            </div>
          </div>
        `);
        });

        $(".table_row").on("click", ".remove_item", function(e) {
            e.preventDefault();
            let delete_item = $(this).closest(".row");
            $(delete_item).remove();
        });

        $("#requisition_form").submit(function(e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Please Double Check Your Entries!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= site_url('requestor/add-requisition'); ?>",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.error) {
                                swal({
                                    icon: 'error',
                                    title: 'Requisition Not Added',
                                    text: response.message,
                                });
                            } else {
                                swal({
                                    icon: 'success',
                                    title: 'Requisition Added',
                                    text: response.message,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php $this->endSection() ?>