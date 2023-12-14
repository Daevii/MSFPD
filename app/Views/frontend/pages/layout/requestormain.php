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
                        <a class="nav-link" href="<?= base_url('requester/dashboard') ?>">
                            <i class="bi bi-bar-chart-line menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Requisition Form</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('requester/requisition') ?>">
                            <i class="menu-icon bi bi-file-earmark-text"></i>
                            <span class="menu-title">Create Requisition</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Track Orders</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('requester/orders') ?>">
                            <i class="menu-icon mdi mdi-home-map-marker"></i>
                            <span class="menu-title">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Approve History</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('requester/backlog') ?>">
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