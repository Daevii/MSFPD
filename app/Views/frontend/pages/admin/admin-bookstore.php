<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>
<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>
<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active">
            <a class="link-light">Users</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Bookstore</li>
    </ol>
</nav>
<!-- End breadcrumbs -->


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bookstore Datatable <button class="btn btn-success btn-sm mx-3 px-2" data-bs-toggle="modal" data-bs-target="#add">
                    <strong>+ADD</strong></button> </h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">


                    <thead>
                        <tr>
                            <th class="fw-bolder text-center">ID</th>
                            <th class="fw-bolder" style="width: 30px;">Image</th>
                            <th class=" fw-bolder">Bookstore Name</th>
                            <th class="fw-bolder">Email</th>
                            <th class="fw-bolder">Contact</th>
                            <th class="fw-bolder" style="width:150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $idbookstore = 1;
                        foreach ($bookstore as $bookstore_list) : ?>
                            <tr class="align-middle <?= session()->get('id') == $bookstore_list['id'] ? 'table-primary' : '' ?>">
                                <td class="text-center p-1" width="10px">
                                    <div style="visibility: hidden">
                                        <?= $bookstore_list['id'] ?>
                                    </div>
                                    <p id="depart_id">
                                        <?= $idbookstore++; ?>
                                    </p>
                                </td>
                                <td class="text-center p-1" width="10px">
                                    <img src="<?= base_url('assets/images/uploads/') . $bookstore_list['image'] ?>" alt="user" class="rounded-circle" width="40" />
                                </td>
                                <td>
                                    <?= $bookstore_list['name'] ?>
                                </td>
                                <td>
                                    <?= $bookstore_list['email'] ?>
                                </td>
                                <td>
                                    <i class="mdi mdi-plus"></i>63
                                    <?= $bookstore_list['contact'] ?>
                                </td>
                                <td align="center">
                                    <button class="btn btn-primary btn-sm bookstore_edit" data-bs-toggle="modal" data-bs-target="#edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <?php if (session()->get('id') != $bookstore_list['id']) : ?>
                                        <button class="btn btn-danger btn-sm delete_btn">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>


                <div class="modal fade show" id="add" aria-modal="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <form action="#" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Add bookstore</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mx-3">
                                                    <label for="exampleInputEmail1" class="fw-bold">bookstore Name
                                                    </label>
                                                    <input type="text" class="form-control" name="bookstore_name" id="bookstore_name" placeholder="Enter bookstore Name" required>
                                                    <div class="invalid-feedback">
                                                        Please Provide A bookstore Name!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mx-3">
                                                    <label for="exampleInputEmail1" class="fw-bold">Email</label>
                                                    <input type="text" class="form-control" name="bookstore_email" id="bookstore_email" placeholder="Enter Email" required>
                                                    <div class="invalid-feedback">
                                                        Please Provide An Email!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Password
                                            </label>
                                            <input type="password" class="form-control" name="bookstore_password" id="bookstore_password" placeholder="Enter Password" required>
                                            <div class="invalid-feedback">
                                                Please Provide A Password!
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Contact</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">+63</span>
                                                </div>
                                                <input type="tel" name="bookstore_contact" id="contact" class="form-control" placeholder="[0-9]{3}-[0-9]{3}-[0-9]{3}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Contact
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mx-3">
                                                    <label for="exampleInputEmail1" class="fw-bold">Image</label>
                                                    <input type="file" class="form-control" name="bookstore_image" id="bookstore_image" required></input>
                                                    <div class="invalid-feedback">
                                                        Please Provide An Image
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade show" id="edit" aria-modal="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="card card-warning">
                                        <div class="card-header mb-3">
                                            <h3 class="card-title">Edit bookstore</h3>
                                        </div>
                                        <input type="hidden" name="bookstore_id" id="bookstore_id_edit">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mx-3">
                                                    <label for="bookstore_name" class="fw-bold">bookstore Name
                                                    </label>
                                                    <input type="text" class="form-control" name="bookstore_name" id="bookstore_name_edit" placeholder="Enter bookstore Name">
                                                    <div class="invalid-feedback">
                                                        Please Provide A bookstore Name!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mx-3">
                                                    <label for="bookstore_email" class="fw-bold">Email</label>
                                                    <input type="text" class="form-control" name="bookstore_email" id="bookstore_email_edit" placeholder="Enter Email">
                                                    <div class="invalid-feedback">
                                                        Please Provide An Email!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Contact</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">+63</span>
                                                </div>
                                                <input type="tel" name="bookstore_contact" id="bookstore_contact_edit" class="form-control" placeholder="[0-9]{3}-[0-9]{3}-[0-9]{3}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                <div class="invalid-feedback">
                                                    Please Provide A Contact
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mx-3">
                                            <label for="exampleInputEmail1" class="fw-bold">Password
                                            </label>
                                            <input type="password" class="form-control" name="bookstore_password" id="bookstore_password" placeholder="Leave Blank If You Don't Want To Change The Password">

                                        </div>


                                        <div class="form-group mx-3">
                                            <div class="row">
                                                <label for="bookstore_image" class="fw-bold">Image</label>
                                                <div class="col-md-2">
                                                    <div id="image_preview">
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">

                                                    <input type="file" class="form-control" name="bookstore_image" id="bookstore_image_edit"></input>
                                                    <div class="invalid-feedback">
                                                        Please Provide An Image
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
<?php $this->section('ajax') ?>

