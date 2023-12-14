<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Supplier</li>
    </ol>
</nav>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="card-body">
                <h4 class="card-title">Supplier Management<button class="btn btn-success btn-sm mx-3 px-2" id="supplier" data-bs-toggle="modal" data-bs-target="#add_supplier">
                        <strong>+ADD</strong></button> </h4>
                <div class="table-responsive">
                    <table id="DataTable" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Location</th>
                                <th>Ratings</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $iddept = 1;
                            foreach ($supplier as $supplier_list) : ?>
                                <tr class="align-middle">
                                    <td class="text-center p-1">
                                        <div style="visibility: hidden">
                                            <?= $supplier_list['id'] ?>
                                        </div>
                                        <p id="depart_id">
                                            <?= $iddept++; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <?= $supplier_list['name'] ?>
                                    </td>
                                    <td>
                                        <?= $supplier_list['email'] ?>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-plus"></i>63
                                        <?= $supplier_list['contact'] ?>
                                    </td>
                                    <td>
                                        <?= $supplier_list['location'] ?>
                                    </td>
                                    <td>
                                        <?php if ($supplier_list['supplier_rating'] == 'strongly_not_recommended') : ?>
                                            <span class="badge bg-danger fw-bolder">Strongly Not Recommended</span>
                                        <?php elseif ($supplier_list['supplier_rating'] == 'not_recommended') : ?>
                                            <span class="badge bg-warning fw-bolder">Not Recommended</span>
                                        <?php elseif ($supplier_list['supplier_rating'] == 'neutral') : ?>
                                            <span class="badge bg-secondary fw-bolder">Neutral</span>
                                        <?php elseif ($supplier_list['supplier_rating'] == 'recommended') : ?>
                                            <span class="badge bg-info fw-bolder">Recommended</span>
                                        <?php elseif ($supplier_list['supplier_rating'] == 'strongly_recommended') : ?>
                                            <span class="badge bg-success fw-bolder">Strongly Recommended</span>
                                        <?php endif; ?>

                                    </td>
                                    <td class="text-center p-1" width="10%">
                                        <a href="<?= base_url('admin/edit-supplier/' . $supplier_list['id']) ?>" title="Update Table" class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal" data-bs-target="#edit_supplier">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm delete_btn" title="Delete Table">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit_supplier" tabindex="-1" aria-labelledby="edit_supplier_label" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_supplier_label">Edit supplier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                                    <div class="modal-body">
                                        <div class="card card-warning">
                                            <div class="card-header mb-3">
                                                <h3 class="card-title">Edit supplier</h3>
                                            </div>
                                            <input type="hidden" name="id" id="supplier_id">
                                            <input type="hidden" name="old_image" id="old_image">

                                            <div class="form-group mx-3">
                                                <label for="exampleInputEmail1" class="fw-bold">Supplier
                                                    Name</label>
                                                <input type="text" class="form-control" name="name" id="supplier_name" placeholder="Enter Supplier Name" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Supplier Name!
                                                </div>
                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="exampleInputEmail1" class="fw-bold">Supplier
                                                    Email</label>
                                                <input type="email" class="form-control" name="email" id="supplier_email" placeholder="Enter Supplier Email" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Supplier Email!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="exampleInputEmail1" class="fw-bold">Supplier
                                                    Location</label>
                                                <input type="text" class="form-control" name="location" id="supplier_location" placeholder="Enter Supplier Location" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Supplier Location!
                                                </div>

                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="exampleInputEmail1" class="fw-bold">Contact</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">+63</span>
                                                    </div>
                                                    <input type="tel" name="contact" id="contact" class="form-control" placeholder="[0-9]{3}-[0-9]{3}-[0-9]{3}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                    <div class="invalid-feedback">
                                                        Please Provide A Contact
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="exampleInputEmail1" class="fw-bold">rating</label>
                                                <select class="form-select" name="rating" id="rating" required>
                                                    <option value="">Select Rating</option>
                                                    <option value="strongly_not_recommended">Strongly not Recommended</option>
                                                    <option value="not_recommended">Not Recommended</option>
                                                    <option value="neutral">Neutral</option>
                                                    <option value="recommended">Recommended</option>
                                                    <option value="strongly_recommended">Strongly Recommended</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary edit_post_btn" id="edit_post_btn">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal End-->

                <!-- Add Modal -->
                <div class="modal fade" id="add_supplier" tabindex="-1" aria-labelledby="add_supplier_label" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_supplier_label">Add supplier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('admin/add-supplier'); ?>" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Add supplier</h3>
                                        </div>
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Supplier
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="supplier_name" placeholder="Enter Supplier Name" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Supplier Name!
                                            </div>
                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Supplier
                                                Email</label>
                                            <input type="email" class="form-control" name="email" id="supplier_email" placeholder="Enter Supplier Email" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Supplier Email!
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Supplier
                                                Location</label>
                                            <input type="text" class="form-control" name="location" id="supplier_location" placeholder="Enter Supplier Location" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Supplier Location!
                                            </div>

                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Contact</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">+63</span>
                                                </div>
                                                <input type="tel" name="contact" id="contact" class="form-control" placeholder="[0-9]{3}-[0-9]{3}-[0-9]{3}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Contact
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="role" class="fw-bold">Rating</label>
                                            <select class="form-select" name="rating" id="rating" required>
                                                <option value="strongly_not_recommended">Strongly not Recommended</option>
                                                <option value="not_recommended">Not Recommended</option>
                                                <option value="neutral">Neutral</option>
                                                <option value="recommended">Recommended</option>
                                                <option value="strongly_recommended">Strongly Recommended</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="supplier_id">


                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary add_supplier_btn" id="add_supplier_btn">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Add Modal End-->

            </div>

        </div>
    </div>
