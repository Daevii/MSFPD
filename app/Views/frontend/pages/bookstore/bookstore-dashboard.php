<?= $this->extend('frontend/pages/layout/bookstoremain'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card d-flex align-items-start">
            <div class="card-body">
                <div class="d-flex flex-row align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/images/svg/pending.svg') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder"><?php
                                                    echo count($pending_requisitions); ?> </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-info fw-bold pt-2">Pending Requisition Form</h4>
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
                        <img src="<?= base_url('assets/images/svg/supplier.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                <?php
                                echo $supplier; ?>
                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-secondary fw-bold pt-2">Suppliers</h4>
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
                        <img src="<?= base_url('assets/images/svg/requisition.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                <?php
                                echo count($requisition); ?>
                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-success fw-bold pt-2">Requisition within the last 30 days</h4>
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
                        <img src="<?= base_url('assets/images/svg/inventory.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                <?php
                                echo count($active_inventories); ?>

                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-danger fw-bold pt-2">Active Inventories</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>