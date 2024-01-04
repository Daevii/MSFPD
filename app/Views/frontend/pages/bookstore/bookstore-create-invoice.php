<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>

<?php $this->section('content'); ?>
<!-- Your content goes here -->


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item text-white"> <a href="<?= base_url('bookstore/request-form'); ?>" aria-current="page">Invoice Request</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Invoice</li>
    </ol>
</nav>

<!-- Breadcrums End -->

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Requesistion Form</h4>
            <form class="form-horizontal" method="post" id="requisition_form">



                <?php foreach ($invoice as $item) : ?>
                    <input type="hidden" name="invoice_id" id="invoice_id_edit" value="<?= $item['id']; ?>">
                    <div class="form-group row mx-3">
                        <div class="col-sm-4">
                            <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Department</label>
                            <input type="text" class="form-control" id="invoice_department" name="department" value="<?php echo $item['department']; ?>" placeholder="Enter Department Name" readonly />
                        </div>

                        <div class="col-sm-4">
                            <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Date Order</label>
                            <?php date_default_timezone_set('Asia/Manila'); ?>
                            <input type="text" class="form-control" id="fname" name="date" value="<?= date('m-d-Y // h:i:a'); ?>" readonly />
                        </div>
                        <div class="col-sm-4">
                            <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Receipt#:</label>
                            <input type="text" class="form-control" name="receipt_num" value="<?php echo $item['receipt_num']; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row mx-3">
                        <div class="col-sm-4">
                            <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Requestor Name</label>
                            <input type="text" class="form-control" id="invoice_department" name="requestor" value="<?php echo $item['requestor_name']; ?>" placeholder="Enter Department Name" readonly />
                        </div>
                        <div class="col-sm-4">
                            <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Requestor Email</label>
                            <input type="text" class="form-control" id="invoice_department" name="email" value="<?php echo $item['requestor_email']; ?>" placeholder="Enter Department Name" readonly />
                        </div>
                    </div>
                    <br><br><br>



                    <div class="form-group row mx-3 mt-5">
                        <span class="text-left fw-bolder text-white p-2 rounded" style="background-color: #282828;">Table</span>
                    </div>

                    <div class="table_row" id="requisition">
                        <?php
                        $decodeitem = json_decode($item['item'], true);
                        $decodequantity = json_decode($item['quantity'], true);
                        $decodereason = json_decode($item['reason'], true);
                        $item = 1;
                        foreach ($decodeitem as $index => $table) {
                            echo '                

                                <div class="form-group row mx-3 mt-5">
                                    <div class="col-sm-3">
                                        <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Item ' . $item++ . '</label>
                                        <input type="text" class="form-control" id="invoice_department" name="item[]" value="' . $table . '" placeholder="Enter Department Name" readonly />
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Reason</label>
                                        <input type="text" class="form-control" id="fname" name="reason[]" value="' . $decodereason[$index] . '" readonly />
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Quantity</label>
                                        <input type="number" class="form-control" name="quantity[]" value="' . $decodequantity[$index] . '" readonly />
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="fname" class="col-sm-6 text-start control-label col-form-label text-sm">Unit Price</label>
                                   
                                        <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  ₱
                </span>
                <input type="number" class="form-control" class="form-control" name="unit_price[]" step="0.01" required placeholder="Enter Amount" aria-label="Input group example" aria-describedby="basic-addon1">
              </div>
                                        
                                        <div class="invalid-feedback">
                                            Please enter the unit price.
                                        </div>
                                    </div>
                                    <input type="hidden" name="total_price[]" step="0.01" id="total_price" />
                                </div>
                            ';
                        }
                        ?>
                    <?php endforeach; ?>
                    <input type="hidden" name="total_amount" step=" 0.01" id="total_amount" />
                    </div>
                    <br>
                    <hr>





                    <div class="row mx-3 ">
                        <div class="col-sm-4">
                            <label for="reason" class="control-label">Invoice Created By: <b><?= session()->get('name'); ?></b></label>
                        </div>

                        <div class="col-sm-8 text-end">
                            <button class="btn btn-success text-white add_requisition" type="submit">Create Invoice</button>
                        </div>

                    </div>
            </form>

        </div>

    </div>
</div>

<?php $this->endSection() ?>
<?php $this->section('ajax') ?>
<script>
    $(function() {
        $('#requisition_form').on('submit', function(e) {
            e.preventDefault();
            if (!this.checkValidity()) {
                $('#requisition_form').addClass('was-validated');
            } else {
                const formData = new FormData(this);
                var totalAmount = 0;

                // Calculate the total amount by multiplying Quantity and Unit Price
                $('input[name="quantity[]"]').each(function(index) {
                    var quantity = parseFloat($(this).val());
                    var unitPrice = parseFloat($('input[name="unit_price[]"]').eq(index).val());
                    var amount = quantity * unitPrice;
                    $('input[name="total_price[]"]').eq(index).val(amount.toFixed(2)); // Update the total price input field

                    totalAmount += amount;

                });
                $('#total_amount').val(totalAmount.toFixed(2));

                swal({
                    title: 'Total Cost of Item: ₱' + totalAmount.toFixed(2),
                    text: 'Are you sure you want to create this invoice?',
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?= base_url('bookstore/create-invoice') ?>',
                            method: 'POST',
                            data: $(this).serialize(),
                            success: function(response) {
                                if (response.error) {
                                    swal({
                                        icon: 'error',
                                        title: 'Invoice Not Added',
                                        text: response.message,
                                    });
                                } else {
                                    swal({
                                        icon: 'success',
                                        title: 'Invoice Added ' + 'Total Amount: ₱' + totalAmount.toFixed(2),
                                        text: 'Please wait for the response of the Approvers',
                                    }).then(function() {
                                        location.href = ' <?php base_url('bookstore/request-form')
                                                            ?>';
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });
    });
</script>
<?php $this->endSection() ?>