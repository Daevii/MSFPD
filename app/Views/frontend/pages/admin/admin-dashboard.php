<?= $this->extend('frontend/pages/layout/adminmain'); ?>

<?php $this->section('content'); ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-8 grid-margin">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash">Orders Created in the last 12 months</h4>
                <div class="chart-container">
                    <canvas id="orderChart" class="chartjs-responsive"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title card-title-dash">Which department have the most orders in the last 12 months</h4>
                <div class="chart-container">
                    <canvas id="pieChart" class="chartjs-responsive"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Department Orders within 1 Year</h4>
                                <p class="card-subtitle card-subtitle-dash"></p>
                            </div>
                        </div>
                        <div class="table-responsive mt-1">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Number of Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($department_invoices as $dept_list) : ?>
                                        <tr>
                                            <td><?php echo $dept_list['department']; ?></td>
                                            <td><?php echo ($dept_list['count']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                        <img src="<?= base_url('assets/images/svg/pending.svg') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder"><?php // count the rows in the table 
                                                    echo count($invoice_pending); ?></h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-info fw-bold pt-2">Pending Procurement Requisition</h4>
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
                        <img src="<?= base_url('assets/images/svg/invoice.png') ?>" width="40" height="40" class="text-white" alt="">
                        <div class="ms-3 pt-2">
                            <h2 class="fw-bolder"> <?php // count the rows in the table 
                                                    echo count($requisition); ?></h2>
                        </div>
                        <div class="ms-2">

                            <h4 class="text-secondary fw-bold pt-2">Invoice Created within the last 30 days</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Pending Reqiuistion</h4>
                                <p class="card-subtitle card-subtitle-dash"></p>
                            </div>
                        </div>
                        <div class="table-responsive  mt-1">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold">Receipt#</th>
                                        <th>Department</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($invoice_pending as $invoice_list) : ?>

                                        <tr>
                                            <td><?php echo $invoice_list['receipt_num']; ?></td>
                                            <td><?php echo $invoice_list['department']; ?></td>
                                            <td>
                                                <?php
                                                $decodeitem = json_decode($invoice_list['item']);
                                                foreach ($decodeitem as $item) {
                                                    echo $item . ',<br><br>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $decodequantity = json_decode($invoice_list['quantity']);
                                                foreach ($decodequantity as $quantity) {
                                                    echo $quantity . ',<br><br>';
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Invoice Created</h4>
                                <p class="card-subtitle card-subtitle-dash"></p>
                            </div>
                        </div>
                        <div class="table-responsive  mt-1">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Receipt#</th>
                                        <th>Department</th>
                                        <th>Item</th>
                                        <th>Quantity</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($requisition as $requisition) : ?>

                                        <tr>
                                            <td><?php echo $requisition['receipt_num']; ?></td>
                                            <td><?php echo $requisition['department']; ?></td>
                                            <td>
                                                <?php
                                                $decodeitem = json_decode($requisition['item']);
                                                foreach ($decodeitem as $item) {
                                                    echo $item . ',<br><br>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $decodequantity = json_decode($requisition['quantity']);
                                                foreach ($decodequantity as $quantity) {
                                                    echo $quantity . ',<br><br>';
                                                }
                                                ?>
                                            </td>


                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                                <?php
                                echo count($accepted_invoice);
                                ?>
                            </h2>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-success fw-bold pt-2">Accepted Procurement Order within the last 30 days</h4>
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
                            <h4 class="text-danger fw-bold pt-2">Rejected Procurement Order within the last 30 days</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Accepted Order</h4>
                                <p class="card-subtitle card-subtitle-dash"></p>
                            </div>
                        </div>
                        <div class="table-responsive  mt-1">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Receipt#</th>
                                        <th>Department</th>
                                        <th>Lower Approved by</th>
                                        <th>Higher Approved by</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($accepted_invoice as $accepted) : ?>
                                        <tr>
                                            <td><?php echo $accepted['receipt']; ?></td>
                                            <td><?php echo $accepted['department']; ?></td>
                                            <td><?php echo $accepted['approver_lower_checked_by']; ?></td>
                                            <td><?php echo $accepted['approver_higher_checked_by']; ?></td>
                                        </tr>
                                    <?php endforeach;
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Rejected Order</h4>
                                <p class="card-subtitle card-subtitle-dash"></p>
                            </div>
                        </div>
                        <div class="table-responsive  mt-1">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Receipt#</th>
                                        <th>Department</th>
                                        <th>Rejected by</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rejected_invoice as $rejected) : ?>
                                        <tr>
                                            <td><?php echo $rejected['receipt']; ?></td>
                                            <td><?php echo $rejected['department']; ?></td>
                                            <td><?php if ($rejected['lower_approver_check'] == "Rejected") {
                                                    echo $rejected['approver_lower_checked_by'];
                                                } else if ($rejected['higher_approver_check'] == "Rejected") {
                                                    echo $rejected['approver_higher_checked_by'];
                                                } ?></td>
                                            <td><?php echo $rejected['reason']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection() ?>

<?php $this->section('ajax') ?>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    // Get the monthly invoice data from the PHP variable
    var monthlyInvoices = <?php echo json_encode($monthly_invoices); ?>;

    // Extract the month and count values from the data
    var months = monthlyInvoices.map(function(invoice) {
        return invoice.month;
    });

    var counts = monthlyInvoices.map(function(invoice) {
        return invoice.count;
    });

    // Create the chart using Chart.js
    var ctx = document.getElementById('orderChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Number of Orders',
                data: counts,
                backgroundColor: 'maroon',
                borderColor: '#282828',
                borderWidth: 3,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                },


            }
        }
    });
</script>


<script>
    // Get the department invoice data from the PHP variable
    var departmentInvoices = <?php echo json_encode($department_invoices); ?>;

    // Extract the department names and order counts from the data
    var departmentNames = departmentInvoices.map(function(invoice) {
        return invoice.department;
    });

    var orderCounts = departmentInvoices.map(function(invoice) {
        return invoice.count;
    });

    // Create the chart using Chart.js
    var ctx = document.getElementById('pieChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: departmentNames,
            datasets: [{
                label: 'Number of Orders',
                data: orderCounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 0.1)',
                    'rgba(255, 99, 132, 0.1)',
                    'rgba(54, 162, 235, 0.1)',
                    'rgba(255, 206, 86, 0.1)',
                    'rgba(75, 192, 192, 0.1)',
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                responsive: true,
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
<?php $this->endSection() ?>
