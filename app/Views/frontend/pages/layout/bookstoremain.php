<?= $this->include('frontend/pages/layout/main/header') ?>

<body class="sidebar-dark">
    <div class="container-scroller">

        <!-- NAVBAR DITO -->
        <?= $this->include('frontend/pages/layout/main/navbar') ?>


        <div class="container-fluid page-body-wrapper dark">

            <!-- SIDEBAR NAV DITO -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/dashboard') ?>">
                            <i class="bi bi-bar-chart-line menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Monitor</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-monitor"></i>
                            <span class="menu-title">Monitor Request</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">

                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('bookstore/monitor/approvers/lower') ?>">Lower Approver</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('bookstore/monitor/approvers/higher') ?>">Higher Approver</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('bookstore/monitor/requestors') ?>">Requesters</a></li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item nav-category">Invoice</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/request-form') ?>">
                            <i class="menu-icon mdi mdi-account-key"></i> <span class="menu-title">Requisition From</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Orders</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/orders/claim') ?>">
                            <i class="menu-icon mdi mdi-cube-send"></i>
                            <span class="menu-title">Claim Order</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Inventory</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/inventory') ?>">
                            <i class="menu-icon bi bi-boxes"></i>
                            <span class="menu-title">Inventory Management</span>
                        </a>
                    </li>

                    </li>
                    <li class="nav-item nav-category">Supplier</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/supplier') ?>">
                            <i class="menu-icon bi bi-truck-flatbed"></i>
                            <span class="menu-title">Supplier Management</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Budget</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/budget') ?>">
                            <i class="menu-icon bi bi-cash-coin"></i>
                            <span class="menu-title">Budget Management</span>
                        </a>

                    </li>

                    <li class="nav-item nav-category">Backlog</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookstore/backlog') ?>">
                            <i class="menu-icon mdi mdi-backup-restore"></i>
                            <span class="menu-title">Backlog</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php $this->renderSection('content'); ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->

                <?= $this->include('frontend/pages/layout/main/footer'); ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


</body>
<?= $this->include('frontend/pages/layout/main/scripts'); ?>


<?php $this->renderSection('ajax'); ?>

</html>