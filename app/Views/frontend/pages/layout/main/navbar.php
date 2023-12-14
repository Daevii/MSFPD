<nav class="navbar navbar-success default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>

    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text text-white">Welcome<span class="text-black fw-bold"><?php
                                                                                            $userType = session()->get('user_type');
                                                                                            $message = match ($userType) {
                                                                                                'approver_higher' => "APPROVER HIGHER",
                                                                                                'approver_lower' => "APPROVER LOWER",
                                                                                                'bookstore' => "BOOKSTORE",
                                                                                                'department' => "DEPARTMENT",
                                                                                                'admin' => "ADMIN",
                                                                                                default => "UNKNOWN USER TYPE",
                                                                                            };
                                                                                            echo $message;
                                                                                            ?></span></h1>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                    <div class="input-group-prepend border-right">
                        <span class="input-group-text calendar-icon">
                            <i class="bi bi-calendar"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control">
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <img class="img-sm rounded-circle" src="<?php echo base_url('assets/images/uploads/') . session()->get('image') ?>" alt="Profile image">
                </a>
            </li>
            <li class="nav-item logout-item">
                <a class="nav-link logout-link" href="<?= base_url('logout') ?>">
                    <span class="mdi mdi-logout logout-icon" style="font-size: 20px;
    color: white; hover: ba"></span>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>