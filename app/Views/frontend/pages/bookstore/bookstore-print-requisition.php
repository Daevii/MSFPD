 <?= $this->extend('frontend/pages/layout/bookstoremain'); ?>

 <?php $this->section('content'); ?>

 <div class="col-lg-12 grid-margin stretch-card">
     <div class="card px-2">

         <div class="card-body" id="print">
             <div class="container-fluid" style="background-color: maroon; padding-top: 10px;">
                 <img src="<?= base_url(); ?>/assets/images/lnuhead1 (2).png" alt="" width="40%">
                 <hr>
             </div>
             <!-- Add the watermark div here -->

             <?php $idinvoice = 1;
                foreach ($print as $print_order) : ?>
                 <div class="container-fluid d-flex justify-content-between">
                     <div class="col-lg-3 ps-0">
                         <p class="mt-5 mb-2"><b>Lyceum Northwestern University</b></p>
                         <p>Tapuac District,<br>Dagupan City,<br>Pangasinan, Philippines</p>
                     </div>
                     <div class="col-lg-3 pr-0">
                         <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                         <p class="text-right"><?php echo $print_order['department'] ?> ,<br> <?php echo $print_order['requestor_name'] ?> ,<br> <?php echo $print_order['requestor_email'] ?> . </p>
                         <!-- Set Status -->
                         <p class="text-right">Status : <?php $status = $print_order['status'];
                                                        $set_status =  match ($status) {
                                                            'pending' => '<span class="badge bg-warning text-dark fw-bolder text-uppercase"> Pending </span>',
                                                            'approved_by_lower' => '<span class="badge bg-primary text-white fw-bolder text-uppercase"> Approved By Lower</span>',
                                                            'approved_by_upper' => '<span class="badge bg-success text-dark fw-bolder text-uppercase"> Approved By Upper</span>',
                                                            'rejected' => '<span class="badge bg-danger text-white fw-bolder text-uppercase"> Rejected </span>',
                                                            default => '<span class="badge bg-info text-white fw-bolder text-uppercase"> Claimed  </span>',
                                                        };
                                                        echo $set_status; ?></p>


                     </div>
                 </div>
                 <div class=" container-fluid d-flex justify-content-between">
                     <div class="col-lg-3 ps-0">
                         <p class="mb-0 mt-5">Invoice Date : <?php date_default_timezone_set('Asia/Manila');
                                                                echo date('m-d-Y'); ?></p>
                         <p>Date of Order : <?php echo $print_order['created_at']; ?></p>
                         <p>Invoice Reciept : <b> <?php echo $print_order['receipt_num']; ?></< /p>
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

                                    $decodeitem = json_decode($print_order['item']);
                                    $decodequantity = json_decode($print_order['quantity']);
                                    $decodecost = json_decode($print_order['reason']);
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
                 <!-- output the cost of the items -->
                 <div class="container-fluid mt-5 w-100">

                     <p class="text-right mb-2"> Printed By : <?php echo session()->get('name'); ?></p>
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
 <!-- function of this script is to print  -->
 <script>
     $(document).ready(function() {
         $('#print_button').on('click', function() {
             var printContents = document.getElementById("print").innerHTML;
             var originalContents = document.body.innerHTML;

             // Add the watermark before printing
             var watermark = '<div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 400px; color: rgba(0, 0, 0, 0.2); text-transform: uppercase; transform: rotate(-45deg);">LNU</div>';
             printContents = watermark + printContents;

             document.body.innerHTML = printContents;
             window.print();
             document.body.innerHTML = originalContents;
         })
     })
 </script>
 <?php $this->endSection() ?>