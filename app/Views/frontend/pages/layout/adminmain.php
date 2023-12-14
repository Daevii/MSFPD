<?= $this->include('frontend/pages/layout/main/header') ?>


<body class="sidebar-dark">
    <div class="container-scroller">

        <!-- NAVBAR DITO -->
        <?= $this->include('frontend/pages/layout/main/navbar') ?>

        <div class="container-fluid page-body-wrapper dark">

            <!-- SIDEBAR NAV DITO -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Home</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                            <i class="bi bi-bar-chart-line menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Requisition and Approval</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#requisition" aria-expanded="false" aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-monitor"></i>
                            <span class="menu-title">Monitor Request</span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="collapse" id="requisition">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/monitor/approvers/lower') ?>">Lower Approver</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/monitor/approvers/higher') ?>">Higher Approver</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/monitor/requestor') ?>">Requestors</a></li>

                            </ul>
                        </div>

                    </li>
                    <li class="nav-item nav-category">User</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#users_list" aria-expanded="false" aria-controls="users_list">
                            <i class="menu-icon bi bi-person-circle"></i>
                            <span class="menu-title">User Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="users_list">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/approvers') ?>"> Approvers</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/bookstore') ?>"> Bookstore</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/department') ?>">Department</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/staff') ?>"> Staff</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-category">Inventory</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/inventory') ?>">
                            <i class="menu-icon bi bi-boxes"></i>
                            <span class="menu-title">Inventory Management</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Supplier</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/supplier') ?>">
                            <i class="menu-icon bi bi-truck-flatbed"></i>
                            <span class="menu-title">Supplier Management</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Budget</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/budget/allocation') ?>">
                            <i class=" menu-icon bi bi-cash-coin"></i>
                            <span class="menu-title">Budget Management</span>
                        </a>

                    </li>

                    <li class="nav-item nav-category">Backlog</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/backlog') ?>">
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

<?= $this->include('frontend/pages/layout/main/scripts') ?>
<?php $this->renderSection('ajax'); ?>