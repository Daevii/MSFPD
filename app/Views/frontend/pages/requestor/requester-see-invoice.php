 <?= $this->extend('frontend/pages/layout/requestormain'); ?>

 <?php $this->section('content'); ?>

 <div class="col-lg-12 grid-margin stretch-card">
     <div class="card px-2">

         <div class="card-body" id="print">
             <div class="container-fluid" style="background-color: maroon; padding-top: 10px;">
                 <img src="<?= base_url(); ?>/assets/images/lnuhead1 (2).png" alt="" width="40%">
                 <hr>
             </div>
             <?php $idinvoice = 1;
                foreach ($requisitions as $invoices) : ?>
                 <div class="container-fluid d-flex justify-content-between">
                     <div class="col-lg-3 ps-0">
                         <p class="mt-5 mb-2"><b>Lyceum Northwestern University</b></p>
                         <p>Tapuac District,<br>Dagupan City,<br>Pangasinan, Philippines</p>
                     </div>
                     <div class="col-lg-3 pr-0">
                         <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                         <p class="text-right"><?php echo $invoices['department'] ?> ,<br> <?php echo $invoices['name'] ?> ,<br> <?php echo $invoices['email'] ?> .</p>
                         <p class="text-right">Status : <?php $status = $invoices['status'];
                                                        $set_status =  match ($status) {
                                                            'pending' => '<span class="badge bg-warning text-dark fw-bolder text-uppercase"> Pending </span>',
                                                            'approved_by_lower' => '<span class="badge bg-primary text-white fw-bolder text-uppercase"> Approved By Lower</span>',
                                                            'approved_by_upper' => '<span class="badge bg-success text-dark fw-bolder text-uppercase"> Approved By Upper</span>',
                                                            'rejected' => '<span class="badge bg-danger text-white fw-bolder text-uppercase"> Rejected </span>',
                                                            default => '<span class="badge bg-info text-white fw-bolder text-uppercase"> Claimed  </span>',
                                                        };
                                                        echo $set_status; ?></p>
                         <?php if ($status == 'rejected') {
                                echo '<p class="text-right">Reason : ' . $invoices['reason'] . '</p>';
                                if ($invoices['higher_approver_check'] == '') {
                                    echo '<p class="text-right">Rejected By : ' . $invoices['approver_lower_checked_by'] . '</p>';
                                    echo '<p class="text-right"> From :  <b>Lower Approver </b> </p>';
                                    echo '<p class="text-right">Date of Rejection : ' . $invoices['approver_lower_timestamp'] . '</p>';
                                } else {
                                    echo '<p class="text-right">Rejected By : ' . $invoices['approver_higher_checked_by'] . ' </p>';
                                    echo '<p class="text-right"> From : <b> Higher Approver </b> </p>';
                                    echo '<p class="text-right">Date of Rejection : ' . $invoices['approver_higher_timestamp'] . '</p>';
                                }
                            } elseif ($status == 'claimed') {
                                echo '<p class="text-right">Date of Claimed : ' . $invoices['claimed_timestamp'] . '</p>';
                            } ?>
                     </div>
                 </div>
                 <div class=" container-fluid d-flex justify-content-between">
                     <div class="col-lg-3 ps-0">
                         <p class="mb-0 mt-5">Invoice Date : <?php date_default_timezone_set('Asia/Manila');
                                                                echo date('m-d-Y'); ?></p>
                         <p>Date of Order : <?php echo $invoices['created_at']; ?></p>
                         <p>Invoice Reciept : <b> <?php echo $invoices['receipt']; ?></< /p>
                     </div>
                 </div>
                 <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                     <div class="table-responsive w-100">
                         <table class="table table-striped">
                             <thead>
                                 <tr class="text-white" style="background-color: black;">
                                     <th>#</th>
                                     <th>Item</th>
                                     <th class="text-right">Quantity</th>
                                     <th class="text-right">Unit cost</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php

                                    $decodeitem = json_decode($invoices['item']);
                                    $decodequantity = json_decode($invoices['quantity']);
                                    $decodecost = json_decode($invoices['unit_price']);
                                    foreach ($decodeitem as $index => $item) : ?>
                                     <tr class="text-right">
                                         <td class="text-left ml-3">
                                             <p id="depart_id">
                                                 <?= $idinvoice++; ?>
                                             </p>
                                         </td>
                                         <td class="text-left"><?= $item ?></td>
                                         <td class="text-left"><?= $decodequantity[$index] ?></td>
                                         <td class="text-left">₱ <?= $decodecost[$index] ?></td>
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
                 <hr>

                 <div class="container-fluid mt-5 w-100">

                     <p class="text-right mb-2"> Invoice Created By : <?php echo $invoices['created_invoice_by']; ?></p>
                     <h4 class="text-right mb-5"> Total amount: ₱ <?php echo $invoices['total_amount']; ?></h4>
                     <hr>
                 </div>
             <?php endforeach; ?>


         </div>
         <div class="container-fluid justify-content-end w-100 mb-5 ml-3">
             <button class="btn btn-primary float-right mt-4 ms-2" id="print_button"><i class="ti-printer me-1"></i>Save</button>
         </div>
     </div>
 </div>
 <?php $this->endSection() ?>
 <?php $this->section('ajax') ?>
 <script>
     $(document).ready(function() {
         $('#print_button').on('click', function() {

             var printContents = document.getElementById("print").innerHTML;
             var originalContents = document.body.innerHTML;
             var watermark = '<div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 400px; color: rgba(0, 0, 0, 0.2); text-transform: uppercase; transform: rotate(-45deg);">LNU</div>';
             printContents = watermark + printContents;
             document.body.innerHTML = printContents;
             window.print();
             document.body.innerHTML = originalContents;

         })

     })
 </script>
 <?php $this->endSection() ?>