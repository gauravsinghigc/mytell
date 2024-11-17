<?php
if (isset($_POST['AddCreditToUserAccounts'])) {
    foreach ($_POST['USERS_ID'] as $credit_main_user_id) {
        $credit_ref_name = SECURE($_POST['credit_ref_name'], "d");
        $credits = [
            "credit_ref_name" => $credit_ref_name,
            "credit_type_and_for" => $_POST['credit_type_and_for'],
            "credit_date" => CURRENT_DATE_TIME,
            "credit_expire_date" => $_POST['credit_expire_date'],
            "credit_created_by" => LOGIN_UserId,
            "credit_updated_by" => LOGIN_UserId,
            "credit_updated_at" => CURRENT_DATE_TIME,
            "credit_transaction_details" => SECURE($_POST['credit_transaction_details'], "e"),
            "credits_numbers" => $_POST['credits_numbers'],
            "credit_status" => $_POST['credit_status'],
            "credit_main_user_id" => $credit_main_user_id
        ];

        //check credit is already exisits or not
        $CreditCheck = CHECK("SELECT * FROM credits where credit_main_user_id='$credit_main_user_id' and credit_ref_name='$credit_ref_name'");
        if ($CreditCheck == null) {
            $Save = INSERT("credits", $credits);
            unset($_SESSION['CREDIT_REF_NO']);
        } else {
            $Save = false;
        }
        RESPONSE($Save, "Credit transferred into selected user account successfully!", "Unable to transfer credits at the moment!");
    }
}
