<!-- plugins:js -->
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url('assets/js/jquery.cookie.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/js/template.js') ?>"></script>


<!-- End custom js for this page-->


<script src=" https://kit.fontawesome.com/9cd5a7babb.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- End custom js for this page-->



<!-- dataTables -->

<script src="<?= base_url('assets/extra-libs/datatables.min.js') ?>"></script>


<!-- <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.js"></script> -->
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> <!-- Bootstrap tether Core JavaScript -->

<script>
    let table = new DataTable('#DataTable', {
        order: [
            [0, 'desc']
        ]
    });
</script>