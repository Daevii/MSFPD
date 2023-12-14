<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>

<?php $this->section('content'); ?>

<!-- Your content goes here -->

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Inventory</li>
    </ol>
</nav>

<!-- Breadcrums End -->

<!-- Datatable Start -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="card-body">
                <h4 class="card-title">Inventory Management<button class="btn btn-success btn-sm mx-3 px-2" id="inventory" data-bs-toggle="modal" data-bs-target="#add_inventory">
                        <strong>+ADD</strong></button> </h4>
                <div class="table-responsive">
                    <table id="DataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item</th>
                                <th>Brand</th>
                                <th>Unit Price</th>
                                <th>Stock</th>
                                <th>Inventory Value</th>
                                <th class="text-center p-1" width="10%">Description</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 1;
                            foreach ($inventory as $inventory_list) : ?>
                                <tr>
                                    <td class="text-center p-1">
                                        <div style="visibility: hidden">
                                            <?= $inventory_list['id'] ?>
                                        </div>
                                        <p id="depart_id">
                                            <?= $id++; ?>
                                        </p>
                                    </td>
                                    <td><?= $inventory_list['item'] ?></td>
                                    <td><?= $inventory_list['brand'] ?></td>
                                    <td><i class="fa-solid fa-peso-sign"></i> <?= $inventory_list['unit_price'] ?></td>
                                    <td><?= $inventory_list['stock'] ?></td>

                                    <td><i class="fa-solid fa-peso-sign"></i> <?= $inventory_list['unit_price'] * $inventory_list['stock'] ?></td>
                                    <td> <?php
                                            $description = $inventory_list['description'];
                                            if ($description == 'No Description') {
                                                echo '<span class="badge bg-dark">NO DESCRIPTION</span>';
                                            } else {
                                                if (strlen($description) > 50) {
                                                    $wrappedDescription = wordwrap($description, 40, "<br>", true);
                                                    echo '<span class="text-sm">' . $wrappedDescription . '</span>';
                                                } else {
                                                    echo $description;
                                                }
                                            }
                                            ?>
                                    </td>
                                    <td class="text-center p-1">
                                        <?php if ($inventory_list['status'] == 'active') {
                                            echo '<span class="badge bg-success">Active</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Inactive</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center p-1" width="10%">
                                        <a href="<?= base_url('admin/edit-inventory /' . $inventory_list['id']) ?>" title="Update Table" class="btn btn-warning btn-sm edit_btn" data-bs-toggle="modal" data-bs-target="#edit_inventory">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm delete_btn" title="Delete Table">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <tbody>
                    </table>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit_inventory" tabindex="-1" aria-labelledby="edit_inventory_label" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_inventory_label">Edit Inventory</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                                    <div class="modal-body">
                                        <div class="card card-warning">
                                            <div class="card-header mb-3">
                                                <h3 class="card-title">Edit inventory</h3>
                                            </div>
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <input type="hidden" name="inventory_id" id="inventory_id">
                                            <div class="form-group mx-3">
                                                <label for="item_name" class="fw-bold">Item Name</label>
                                                <input type="text" class="form-control" name="item" id="item_name" placeholder="Enter Item Name" required>
                                                <div class="invalid-feedback">
                                                    Please provide an Item name!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="brand" class="fw-bold">Brand</label>
                                                <input type="text" class="form-control" name="brand" id="brand" placeholder="Enter Brand" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Brand!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="unit_price" class="fw-bold">Unit Price</label>
                                                <input type="text" class="form-control" name="unit_price" id="unit_price" placeholder="Enter Unit Price" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Unit Price!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="stock" class="fw-bold">Stock</label>
                                                <input type="text" class="form-control" name="stock" id="stock" placeholder="Enter Stock" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Stock!
                                                </div>
                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="description" class="fw-bold">Description</label>
                                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description">

                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="status" class="fw-bold">Status</label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please choose a Status!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary edit_inventory_btn" id="edit_inventory_btn">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal End-->

                    <!-- Add Modal -->
                    <div class="modal fade" id="add_inventory" tabindex="-1" aria-labelledby="edit_inventory_label" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add_inventory_label">Add Inventory</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('admin/add-inventory'); ?>" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                                    <div class="modal-body">
                                        <div class="card card-warning">
                                            <div class="card-header mb-3">
                                                <h3 class="card-title">Add inventory</h3>
                                            </div>
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <div class="form-group mx-3">
                                                <label for="item_name" class="fw-bold">Item Name</label>
                                                <input type="text" class="form-control" name="item" id="item_name" placeholder="Enter Item Name" required>
                                                <div class="invalid-feedback">
                                                    Please provide an Item name!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="brand" class="fw-bold">Brand</label>
                                                <input type="text" class="form-control" name="brand" id="brand" placeholder="Enter Brand" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Brand!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="unit_price" class="fw-bold">Unit Price</label>
                                                <input type="text" class="form-control" name="unit_price" id="unit_price" placeholder="Enter Unit Price" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Unit Price!
                                                </div>
                                            </div>
                                            <div class="form-group mx-3">
                                                <label for="stock" class="fw-bold">Stock</label>
                                                <input type="text" class="form-control" name="stock" id="stock" placeholder="Enter Stock" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Stock!
                                                </div>
                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="description" class="fw-bold">Description</label>
                                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description">

                                            </div>

                                            <div class="form-group mx-3">
                                                <label for="status" class="fw-bold">Status</label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please choose a Status!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary add_inventory_btn" id="add_inventory_btn">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Add Modal End-->
                    </div>
                </div>
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
                url: '<?= base_url('add-inventory') ?>',
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
                            title: 'Inventory Not Added',
                            text: response.message,
                        });
                    } else {
                        swal({
                            icon: 'success',
                            title: 'Inventory Added',
                            text: 'Inventory Added Successfully'
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
    $(function() {
        //fetch data from table
        $(document).on('click', '.edit_btn', function() {
            const inventory_id = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the inventory ID is in the first column

            // Make the AJAX request to fetch inventory data
            $.ajax({
                url: '<?= base_url('edit-inventory') ?>',
                type: 'POST',
                data: {
                    'inventory_id': inventory_id
                },
                success: function(response) {
                    // Populate the form fields with the retrieved data
                    $.each(response, function(key, inventory_value) {
                        $('#inventory_id').val(inventory_value.id);
                        $('#item_name').val(inventory_value.item);
                        $('#brand').val(inventory_value.brand);
                        $('#unit_price').val(inventory_value.unit_price);
                        $('#stock').val(inventory_value.stock);
                        if (inventory_value.description == 'No Description') {
                            $('#description').val('');
                        } else {
                            $('#description').val(inventory_value.description);
                        }
                        $('#status').val(inventory_value.status);
                    })

                    $('#edit_post_form').on('submit', function(e) {
                        e.preventDefault();
                        if (!this.checkValidity()) {
                            $('#edit_post_form').addClass('was-validated');
                            // Use jQuery to add the 'was-validated' class
                        } else {
                            const formData = new FormData(this);
                            $.ajax({
                                url: '<?= base_url('update-inventory') ?>',
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
                                            title: 'Inventory Not Updated',
                                            text: response.message,
                                        });
                                    } else {
                                        swal({
                                            icon: 'success',
                                            title: 'Inventory Updated',
                                            text: 'Inventory Updated Successfully'
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
        const invertoryID = $(this).closest('tr').find('td:eq(0)').text(); // Assuming the department ID is in the first column

        swal({
                title: "Delete inventory?",
                text: "Are you sure you want to delete the approver?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url('delete-inventory') ?>',
                        type: 'POST',
                        data: {
                            'inventory_id': invertoryID
                        },
                        success: function(response) {
                            swal("inventory Deleted", {
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