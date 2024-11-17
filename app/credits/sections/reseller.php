 <div class='row mt-2 mb-2'>
     <div class='col-md-3'>
         <div class='shadow-sm bg-success p-3 b-r-2'>
             <h1 class='bold b mb-0'><?php echo $TotalCredits = AMOUNT("SELECT * FROM credits where credit_created_by='" . LOGIN_UserId . "'", "credits_numbers"); ?></h1>
             <p>Total Credit Transferred</p>
         </div>
     </div>
     <div class='col-md-3'>
         <div class='shadow-sm bg-info p-3 b-r-2'>
             <h1 class='bold b mb-0'><?php echo $UsedCredits = AMOUNT("SELECT * FROM credits where  credit_created_by='" . LOGIN_UserId . "' and credit_status='USED'", "credits_numbers"); ?></h1>
             <p>Used Credits</p>
         </div>
     </div>
     <div class='col-md-3'>
         <div class='shadow-sm bg-dark p-3 b-r-2'>
             <h1 class='bold b mb-0'><?php echo $UsedCredits = AMOUNT("SELECT * FROM credits where  credit_created_by='" . LOGIN_UserId . "' and credit_status='FRESH'", "credits_numbers"); ?></h1>
             <p>Un Used Credits</p>
         </div>
     </div>
     <div class='col-md-3'>
         <div class='shadow-sm bg-danger p-3 b-r-2'>
             <h1 class='bold b mb-0'><?php echo $UsedCredits = AMOUNT("SELECT * FROM credits where  credit_created_by='" . LOGIN_UserId . "' and credit_status='EXPIRED'", "credits_numbers"); ?></h1>
             <p>Expired Credits</p>
         </div>
     </div>
 </div>

 <div class='row mt-2'>
     <div class="col-md-9">
         <h5 class="app-sub-heading">All Credits History</h5>
         <?php
            $AllCredits = SET_SQL("SELECT * FROM credits where credit_created_by='" . LOGIN_UserId . "' ORDER BY credit_ids  DESC", true);
            if ($AllCredits != null) {
                foreach ($AllCredits as $Credits) {
            ?>
                 <div class="data-list flex-s-b lh-1-1">
                     <span class='w-pr-15'>
                         <span class='text-grey font-italic small'>Credit Ref No</span><br>
                         <span class='small'><?php echo $Credits->credit_ids; ?>/<?php echo $Credits->credit_ref_name; ?></span>
                     </span>
                     <span class='w-pr-10 text-success bold'>
                         <span class='text-grey font-italic small'>Credit Type</span><br>
                         <?php echo $Credits->credit_type_and_for; ?>
                     </span>
                     <span class='w-pr-10'>
                         <span class='text-grey font-italic small'>Create date</span><br>
                         <?php echo DATE_FORMATES("d M, Y", $Credits->credit_date); ?>
                     </span>
                     <span class='w-pr-10'>
                         <span class='text-grey font-italic small'>Expire Date</span><br>
                         <?php echo DATE_FORMATES("d M, Y", $Credits->credit_expire_date); ?>
                     </span>
                     <span class='w-pr-20'>
                         <?php echo UserByDetails($Credits->credit_main_user_id); ?>
                     </span>
                     <span class="w-pr-10">
                         <span class='text-grey font-italic small'>Numbers</span><br>
                         <span class='bold text-primary'><?php echo $Credits->credits_numbers; ?></span>
                     </span>
                     <span class='w-pr-10 pt-1'>
                         <?php echo CreditStatus($Credits->credit_status); ?>
                     </span>
                     <span class='w-pr-10 text-right pt-1'>
                         <a href="?creditid=<?php echo SECURE($Credits->credit_ids, "e"); ?>" class='btn btn-xs btn-default'>View Details <i class='fa fa-angle-right'></i></a>
                     </span>
                 </div>
         <?php
                }
            } else {
                echo NoData("No credit history found!");
            } ?>
     </div>
     <div class="col-md-3">
         <h5 class="app-sub-heading">Credit Details</h5>

         <div class='row'>
             <?php
                if (isset($_GET['creditid'])) {
                    $CreditId = SECURE($_GET['creditid'], "d");
                    $CreditSQL = "SELECT * FROM credits where  credit_created_by='" . LOGIN_UserId . "' and credit_ids='" . $CreditId . "'";
                    $Credit = FETCH($CreditSQL, true); ?>
                 <div class="col-md-12">
                     <div class="shadow-sm p-2 b-r-1">
                         <a href="index.php" class='btn btn-sm btn-danger pull-right'><i class='fa fa-times'></i> Close</a>
                         <p>
                             <span>
                                 <span class='text-secondary'>Credit refid</span><br>
                                 <span class='bold'><?php echo FETCH($CreditSQL, "credit_ids"); ?>/<?php echo FETCH($CreditSQL, "credit_ref_name"); ?></span>
                             </span><br><br>
                             <span>
                                 <span class='text-secondary'>Credit FOR</span><br>
                                 <span class='bold text-success'><?php echo FETCH($CreditSQL, "credit_type_and_for"); ?></span>
                             </span><br><br>
                             <span>
                                 <span class='text-secondary'>Credit Date</span><br>
                                 <span class='bold'><?php echo DATE_FORMATES("d M, Y", FETCH($CreditSQL, "credit_date")); ?></span>
                             </span><br><br>
                             <span>
                                 <span class='text-secondary'>Expire Date</span><br>
                                 <span class='bold'><?php echo DATE_FORMATES("d M, Y", FETCH($CreditSQL, "credit_expire_date")); ?></span>
                             </span>
                             <br><br>
                             <span>
                                 <span class='text-secondary'>Credited By</span><br>
                                 <span class='bold'><?php echo UserByDetails(FETCH($CreditSQL, "credit_created_by")); ?></span>
                             </span>
                             <br><br>
                             <span>
                                 <span class='text-secondary'>Credited To</span><br>
                                 <span class='bold'><?php echo UserByDetails(FETCH($CreditSQL, "credit_main_user_id")); ?></span>
                             </span><br><br>
                             <span>
                                 <span class='text-secondary'>Credit Numbers</span><br>
                                 <span class='bold text-primary'><?php echo FETCH($CreditSQL, "credits_numbers"); ?></span>
                             </span><br><br>
                             <span>
                                 <span class='text-secondary'>Credit Status</span><br>
                                 <span class='bold'><?php echo CreditStatus(FETCH($CreditSQL, "credit_status")); ?></span>
                             </span><br><br>
                             <span>
                                 <span class='text-secondary'>Transaction Details</span><br>
                                 <span class='bold'><?php echo SECURE(FETCH($CreditSQL, "credit_transaction_details"), "d"); ?></span>
                             </span>
                         </p>
                     </div>
                 </div>
             <?php
                } else {
                    echo NoData("No Credit Record select!");
                } ?>
         </div>
     </div>
 </div>