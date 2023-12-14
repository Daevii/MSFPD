<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>
<?= $this->section('content'); ?>

<!-- Breadcrums Start -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('bookstore/dashboard'); ?>" class="link-light">Home</a></li>
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
            <h5 class="card-title">Department Budget</h5>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Department</th>
                            <th>Allocated Budget</th>
                            <th>Budget Remaining</th>
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

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->renderSection('ajax'); ?>

<?= $this->endSection(); ?>