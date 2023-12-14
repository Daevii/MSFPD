<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>
<!-- Breadcrums Start -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active">
            <a class="link-light">Budget</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Budget Allocation</li>
    </ol>
</nav>

<!-- Breadcrums End -->

<!-- Datatable Start -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Budget Datatable </h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Department</th>
                            <th>Allocated Budget</th>
                            <th>Budget Remaining</th>
                            <th>Edit</th>
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

                                    <?php if ($department_list['department_budget'] == null) {
                                        echo '<span class="badge badge-warning">No Allocated Budget Yet</span>';
                                    } else {
                                        echo '₱' . $department_list['department_budget'];
                                    }; ?>
                                </td>
                                <td>
                                    <?php if ($department_list['department_budget_remaining'] == null) {
                                        echo '<span class="badge badge-warning">No Allocated Budget Yet</span>';
                                    } else {
                                        echo '₱' . $department_list['department_budget_remaining'];
                                    }; ?>
                                </td>

                                <td class="text-center p-1" width="10%">
                                    <a href="<?= base_url('admin/edit-budget/' . $department_list['id']) ?>" title="Update Table" class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal" data-bs-target="#edit_budget">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Edit Modal -->
                <div class="modal fade" id="edit_budget" tabindex="-1" aria-labelledby="edit_inventory_label" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit_inventory_label">Edit Budget</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                                <div class="modal-body">


                                    <input type="hidden" name="department_id" id="department_id_edit">

                                    <div class="form-group mx-3">
                                        <label for="exampleInputEmail1" class="fw-bold">Department
                                            Name</label>
                                        <input type="text" class="form-control" name="department_name" id="department_name_edit" placeholder="Enter Department Name" readonly>
                                        <div class=" invalid-feedback">
                                            Please Provide A Department Name!
                                        </div>

                                    </div>



                                    <div class="form-group mx-3">
                                        <label for="exampleInputEmail1" class="fw-bold">Dean
                                            Email</label>
                                        <input type="text" class="form-control" name="dean_email" id="dean_email_edit" placeholder="Enter Dean Email" readonly>
                                        <div class="invalid-feedback">
                                            Please Provide A Dean Email!
                                        </div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label for="exampleInputEmail1" class="fw-bold">Allocated Budget</label>
                                        <input type="number" class="form-control" name="allocated_budget" id="allocated_budget_edit" placeholder="Enter Allocated Budget" required>
                                        <div class="invalid-feedback">
                                            Please Provide An Allocated Budget
                                        </div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label for="exampleInputEmail1" class="fw-bold">Budget Remaining</label>
                                        <input type="number" class="form-control" name="budget_remaining" id="budget_remaining_edit" placeholder="Enter Remaining Budget" required>
                                        <div class="invalid-feedback">
                                            Please Provide An Allocated Budget
                                        </div>
                                    </div>




                                    <div class="form-group mx-3">
                                        <label for="exampleInputEmail1" class="fw-bold">Department
                                            Image</label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div id="Departmentimage">
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary edit_post_btn" id="edit_post_btn">Edit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- Edit Modal End-->

            </div>
        </div>
    </div>
</div>
<!-- Datatable End -->

<?php $this->endSection() ?>
<?php $this->section('ajax') ?>
<script>
    $(function() {
        //fetch data from table
        $(document).on('click', '.edit_btn', function() {
            const departmentId = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column

            // Make the AJAX request to fetch department data
            $.ajax({
                url: '<?= base_url('admin/edit-budget') ?>',
                type: 'POST',
                data: {
                    'id': departmentId
                },
                success: function(response) {
                    // Populate the form fields with the retrieved data
                    $.each(response, function(key, department_value) {
                        $('#department_id_edit').val(department_value.id);
                        $('#department_name_edit').val(department_value.name);
                        $('#dean_email_edit').val(department_value.email);
                        $('#allocated_budget_edit').val(department_value.department_budget);
                        $('#budget_remaining_edit').val(department_value.department_budget_remaining);

                        $('#Departmentimage').html(`<img class="img-fluid img-thumbnail" width="100" src="<?= base_url('assets/images/uploads/') ?>` + department_value.image + `" />`);
                    })

                    $('#edit_post_form').on('submit', function(e) {
                        e.preventDefault();
                        if (!this.checkValidity()) {
                            $('#edit_post_form').addClass('was-validated');
                            // Use jQuery to add the 'was-validated' class
                        } else {
                            const formData = new FormData(this);
                            $.ajax({
                                url: '<?= base_url('admin/update-budget') ?>',
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
                                            title: 'Budget Not Added',
                                            text: response.message,
                                        });
                                    } else {
                                        swal({
                                            icon: 'success',
                                            title: 'Budget Added',
                                            text: 'Budget Added Successfully'
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


<?php $this->endSection() ?>