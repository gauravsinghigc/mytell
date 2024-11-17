<div class="row">
    <div class='col-md-3'>
        <div class='bg-white shadow-sm p-2 b-r-1'>
            <h1 class='mb-0 mt-2'><?php echo TOTAL("SELECT * FROM campaigns"); ?></h1>
            <p>Total Campaigns</p>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='bg-info shadow-sm p-2 b-r-1'>
            <h1 class='mb-0 mt-2'><?php echo TOTAL("SELECT * FROM campaigns where campaign_status='NEW'"); ?></h1>
            <p>FRESH CAMPAIGNS</p>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='bg-warning shadow-sm p-2 b-r-1'>
            <h1 class='mb-0 mt-2'><?php echo TOTAL("SELECT * FROM campaigns where campaign_status='ACTIVE'"); ?></h1>
            <p>Active Campaigns</p>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='bg-success shadow-sm p-2 b-r-1'>
            <h1 class='mb-0 mt-2'><?php echo TOTAL("SELECT * FROM campaigns where campaign_status='COMPLETED'"); ?></h1>
            <p>Completed</p>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class='col-md-4'>
        <h6 class='app-heading'>All Campaigns</h6>
        <div class='shadow-sm p-2 b-r-1'>
            <input type='search' id='AllCampaigns' oninput="SearchData('AllCampaigns', 'campaigns')" class='form-control' placeholder="Search Campaign...">
            <br>
            <?php
            $AllCampaigns = SET_SQL("SELECT * FROM campaigns ORDER BY campaigns_id DESC", true);
            if ($AllCampaigns != null) {
                foreach ($AllCampaigns as $Campaigns) {
            ?>
                    <a href='?campaignid=<?php echo SECURE($Campaigns->campaigns_id, "e"); ?>' class='campaigns'>
                        <div class='data-list'>
                            <span class='font-italic text-grey small'><?php echo $Campaigns->campaign_ref_no; ?></span>
                            <span class='text-dark bold small pull-right'><?php echo date("d-M-Y", strtotime($Campaigns->campaign_created_at)); ?></span>
                            <h6 class='bold text-dark bold mb-0'><?php echo $Campaigns->campaign_name; ?></h6>
                            <p class="small">
                                <span>
                                    <span class='text-success'><?php echo $Campaigns->campaign_type; ?></span>
                                    <span class='pull-right' style='margin-top:-1rem;'><?php echo CampaignStatus($Campaigns->campaign_status); ?></span>
                                </span>
                                <hr class="mt-1 mb-2">
                                <span class='pt-1'>
                                    <?php echo UserByDetails($Campaigns->campaign_main_user_id); ?>
                                </span>
                            </p>
                        </div>
                    </a>
            <?php
                }
            } else {
                echo "<p>No campaigns found.</p>";
            } ?>
        </div>
    </div>

    <div class="col-md-4">
        <h5 class='app-heading'>Campaign Details</h5>
        <div class='shadow-sm p-2 b-r-1 bg-white'>
            <?php
            if (isset($_GET['campaignid'])) {
                $campaigns_id = SECURE($_GET['campaignid'], "d");
                $CampSQL = "SELECT * FROM campaigns where campaigns_id='$campaigns_id'";
                if (FETCH($CampSQL, "campaigns_id") == null) {
                    header("location: index.php");
                }
            ?>
                <span class='text-secondary font-italic'><?php echo FETCH($CampSQL, "campaign_ref_no"); ?></span>
                <span class='pull-right'><?php echo CampaignStatus(FETCH($CampSQL, "campaign_status")); ?></span>
                <h5 class='bold text-dark bold'><?php echo FETCH($CampSQL, "campaign_name"); ?></h5>
                <p class='pt-2'>
                    <span>
                        <span class='text-secondary'>Campaign Placement/Type</span><br>
                        <span class='text-success bold'><?php echo FETCH($CampSQL, "campaign_type"); ?></span>
                    </span><br><br>
                    <span class="flex-s-b w-100">
                        <span class='w-50'>
                            <span class='text-secondary'>Created At</span><br>
                            <span class='text-dark bold'><?php echo DATE_FORMATES("d-M-Y H:i:s", (FETCH($CampSQL, "campaign_created_at"))); ?></span>
                        </span>
                        <span class='w-50 text-right'>
                            <span class='text-secondary'>Updated At</span><br>
                            <span class='text-dark bold'><?php echo DATE_FORMATES("d-M-Y H:i:s", (FETCH($CampSQL, "campaign_updated_at"))); ?></span>
                        </span>
                    </span><br>
                    <span class="flex-s-b w-100">
                        <span class='w-50'>
                            <span class='text-secondary'>Initiated At</span><br>
                            <span class='text-dark bold'><?php echo DATE_FORMATES("d-M-Y H:i:s", FETCH($CampSQL, "campaign_initiated_at")); ?></span>
                        </span>
                        <span class='w-50 text-right'>
                            <span class='text-secondary'>Ended At</span><br>
                            <span class='text-dark bold'><?php echo DATE_FORMATES("d-M-Y H:i:s", FETCH($CampSQL, "campaign_ended_at")); ?></span>
                        </span>
                    </span>
                    <br>
                    <span class="flex-s-b w-100">
                        <span class='w-50'>
                            <span class='text-secondary'>Created By</span><br>
                            <span class='text-dark bold'><?php echo UserByDetails(FETCH($CampSQL, "campaign_created_by")); ?></span>
                        </span>
                        <span class='w-50 text-right'>
                            <span class='text-secondary'>Created For</span><br>
                            <span class='text-dark bold'><?php echo UserByDetails(FETCH($CampSQL, "campaign_main_user_id")); ?></span>
                        </span>
                    </span><br>
                    <span class="flex-s-b w-100">
                        <span class='w-50'>
                            <span class='text-secondary'>Campaign DP Status</span><br>
                            <span class='text-dark bold'>
                                <?php if (FETCH($CampSQL, "campaign_dp_type") == null) {
                                    echo "NO DP REQUIRED";
                                } else {
                                    echo "DP REQUIRED";
                                }; ?>
                            </span>
                        </span>
                        <span class='w-50 text-right'>
                            <span class='text-secondary'>DP Image</span><br>
                            <span class='text-dark bold'>
                                <?php
                                if (FETCH($CampSQL, "campaign_profile_photo") == null) {
                                    echo "DP NOT AVAILABLE";
                                } else {
                                    echo "<img src='" . STORAGE_URL . "/campaigns" . "/" . FETCH($CampSQL, "campaign_ref_no") . "/" . FETCH($CampSQL, "campaign_profile_photo") . "' class='img-fluid w-50'>
                                    <br>
                                    <a href='" . STORAGE_URL . "/campaigns" . "/" . FETCH($CampSQL, "campaign_ref_no") . "/" . FETCH($CampSQL, "campaign_profile_photo") . "' class='btn btn-xs btn-success'><i class='fa fa-download'></i> Download</a>";
                                } ?>
                            </span>
                        </span>
                    </span>
                </p>

                <div class="mb-3">
                    <h6 class='text-secondary mb-0'>Creatives</h6>
                    <?php
                    $AllCreatives = SET_SQL("SELECT * FROM campaign_creatives where campaign_main_id='$campaigns_id'", true);
                    if ($AllCreatives != null) {
                        foreach ($AllCreatives as $Creative) { ?>
                            <a href="<?php echo STORAGE_URL; ?>/campaigns/<?php echo FETCH($CampSQL, "campaign_ref_no"); ?>/<?php echo $Creative->campaign_creative_file; ?>" download='<?php echo STORAGE_URL; ?>/campaigns/<?php echo FETCH($CampSQL, "campaign_ref_no"); ?>/<?php echo $Creative->campaign_creative_file; ?>'>
                                <span><i class='fa fa-download'></i><?php echo $Creative->campaign_creative_file; ?></span>
                            </a><br>
                    <?php }
                    } else {
                        echo "No Creatives Available!";
                    } ?>
                    <h6 class='text-secondary mt-3 mb-0'>Pdf/Documents</h6>
                    <?php
                    $AllPDFS = SET_SQL("SELECT * FROM campaign_pdf where campaign_main_id='$campaigns_id'", true);
                    if ($AllPDFS != null) {
                        foreach ($AllPDFS as $PDF) { ?>
                            <a href="<?php echo STORAGE_URL; ?>/campaigns/<?php echo FETCH($CampSQL, "campaign_ref_no"); ?>/<?php echo $PDF->campaign_pdf_file; ?>" download='<?php echo STORAGE_URL; ?>/campaigns/<?php echo FETCH($CampSQL, "campaign_ref_no"); ?>/<?php echo $PDF->campaign_pdf_file; ?>'>
                                <span class='flex-s-b'>
                                    <span><i class='fa fa-download'></i> <?php echo $PDF->campaign_pdf_file; ?></span>
                                </span>
                            </a>
                    <?php }
                    } else {
                        echo "No PDF-Document Available!";
                    } ?>

                    <h6 class='text-secondary mb-0 mt-3'>Video Contents</h6>
                    <?php
                    $AllVideos = SET_SQL("SELECT * FROM campaign_videos where campaign_main_id='$campaigns_id'", true);
                    if ($AllVideos != null) {
                        foreach ($AllVideos as $Videos) { ?>
                            <a href="<?php echo STORAGE_URL; ?>/campaigns/<?php echo FETCH($CampSQL, "campaign_ref_no"); ?>/<?php echo $Videos->campaign_video_file; ?>" download='<?php echo STORAGE_URL; ?>/campaigns/<?php echo FETCH($CampSQL, "campaign_ref_no"); ?>/<?php echo $Videos->campaign_video_file; ?>'>
                                <span class='flex-s-b'>
                                    <span><i class='fa fa-download'></i><?php echo $Videos->campaign_video_file; ?></span>
                                </span>
                            </a>
                    <?php }
                    } else {
                        echo "No Video Available!";
                    } ?>
                </div>
                <span class="text-secondary mt-3">Campaign Message/text:</span>
                <div class='bg-white message-height p-2 shadow-sm b-r-1'>
                    <?php echo SECURE(FETCH($CampSQL, "campaign_messages"), "d"); ?>
                </div><BR>
                <span class="text-secondary mt-3">Campaign Data</span><br>
                <span>
                    <textarea rows='20' class="form-control"><?php echo FETCH($CampSQL, "campaign_data"); ?></textarea>
                </span>
            <?php
            } else {
                echo "<h4 class='bold'>No Campaign Selected</h4>";
                echo "<p>Please select any campaign by clicking on it.</p>";
            } ?>
        </div>
    </div>
    <div class='col-md-4'>
        <h5 class='app-heading'>Campaign Send To</h5>
        <?php
        if (isset($_GET['campaignid'])) {
            if (LOGIN_UserType == "Admin") {
                $DataSQL = "SELECT campaign_data, campaign_data_type, send_status  FROM campaign_data where campaign_main_id='$campaigns_id'"; ?>
                <form action='<?php echo CONTROLLER; ?>' method='POST'>
                    <?php echo FormPrimaryInputs(true); ?>
                    <input type="hidden" name='StartId' value='<?php echo FETCH($DataSQL . " ORDER BY campaign_data_id ASC LIMIT 1", "campaign_data_id"); ?>'>
                    <input type='hidden' name='EndId' value='<?php echo FETCH($DataSQL . " ORDER BY campaign_data_id DESC LIMIT 1", "campaign_data_id"); ?>'>
                    <input type='hidden' name='campaigns_id' value='<?php echo $campaigns_id; ?>'>
                    <div class='row'>
                        <div class='form-group col-md-12'>
                            <label>Campaign Name</label>
                            <input type='text' required name='campaign_name' class='form-control' value='<?php echo FETCH($CampSQL, "campaign_name"); ?>'>
                        </div>
                        <div class='form-group col-md-12'>
                            <label>Update Campaign User</label>
                            <select name='campaign_main_user_id' class='form-control' required>
                                <?php
                                $AllUsers = SET_SQL("SELECT * FROM users ORDER BY UserFullName ASC", true);
                                if ($AllUsers != null) {
                                    foreach ($AllUsers as $User) {
                                        if ($User->UserId == FETCH($CampSQL, "campaign_main_user_id")) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option $selected value='" . $User->UserId . "'>" . $User->UserFullName . " - " . $User->UserCompanyName  . "</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6 mb-2'>
                            <label>Total Data/Number Submited</label>
                            <input type='number' name='TotalData' class='form-control' value='<?php echo TOTAL($DataSQL); ?>' readonly>
                        </div>
                        <div class='form-group col-md-6 mb-2'>
                            <label>Campaign Status</label>
                            <select name='status' class='form-control'>
                                <?php echo InputOptions(['Select Status', 'ACTIVE', 'COMPLETED', 'PROCESSING', 'FAILED', 'REJECTED', 'APPROVED'], FETCH($CampSQL, "campaign_status")); ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6 mb-2'>
                            <label>No of Success Data</label>
                            <input type='number' name='campaign_deductions' value='<?php echo FETCH($CampSQL, "campaign_deductions"); ?>' min='0' class='form-control'>
                        </div>
                    </div>
                    <div class='form-group text-right mt-2'>
                        <?php echo CONFIRM_DELETE_POPUP(
                            "remove_camp",
                            [
                                "remove_campaign_permanently" => $campaigns_id,
                            ],
                            "ModuleController",
                            "<i class='fa fa-trash'></i> Remove Campaign",
                            "btn btn-md btn-danger"
                        ); ?>
                        <button type='SUBMIT' id='SubmitButton' onclick="StartProcessing()" name='PROCESS_CAMPAIGN' class='btn btn-md btn-primary'><i class='fa fa-refresh'></i> START PROCESSING</button>
                    </div>
                    <hr>
                </form>
                <hr>
                <h6 class='app-heading'>Add More Data</h6>
                <form action='<?php echo CONTROLLER; ?>' method="POST">
                    <?php echo FormPrimaryInputs(true); ?>
                    <input type='hidden' name='campaigns_id' value='<?php echo $campaigns_id; ?>'>
                    <div class='form-group'>
                        <label>Add More Data</label>
                        <textarea name='campaign_phone_numbers' rows='10' class='form-control'></textarea>
                    </div>
                    <div class='form-group text-right'>
                        <button type='submit' id='AddMoreData' onclick="AddData()" name='ADD_MORE_DATA' class='btn btn-md btn-warning text-white'>Add More Data</button>
                    </div>
                </form>
            <?php } ?>
            <h6 class='app-sub-heading'>Current Data
                <a href="export.php?eid=<?php echo SECURE($campaigns_id, "e"); ?>" target="_blank" class='btn btn-xs btn-danger pull-right' style='margin-top:-0.2rem;'><i class='fa fa-file-export'></i> Export Report</a>
            </h6>
            <div class="shadow-sm p-2 b-r-1">
                <p class='flex-s-b'>
                    <span class='w-50 text-center'>Data</span>
                    <span class='w-50 text-center'>Type</span>
                    <span class='w-50 text-center'>Status</span>
                </p>
                <div class="height-control" style="height:30rem; overflow-y:scroll;">
                    <?php
                    $AllSendToData = SET_SQL($DataSQL, true);
                    if ($AllSendToData != null) {
                        foreach ($AllSendToData as $Data) { ?>
                            <p class='mb-0 flex-s-b'>
                                <span class='w-50 text-center'><?php echo $Data->campaign_data; ?></span>
                                <span class='text-secondary font-italic w-50 text-center'><?php echo $Data->campaign_data_type; ?></span>
                                <span class='w-50 text-center'>
                                    <?php
                                    if ($Data->send_status == null) {
                                        echo "Processing...";
                                    } else if ($Data->send_status == "FAILED") {
                                        echo "<span class='text-danger'><i class='fa fa-warning'></i> UN SENT</span>";
                                    } else {
                                        echo "<span class='text-success'><i class='fa fa-check'></i> SENT</span>";
                                    } ?>
                                </span>
                            </p>
                    <?php }
                    } else {
                        echo "<h3>No Campaign Data found!</h3>";
                    } ?>
                </div>
            </div>
        <?php
        } ?>
    </div>
</div>
<script>
    function StartProcessing() {
        var SubmitButton = document.getElementById("SubmitButton");
        SubmitButton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please wait! Processing...";
    }

    function AddData() {
        var AddMoreData = document.getElementById("AddMoreData");
        AddMoreData.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Inserting...";
    }
</script>