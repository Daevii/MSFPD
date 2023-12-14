<?= $this->include('frontend/pages/layout/main/header') ?>

<body class="sidebar-dark">
    <div class="container-scroller">

        <!-- NAVBAR DITO -->
        <?= $this->include('frontend/pages/layout/main/navbar') ?>


        <div class="container-fluid page-body-wrapper dark">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item" id="dashboard">
                        <a class="nav-link" href="<?= base_url('approver/lower/dashboard') ?>">
                            <i class="bi bi-bar-chart-line menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Budget</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('approver/lower/budget') ?>">
                            <i class=" menu-icon bi bi-cash-coin"></i>
                            <span class="menu-title">Budget Management</span>
                        </a>

                    </li>
                    <li class="nav-item nav-category">Requisition Request</li>
                    <li class="nav-item" id="requisition">
                        <a class="nav-link" href="<?= base_url('approver/lower/accept') ?>">
                            <i class="menu-icon bi bi-clipboard-check"></i>
                            <span class="menu-title">Requisition Approval</span>
                        </a>
                    </li>


                    </li>
                    <li class="nav-item nav-category">Approve History</li>
                    <li class="nav-item" id="backlog">
                        <a class="nav-link" href="<?= base_url('approver/lower/backlog') ?>">
                            <i class="menu-icon mdi mdi-backup-restore"></i>
                            <span class="menu-title">Backlog</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $this->renderSection('approver_content') ?>

                </div>

                <?= $this->include('frontend/pages/layout/main/footer'); ?>
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
</body>

<?= $this->include('frontend/pages/layout/main/scripts'); ?>
<?php $this->renderSection('ajax'); ?>

</html>