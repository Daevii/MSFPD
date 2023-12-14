<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active">
            <a class="link-light">Users</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Approvers</li>
    </ol>
</nav>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Approvers Datatable <button class="btn btn-success btn-sm mx-3 px-2" id="add_approvers" data-bs-toggle="modal" data-bs-target="#add_approver">
                    <strong>+ADD</strong></button> </h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="fw-bolder">ID</th>
                            <th class="fw-bolder">Image</th>
                            <th class="fw-bolder">Name</th>
                            <th class="fw-bolder">Email</th>
                            <th class="fw-bolder">Contact</th>
                            <th class="fw-bolder">Role</th>
                            <th class="fw-bolder">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $iddept = 1;
                        foreach ($approvers as $approvers_list) : ?>
                            <tr class="align-middle">
                                <td class="text-center p-1">
                                    <div style="visibility: hidden">
                                        <?= $approvers_list['id'] ?>
                                    </div>
                                    <p id="depart_id">
                                        <?= $iddept++; ?>
                                    </p>
                                </td>
                                <td class="text-center p-1">
                                    <img src="<?= base_url("assets/images/uploads/") . $approvers_list['image'] ?>" class="rounded-circle" width="40" alt="no image">
                                </td>
                                <td>
                                    <?= $approvers_list['name'] ?>
                                </td>

                                <td>
                                    <?= $approvers_list['email'] ?>
                                </td>
                                <td>
                                    <i class="mdi mdi-plus"></i>63
                                    <?= $approvers_list['contact'] ?>
                                </td>

                                <td class="table-cell text-center">
                                    <?php if ($approvers_list['user_type'] == 'approver_higher') : ?>
                                        <span class="badge bg-primary fw-bolder">Approver Higher</span>
                                    <?php elseif ($approvers_list['user_type'] == 'approver_lower') : ?>
                                        <span class="badge bg-secondary fw-bolder">Approver Lower</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('admin/edit-approvers /' . $approvers_list['id']) ?>" title="Update Table" class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal" data-bs-target="#edit_approvers">
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
                <div class="modal fade" id="edit_approvers" tabindex="-1" aria-labelledby="edit_approvers_label" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('admin/add-approvers'); ?>" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Edit approvers</h3>
                                        </div>
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                                        <input type="hidden" name="approvers_id" id="approvers_id_edit">

                                        <div class="form-group mx-3">
                                            <label for="name" class="fw-bold">Name</label>
                                            <input type="text" class="form-control" name="name" id="approver_edit_name" placeholder="Enter Name" required>
                                            <div class="invalid-feedback">
                                                Please provide a Name!
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="email" class="fw-bold">Email</label>
                                            <input type="email" class="form-control" name="email" id="approver_edit_email" placeholder="Enter Email" required>
                                            <div class="invalid-feedback">
                                                Please provide an Email!
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Contact</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">+63</span>
                                                </div>
                                                <input type="tel" name="contact" id="approver_edit_contact" class="form-control" placeholder="[0-9]{3}-[0-9]{3}-[0-9]{3}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Contact
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="password" class="fw-bold">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Leave Blank If You Don't Want To Change The password">
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="role" class="fw-bold">Role</label>
                                            <select class="form-select" id="approver_edit_role" name="role" required>
                                                <option value="approver_higher">Higher Approver</option>
                                                <option value="approver_lower">Lower Approver</option>
                                            </select>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Choose
                                                Image</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div id="approver_edit_image">
                                                    </div>
                                                </div>
                                                <div class="col-md-10">

                                                    <div class="custom-file">
                                                        <input type="file" name="edit_image" class="form-control" id="approver_edit_image">
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide An Image
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary add_approvers_btn" id="add_approvers_btn">Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal End-->

                <!-- Add Modal -->
                <div class="modal fade show" id="add_approver" aria-modal="true" data-bs-backdrop="static" data-bs-approvers_listboard="false" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('admin/add-approvers'); ?>" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Add approvers</h3>
                                        </div>
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                        <div class="form-group mx-3">
                                            <label for="name" class="fw-bold">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                                            <div class="invalid-feedback">
                                                Please provide a Name!
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="email" class="fw-bold">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                                            <div class="invalid-feedback">
                                                Please provide an Email!
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
                                            <label for="password" class="fw-bold">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                            <div class="invalid-feedback">
                                                Please provide a Password!
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="role" class="fw-bold">Role</label>
                                            <select class="form-select" name="role" id="role" required>
                                                <option value="">Select Role</option>
                                                <option value="approver_higher">Higher Approver</option>
                                                <option value="approver_lower">Lower Approver</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a Role
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="image" class="fw-bold">Choose Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control" name="image" id="image" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an Image!
                                            </div>
                                        </div>
                                        <input type="hidden" name="approvers_id">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary add_approvers_btn" id="add_approvers_btn">Add</button>
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

<?php $this->section('ajax') ?>


<script>
    // add new table ajax request


    $('#add_post_form').on('submit', function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            // Use jQuery to add the 'was-validated' class  
        } else {
            const formData = new FormData(this);
            $.ajax({
                url: '<?= base_url('admin/add-approvers') ?>',
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
                            title: 'Approver Not Added',
                            text: response.message,
                        });
                    } else {
                        swal({
                            icon: 'success',
                            title: 'Approver Added',
                            text: 'Approver Added Successfully'
                        }).then(function() {
                            location.reload();
                        });;
                    }
                }
            });
        }
    });
</script>

<script>
    //edit approvers

    $(function() {
        //fetch data from table
        $(document).on('click', '.edit_btn', function() {
            const approver_Id = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the approvers  ID is in the first column

            // Make the AJAX request to fetch approvers  data
            $.ajax({
                url: '<?= base_url('admin/edit-approvers') ?>',
                type: 'POST',
                data: {
                    'id': approver_Id,
                },
                success: function(response) {


                    // Populate the form fields with the retrieved data
                    $.each(response, function(key, approvers_value) {
                        $('#approvers_id_edit').val(approvers_value.id);
                        $('#approver_edit_name').val(approvers_value.name);
                        $('#approver_edit_email').val(approvers_value.email);
                        $('#approver_edit_contact').val(approvers_value.contact);
                        $('#approver_edit_role').val(approvers_value.user_type);
                        $('#approver_edit_image').html(`<img class="img-fluid img-thumbnail" width="70" src="<?= base_url('assets/images/uploads/') ?>` + approvers_value.image + `" />`);
                    })

                    $('#edit_post_form').on('submit', function(e) {
                        e.preventDefault();
                        if (!this.checkValidity()) {
                            $('#edit_post_form').addClass('was-validated');
                            // Use jQuery to add the 'was-validated' class
                        } else {
                            const formData = new FormData(this);
                            $.ajax({
                                url: '<?= base_url('admin/update-approvers') ?>',
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
                                            title: 'approvers  Not Added',
                                            text: response.message,
                                        });
                                    } else {
                                        swal({
                                            icon: 'success',
                                            title: 'approvers  Added',
                                            text: 'approvers  Added Successfully'
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
                title: "Delete Approvers?",
                text: "Are you sure you want to delete the approver?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url('admin/delete-approvers') ?>',
                        type: 'POST',
                        data: {
                            'approvers_id': approverID
                        },
                        success: function(response) {
                            swal("Department Deleted", {
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

<?php $this->endSection() ?>