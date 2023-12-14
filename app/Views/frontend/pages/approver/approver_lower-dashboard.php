<?= $this->extend('frontend/pages/layout/approver_lowermain'); ?>

<?php $this->section('approver_content') ?>

<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card d-flex align-items-start">
            <div class="card-body">
                <div class="d-flex flex-row align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/images/svg/procurement-accept.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder">
                                <?php
                                echo count($accepted_invoice);
                                ?>
                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-success fw-bold pt-2">Accepted Procurement Request within the last 30 days</h4>
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
                            <h2 class="fw-bolder"><?php
                                                    echo count($rejected_invoice); ?></h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-danger fw-bold pt-2">Rejected Procurement Request within the last 30 days</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->Section('approver_ajax') ?>

<?= $this->endSection() ?>