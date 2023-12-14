<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active">
            <a class="link-light">Users</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Department</li>
    </ol>
</nav>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Department Datatable <button class="btn btn-success btn-sm mx-3 px-2" id="add_department" data-bs-toggle="modal" data-bs-target="#add">
                    <strong>+ADD</strong></button> </h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>

                        <tr>
                            <th class="fw-bolder dept_id">id</th>
                            <th class="fw-bolder" style="width: 30px;">Image</th>
                            <th class="fw-bolder">Department Name</th>
                            <th class="fw-bolder">Dean Name</th>
                            <th class="fw-bolder">Dean Email</th>
                            <th class="fw-bolder">Contact No.</th>
                            <th class="fw-bolder">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $iddept = 1;
                        foreach ($department as $department_list) : ?>
                            <tr class="align-middle">
                                <td class="text-center p-1">
                                    <div style="visibility: hidden">
                                        <?= $department_list['id'] ?>
                                    </div>
                                    <p id="depart_id">
                                        <?= $iddept++; ?>
                                    </p>
                                </td>
                                <td class="text-center p-1">
                                    <img src="<?= base_url("assets/images/uploads/") . $department_list['image'] ?>" class="rounded-circle" width="40" alt="no image">
                                </td>
                                <td>
                                    <?= $department_list['name'] ?>
                                </td>
                                <td>
                                    <?= $department_list['dean_name'] ?>
                                </td>
                                <td>
                                    <?= $department_list['email'] ?>
                                </td>
                                <td>
                                    <i class="mdi mdi-plus"></i>63
                                    <?= $department_list['contact'] ?>
                                </td>
                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('admin/edit-department/' . $department_list['id']) ?>" title="Update Table" class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal" data-bs-target="#edit">
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


                <!-- edit modal -->
                <div class="modal fade show" id="edit" aria-modal="true" data-bs-backdrop="static" data-bs-department_listboard="false" tabindex="-1">
                    <div class="modal-dialog modal-md">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Edit Department</h3>
                                        </div>

                                        <input type="hidden" name="department_id" id="department_id_edit">

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Department
                                                Name</label>
                                            <input type="text" class="form-control" name="department_name" id="department_name_edit" placeholder="Enter Department Name" required>
                                            <div class=" invalid-feedback">
                                                Please Provide A Department Name!
                                            </div>

                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Dean
                                                Name</label>
                                            <input type="text" class="form-control" name="dean_name" id="dean_name_edit" placeholder="Enter Dean Name" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Dean Name!
                                            </div>
                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Dean
                                                Email</label>
                                            <input type="text" class="form-control" name="dean_email" id="dean_email_edit" placeholder="Enter Dean Email" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Dean Email!
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
                                            <label for="exampleInputEmail1" class="fw-bold">Password</label>
                                            <div class="input-group">

                                                <input type="password" name="department_password" class="form-control" placeholder="Leave it blank if you don't want to change the password" aria-label="Recipient's username">

                                            </div>
                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Choose
                                                Image</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div id="Departmentimage">
                                                    </div>
                                                </div>
                                                <div class="col-md-10">

                                                    <div class="custom-file">
                                                        <input type="file" name="department_image" class="form-control" id="Departmentimage">
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
                                        <button type="submit" class="btn btn-primary edit_post_btn" id="edit_post_btn">Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>


                <!-- add modal -->
                <div class="modal fade show" id="add" aria-modal="true" data-bs-backdrop="static" data-bs-department_listboard="false" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('admin/add-department'); ?>" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Add Department</h3>
                                        </div>
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Department
                                                Name</label>
                                            <input type="text" class="form-control" name="department_name" id="exampleInputEmail1" placeholder="Enter Department Name" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Department Name!
                                            </div>

                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Dean
                                                Name</label>
                                            <input type="text" class="form-control" name="dean_name" id="exampleInputEmail1" placeholder="Enter Dean Name" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Dean Name!
                                            </div>
                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Dean
                                                Email</label>
                                            <input type="email" class="form-control" name="dean_email" id="exampleInputEmail1" placeholder="Enter Dean Email" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Dean Email!
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
                                            <label for="exampleInputEmail1" class="fw-bold">Password</label>
                                            <div class="input-group">

                                                <input type="password" name="department_password" class="form-control" placeholder="Enter your password. It Should be at least 8 chatracters Long" aria-label="Recipient's username" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Password
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Choose
                                                Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="department_image" class="form-control" id="Departmentimage" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide An Image
                                            </div>
                                        </div>
                                        <input type="hidden" name="department_id">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary add_department_btn" id="add_department_btn">Add</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>

<?= $this->section('ajax') ?>


<script>
    $(function() {
        //fetch data from table
        $(document).on('click', '.edit_btn', function() {
            const departmentId = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column

            // Make the AJAX request to fetch department data
            $.ajax({
                url: '<?= base_url('admin/edit-department') ?>',
                type: 'POST',
                data: {
                    'id': departmentId
                },
                success: function(response) {
                    // Populate the form fields with the retrieved data
                    $.each(response, function(key, department_value) {
                        $('#department_id_edit').val(department_value.id);
                        $('#department_name_edit').val(department_value.name);
                        $('#dean_name_edit').val(department_value.dean_name);
                        $('#dean_email_edit').val(department_value.email);
                        $('#contact').val(department_value.contact);
                        $('#old_image').val(department_value.image);
                        $('#Departmentimage').html(`<img class="img-fluid img-thumbnail" width="70" src="<?= base_url('assets/images/uploads/') ?>` + department_value.image + `" />`);
                    })

                    $('#edit_post_form').on('submit', function(e) {
                        e.preventDefault();
                        if (!this.checkValidity()) {
                            $('#edit_post_form').addClass('was-validated');
                            // Use jQuery to add the 'was-validated' class
                        } else {
                            const formData = new FormData(this);
                            $.ajax({
                                url: '<?= base_url('admin/update-department') ?>',
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
                                            title: 'Department Not Added',
                                            text: response.message,
                                        });
                                    } else {
                                        swal({
                                            icon: 'success',
                                            title: 'Department Added',
                                            text: 'Department Added Successfully'
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

    $(document).on('click', '.delete_btn', function() {
        const departmentId = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column


        swal({
                title: "Delete Department?",
                text: "Are you sure you want to delete the department?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url('admin/delete-department') ?>',
                        type: 'POST',
                        data: {
                            'department_id': departmentId
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


    // add new table ajax request
    $('#add_post_form').on('submit', function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
        } else {
            const formData = new FormData(this);
            $.ajax({
                url: '<?= base_url('admin/add-department') ?>',
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
                            title: 'Department Not Added',
                            text: response.message,
                        });
                    } else {
                        swal({
                            icon: 'success',
                            title: 'Department Added',
                            text: 'Department Added Successfully'
                        }).then(function() {
                            location.reload();
                        });;
                    }
                }
            });
        }
    });
</script>


<?php $this->endSection() ?>