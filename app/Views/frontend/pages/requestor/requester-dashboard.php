<?= $this->extend('frontend/pages/layout/requestormain'); ?>

<?php $this->section('content'); ?>


<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card d-flex align-items-start">
            <div class="card-body">
                <div class="d-flex flex-row align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/images/svg/requisition.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder"> <?php echo count($invoice) ?></h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-info fw-bold pt-2">Orders within the last 30 days</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin">
        <div class="card d-flex align-items-start">
            <div class="card-body">
                <div class="d-flex flex-row align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/images/svg/budget.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                ₱ <?php echo $department_budget['department_budget'] ?>

                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-secondary fw-bold pt-2">Department Budget</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card d-flex align-items-start">
            <div class="card-body">
                <div class="d-flex flex-row align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/images/svg/procurement-accept.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                <?php echo count($accepted_order) ?>
                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-success fw-bold pt-2">Accepted Order within the last 30 days</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin">
        <div class="card d-flex align-items-start">
            <div class="card-body">
                <div class="d-flex flex-row align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/images/svg/procurement-reject.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                <?php echo count($rejected_order) ?>
                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-danger fw-bold pt-2">Rejected Order within the last 30 days</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endSection() ?>