</div>

<?php $this->endSection() ?>

<?= $this->section('ajax') ?>
<script>
    $('#add_post_form').on('submit', function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
        } else {
            const formData = new FormData(this);

            $.ajax({
                url: '<?= base_url('admin/add-supplier') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        swal({
                            icon: 'error',
                            title: 'Supplier Not Added',
                            text: response.message,
                        });
                    } else {
                        swal({
                            icon: 'success',
                            title: 'Supplier Added',
                            text: 'Supplier Added Successfully'
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        }
    });
</script>

<script>
    $(function() {
        //fetch data from table
        $(document).on('click', '.edit_btn', function() {
            const supplierId = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the supplier ID is in the first column

            // Make the AJAX request to fetch supplier data
            $.ajax({
                url: '<?= base_url('admin/edit-supplier') ?>',
                type: 'POST',
                data: {
                    'supplier_id': supplierId
                },
                success: function(response) {
                    // Populate the form fields with the retrieved data
                    $.each(response, function(key, supplier_value) {
                        $('#supplier_id').val(supplier_value.id);
                        $('#supplier_name').val(supplier_value.name);
                        $('#supplier_email').val(supplier_value.email);
                        $('#supplier_location').val(supplier_value.location);

                        $('#contact').val(supplier_value.contact);
                        $('#rating').val(supplier_value.supplier_rating);

                    })

                    $('#edit_post_form').on('submit', function(e) {
                        e.preventDefault();
                        if (!this.checkValidity()) {
                            $('#edit_post_form').addClass('was-validated');
                            // Use jQuery to add the 'was-validated' class
                        } else {
                            const formData = new FormData(this);
                            $.ajax({
                                url: '<?= base_url('admin/update-supplier') ?>',
                                type: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                cache: false,
                                dataType: 'json',
                                success: function(response) {
                                    // Handle the success response if needed
                                    if (response.error) {
                                        swal({
                                            icon: 'error',
                                            title: 'Supplier Not Added',
                                            text: response.message,
                                        });
                                    } else {
                                        swal({
                                            icon: 'success',
                                            title: 'Supplier Added',
                                            text: 'Supplier Added Successfully'
                                        }).then(function() {
                                            location.reload();
                                        });
                                    }
                                }
                            });
                        }
                    });


                }
            });

        });
    });
</script>


<script>
    // delete approvers
    $(document).on('click', '.delete_btn', function() {
        const approverID = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column

        swal({
                title: "Delete Supplier?",
                text: "Are you sure you want to delete the approver?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url('admin/delete-supplier') ?>',
                        type: 'POST',
                        data: {
                            'supplier_id': approverID
                        },
                        success: function(response) {
                            swal("Supplier Deleted", {
                                icon: "success",
                                text: response.message
                            }).then(function() {
                                location.reload();
                            });
                        }
                    })

                } else {
                    swal("Department Deletion Process Cancelled");
                }
            });
    });
</script>

<?= $this->endSection() ?>