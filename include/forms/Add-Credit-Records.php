<section class="pop-section hidden" id="AddCreditForTheirUsers">
    <div class="action-window">
        <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class="flex-s-b">
                        <h4 class='app-heading w-pr-100 m-b-0'>Add Credits</h4>
                        <a onclick="Databar('AddCreditForTheirUsers')" class="btn btn-sm btn-danger ml-1"><i class="fa fa-times fs-25"></i></a>
                    </div>
                </div>
            </div>
            <form class="row mt-3" action="<?php echo CONTROLLER; ?>" method="POST">
                <?php

                if (!isset($_SESSION['CREDIT_REF_NO'])) {
                    $CreditRefNo = "CREDIT" . date("dmY") . rand(11111, 999999);
                    $_SESSION['CREDIT_REF_NO'] = $CreditRefNo;
                } else {
                    $_SESSION['CREDIT_REF_NO'] = $_SESSION['CREDIT_REF_NO'];
                }
                echo FormPrimaryInputs(true, [
                    "credit_ref_name" => $_SESSION['CREDIT_REF_NO']
                ]); ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class='col-md-5'>
                            <H5 class='app-sub-heading'>Credit Send to</H5>
                            <div class='flex-s-b'>
                                <div class='w-pr-50 m-1'>
                                    <a class='btn btn-sm btn-info btn-block' onclick="GetUserOptions(RESELLERS_BTN)" id='RESELLERS_BTN'>RESELLERS</a>
                                </div>
                                <div class='w-pr-50 m-1'>
                                    <a class='btn btn-sm btn-default btn-block' onclick="GetUserOptions(USER_BTN)" id='USER_BTN'>USERS</a>
                                </div>
                            </div>
                            <div class='' id='RESELLER_LIST'>
                                <div class='shadow-sm p-2 b-r-1'>
                                    <input type='search' class='form-control' id='SearchResellers' oninput="SearchData('SearchResellers', 'resellers')" placeholder="Search Resellers...">
                                    <div class="height-control pt-2">
                                        <?php
                                        if (LOGIN_UserType == "RESELLER") {
                                            $ResellerSQL = "SELECT * FROM users WHERE UserType='RESELLER' AND UserCreatedBy='" . LOGIN_UserId . "' ORDER BY UserFullName ASC";
                                        } else {
                                            $ResellerSQL = "SELECT * FROM users where UserType='RESELLER' OR UserType='Admin' ORDER BY UserFullName ASC";
                                        }
                                        $AllResellers = SET_SQL($ResellerSQL, true);
                                        if ($AllResellers != null) {
                                            foreach ($AllResellers as $Resellers) { ?>
                                                <div class='resellers'>
                                                    <label class='data-list flex-s-b w-100'>
                                                        <span class='w-pr-15 p-1 text-center'>
                                                            <input type='checkbox' style='width:3rem;height:3rem;' name='USERS_ID[]' value='<?php echo $Resellers->UserId; ?>'>
                                                        </span>
                                                        <span class='w-pr-85 text-left'>
                                                            <h6 class='bold mb-0 text-primary'>
                                                                <?php echo $Resellers->UserSalutation; ?> <?php echo $Resellers->UserFullName; ?>
                                                                <span class='pull-right text-secondary font-italic fs-12'><?php echo $Resellers->UserCompanyName; ?></span>
                                                            </h6>
                                                            <p class='mb-0 text-secondary fs-12'>
                                                                <?php echo $Resellers->UserPhoneNumber; ?><br>
                                                                <span class='pull-right text-info' style='margin-top:-1rem;'><?php echo $Resellers->UserType; ?></span>
                                                                <?php echo $Resellers->UserEmailId; ?>
                                                            </p>
                                                        </span>
                                                    </label>
                                                </div>
                                        <?php    }
                                        } else {
                                            echo NoData("No Reseller Found!");
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class='hidden' id='USERS_LIST'>
                                <div class="shadow-sm p-2 b-r-1">
                                    <input type='search' class='form-control' id='SearchUsers' oninput="SearchData('SearchUsers', 'users')" placeholder="Search Users...">
                                    <div class="height-control pt-2">
                                        <?php
                                        if (LOGIN_UserType == "RESELLER") {
                                            $UsersSQL = "SELECT * FROM users WHERE UserType='USER' AND UserCreatedBy='" . LOGIN_UserId . "' ORDER BY UserFullName ASC";
                                        } else {
                                            $UsersSQL = "SELECT * FROM users where UserType='USER' ORDER BY UserFullName ASC";
                                        }
                                        $UsersSQL = SET_SQL($UsersSQL, true);
                                        if ($UsersSQL != null) {
                                            foreach ($UsersSQL as $UsersData) { ?>
                                                <div class='users'>
                                                    <label class='data-list flex-s-b w-100'>
                                                        <span class='w-pr-15 p-1 text-center'>
                                                            <input type='checkbox' style='width:3rem;height:3rem;' name='USERS_ID[]' value='<?php echo $UsersData->UserId; ?>'>
                                                        </span>
                                                        <span class='w-pr-85 text-left'>
                                                            <h6 class='bold mb-0 text-primary'>
                                                                <?php echo $UsersData->UserSalutation; ?> <?php echo $UsersData->UserFullName; ?>
                                                                <span class='pull-right text-secondary font-italic fs-12'><?php echo $UsersData->UserCompanyName; ?></span>
                                                            </h6>
                                                            <p class='mb-0 text-secondary fs-12'>
                                                                <?php echo $UsersData->UserPhoneNumber; ?><br>
                                                                <span class='pull-right text-info' style='margin-top:-1rem;'><?php echo $UsersData->UserType; ?></span>
                                                                <?php echo $UsersData->UserEmailId; ?>
                                                            </p>
                                                        </span>
                                                    </label>
                                                </div>
                                        <?php    }
                                        } else {
                                            echo NoData("No Reseller Found!");
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-7'>
                            <h5 class='app-sub-heading'>Add Credit Details</h5>

                            <div class='shadow-sm p-2 b-r-1'>
                                <div class='row'>
                                    <div class='col-md-4 form-group'>
                                        <label>Credit for</label>
                                        <select name='credit_type_and_for' class='form-control'>
                                            <?php echo InputOptions(["WHATSAPP"], "WHATSAPP"); ?>
                                        </select>
                                    </div>
                                    <div class='col-md-4 form-group'>
                                        <label>Credit Number</label>
                                        <input type='number' name='credits_numbers' class='form-control' min='1' required=''>
                                    </div>
                                    <div class='col-md-4 form-group'>
                                        <label>Expire Date</label>
                                        <input type='date' value='<?php echo DATE("Y-m-d", strtotime("+1 year")); ?>' name='credit_expire_date' class='form-control' required=''>
                                    </div>

                                    <div class='col-md-12 form-group mt-2'>
                                        <label>Transaction Details</label>
                                        <textarea name='credit_transaction_details' rows='5' class='form-control'></textarea>
                                    </div>

                                    <div class='col-md-3 form-group mt-3'>
                                        <label>Credit Status</label>
                                        <select name='credit_status' class='form-control'>
                                            <?php echo InputOptions(["FRESH", "EXPIRED", "USED"], "FRESH"); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-right">
                    <hr>
                    <a href="#" onclick="Databar('AddCreditForTheirUsers')" class="btn btn-md btn-default">Cancel</a>
                    <button type="submit" name="AddCreditToUserAccounts" class="btn btn-md btn-success"><i class="fa fa-check"></i> Transfer Credits</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function GetUserOptions(data) {

        if (data == RESELLERS_BTN) {
            document.getElementById("RESELLERS_BTN").classList.remove("btn-default");
            document.getElementById("RESELLERS_BTN").classList.add('btn-info');
            document.getElementById("USER_BTN").classList.remove("btn-info");
            document.getElementById("USER_BTN").classList.add('btn-default');

            document.getElementById("RESELLER_LIST").style.display = "block";
            document.getElementById("USERS_LIST").style.display = "none";

        } else if (data == USER_BTN) {
            document.getElementById("USER_BTN").classList.remove("btn-default");
            document.getElementById("USER_BTN").classList.add('btn-info');
            document.getElementById("RESELLERS_BTN").classList.remove("btn-info");
            document.getElementById("RESELLERS_BTN").classList.add('btn-default');

            document.getElementById("RESELLER_LIST").style.display = "none";
            document.getElementById("USERS_LIST").style.display = "block";
        }

    }
</script>