<script>
    //ADD bookstore MODAL
    $('#add_post_form').on('submit', function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
        } else {
            const formData = new FormData(this);
            $.ajax({
                url: '<?= base_url('admin/add-bookstore') ?>',
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
                            title: 'Bookstore Not Added',
                            text: response.message,
                        });
                    } else {
                        swal({
                            icon: 'success',
                            title: 'Bookstore Added',
                            text: 'Bookstore Added Successfully'
                        }).then(function() {
                            location.reload();
                        });;
                    }
                }
            });
        }
    });
    //edit bookstore modal

    //fetch data from table

    $(document).on('click', '.bookstore_edit', function() {
        const bookstoreId = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column

        // Make the AJAX request to fetch department data
        $.ajax({
            url: '<?= base_url('admin/edit-bookstore') ?>',
            type: 'POST',
            data: {
                'id': bookstoreId
            },
            success: function(response) {


                // Populate the form fields with the retrieved data
                $.each(response, function(key, bookstore_value) {
                    $('#bookstore_id_edit').val(bookstore_value.id);
                    $('#bookstore_name_edit').val(bookstore_value.name);
                    $('#bookstore_email_edit').val(bookstore_value.email);
                    $('#bookstore_contact_edit').val(bookstore_value.contact);
                    $('#old_image').val(bookstore_value.image);
                    $('#image_preview').html(`<img class="img-fluid img-thumbnail" alt=" No IMG" width="70" src="<?= base_url('assets/images/uploads/') ?>` + bookstore_value.image + `" />`);
                })

                $('#edit_post_form').on('submit', function(e) {
                    e.preventDefault();
                    if (!this.checkValidity()) {
                        $('#edit_post_form').addClass('was-validated');
                        // Use jQuery to add the 'was-validated' class
                    } else {
                        const formData = new FormData(this);
                        $.ajax({
                            url: '<?= base_url('admin/update-bookstore') ?>',
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
                                        title: 'Bookstore Updated',
                                        text: response.message,
                                    });
                                } else {
                                    swal({
                                        icon: 'success',
                                        title: 'Bookstore Updated',
                                        text: 'Bookstore Updated Successfully'
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


    $(document).on('click', '.delete_btn', function() {
        const bookstore_id_del = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column


        swal({
                title: "Delete bookstore?",
                text: "Are you sure you want to delete the bookstore?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url('admin/delete-bookstore') ?>',
                        type: 'POST',
                        data: {
                            'bookstore_id': bookstore_id_del
                        },
                        success: function(response) {
                            swal("bookstore Deleted", {
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
<?php $this->endSection() ?>