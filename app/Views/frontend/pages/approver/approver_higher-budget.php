<?= $this->extend('frontend/pages/layout/approver_highermain'); ?>

<?php $this->section('approver_content') ?>
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
<?= $this->endSection() ?>