<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";

//start activity here
//login request

if (isset($_POST['LoginRequest'])) {
    $UserPassword = SECURE($_POST['UserPassword'], "e");
    $UserEmailId = $_POST['UserEmailId'];
    $CheckUsername = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId' and UserPassword='$UserPassword'");

    //get user details
    if ($CheckUsername == true) {
        $FetchUsersSql = "SELECT * FROM users where UserEmailId='$UserEmailId' and UserStatus='1'";
        $UserId = FETCH($FetchUsersSql, 'UserId');
        $UserName = FETCH($FetchUsersSql, "UserFullName");
        $UserStatus = FETCH($FetchUsersSql, "UserStatus");

        if ($UserStatus != "1") {
            LOCATION("warning", "You are not allowed to access the Application, account is restricted by the administrator! Please contact the administrator for more information!", APP_URL . "");
        } else {
            $_SESSION['LOGIN_USER_ID'] = $UserId;

            //reponse
            LOCATION("success", "Welcome $UserName, Login Successful!", DOMAIN . "/app");
        }
        //developer login
    } else {
        if ($UserEmailId == "dev@admin.tld" && $UserPassword == AdminstratorPassword) {
            $_SESSION['LOGIN_USER_ID'] = 1;

            //response
            LOCATION("success", "Welcome " . $FetchUsers['UserFullName'] . ", Login Successful!", DOMAIN . "/app/index.php");

            //failed login 
        } else {
            LOCATION("warning", "Please check your Email-Id and Password. They are incorrect, Please try again with valid Email-ID and Password!", "$access_url");
        }
    }

    //update profile details
} elseif (isset($_POST['UpdateProfile'])) {
    $UserId = $_SESSION['LOGIN_USER_ID'];
    $UserName = $_POST['UserName'];
    $UserPhone = $_POST['UserPhone'];
    $UserEmailId = $_POST['UserEmailId'];
    $UserUpdatedAt = date("d M, Y");

    $ErrorMsg = "Unable to Update Profile";
    //check phone number exisits or not
    $CheckPhoneNumber = CHECK("SELECT UserPhoneNumber FROM users where UserPhoneNumber='$UserPhoneNumber' and UserId!='$UserId'");
    if ($CheckPhoneNumber == null) {
        $Update = UPDATE_SQL("UPDATE users SET UserUpdatedAt='$UserUpdatedAt', UserFullName='$UserName', UserPhoneNumber='$UserPhone' where UserId='" . $UserId . "' ");
        $ErrorMsg = "Unable to Update Profile Phone Number";
    } else {
        $Update = false;
        $ErrorMsg = "Phone no: <b>$UserPhone</b> already exisits";
    }

    //check for emailid
    $CheckifitisEmailID = CHECK("SELECT UserEmailId FROM users where UserEmailId='$UserEmailId' and UserId!='$UserId'");
    if ($CheckifitisEmailID == null) {
        $Update = UPDATE_SQL("UPDATE users SET UserUpdatedAt='$UserUpdatedAt', UserFullName='$UserName', UserEmailId='$UserEmailId' where UserId='" . $UserId . "' ");
        $ErrorMsg = "Unable to Update Profile email-id";
    } else {
        $Update = false;
        $ErrorMsg = "Email-Id: <b>$UserEmailId</b> already exisits";
    }
    RESPONSE($Update, "Profile Updated!", $ErrorMsg);

    //update password 
} elseif (isset($_POST['UpdatePassword'])) {
    $UserPassword = $_POST['UserPassword'];
    $UserPassword_2 = $_POST['UserPassword_2'];
    if ($UserPassword != $UserPassword_2) {
        LOCATION("warning", "Unable to Update password!", "$access_url");
    } else {
        $update = UPDATE_SQL("UPDATE users SET UserPassword='$UserPassword' where UserId='" . $_SESSION['LOGIN_USER_ID'] . "'");
        RESPONSE($update, "Password Updated Successfully!", "Unable to Update Password!");
    }

    //recover account 
} elseif (isset($_POST['SearchAccountForPasswordReset'])) {
    $UserEmailId = $_POST['UserEmailId'];
    $UserExits = CHECK("SELECT UserEmailId FROM users where UserEmailId='$UserEmailId'");
    if ($UserExits != null) {
        $PasswordResetRequestAuthToken = rand(111111, 999999) . "- Date - " . date("Y-m-d h:m:s a") . " For" . APP_NAME;
        $_SESSION['CREATED_OTP'] = rand(11111, 999999);
        $_SESSION['REQUESTED_EMAIL'] = $UserEmailId;

        //create Password reset Token with expire limit
        $UserIdForPasswordChange = FETCH("SELECT * from users where UserEmailId='$UserEmailId'", "UserId");
        $PasswordChangeToken = SECURE($PasswordResetRequestAuthToken, "e");
        $PasswordChangeTokenExpireTime = date('d-m-Y H:i', strtotime("+10 min"));
        $PasswordChangeDeviceDetails = SECURE(SYSTEM_INFO, "e");
        $PasswordChangeRequestStatus = "Active";

        //mail template data
        $Allowedto = SECURE($UserEmailId, "e");
        $PasswordResetLink = DOMAIN . "/auth/reset/?token=$PasswordChangeToken&for=$Allowedto";

        //save password change request information with link and password change token
        $user_password_change_requests = [
            "UserIdForPasswordChange" => $UserIdForPasswordChange,
            "PasswordChangeTokenExpireTime" => $PasswordChangeTokenExpireTime,
            "PasswordChangeToken" => $PasswordChangeToken,
            "PasswordChangeDeviceDetails" => $PasswordChangeDeviceDetails,
            "PasswordChangeRequestStatus" => $PasswordChangeRequestStatus
        ];
        $Save = INSERT("user_password_change_requests", $user_password_change_requests, false);

        //sent on mails
        $Mail = SENDMAILS("Password Reset Request Received!", "Verify Your Account!", $UserEmailId, "Your Password Reset Request is Received<br><br> You can change your password by clicking on the below link.<br><br> If this request is not sent by you then you may have to change your password immedietly.<br><br> $PasswordResetLink");

        //check mail status
        if ($Mail == true) {
            $access_url = DOMAIN . "/auth/verify/";
            LOCATION("success", "Password Change Link is sent on <b>$UserEmailId</b> Successfully!", "$access_url");
        } else {
            LOCATION("warning", "Unable to sent password reset link at the moment please try again after some time!", "$access_url");
        }
    } else {
        LOCATION("warning", "No any user is listed with $UserEmailId. Please check entered email id", "$access_url");
    }

    //check account verification request
} else if (isset($_POST['RequestAccountVerifications'])) {
    $SubmittedOTP = $_POST['SubmittedOTP'];
    if ($SubmittedOTP == $_SESSION['CREATED_OTP']) {
        $_SESSION['ACCOUNT_VERIFICATION_REQUEST'] = true;
        $_SESSION['ACCOUNT_VERIFICATION_REQUEST_EMAIL'] = $_SESSION['REQUESTED_EMAIL'];
        $access_url = DOMAIN . "/auth/reset/";
        LOCATION("success", "Account Verification Completed! Please change your password!", "$access_url");
    } else {
        LOCATION("warning", "Invalid OTP!", "$access_url");
    }

    //request for password change with requested otp
} elseif (isset($_POST['RequestForPasswordChange'])) {
    $Password1 = $_POST['Password1'];
    $Password2 = $_POST['Password2'];
    if ($Password1 != $Password2) {
        LOCATION("warning", "Password Mismatch!", "$access_url");
    } else {
        $UserEmailId = $_SESSION['REQUESTED_EMAIL_ID'];
        $UserExits = CHECK("SELECT UserEmailId FROM users where UserEmailId='$UserEmailId'");
        if ($UserExits != null) {
            $update = UPDATE_SQL("UPDATE users SET UserPassword='$Password1' where UserEmailId='$UserEmailId'");
            if ($update == true) {
                SENDMAILS("PASSWORD CHANGED", "Your Password has been changed!", $UserEmailId, "Your Password has been changed successfully. <br> <br> Thank You.");

                //token and user email-id
                $SUBMITTED_PASSWORD_RESET_TOKEN = $_SESSION['SUBMITTED_PASSWORD_RESET_TOKEN'];

                //expired the used session
                $PasswordChangeRequestStatus = "Expired";
                $Update = CUSTOM_COLUMN_UPDATE("user_password_change_requests", ["PasswordChangeRequestStatus"], "PasswordChangeToken='$PasswordChangeToken'");

                //redirect to login page
                $access_url = DOMAIN . "/auth/login/";
                LOCATION("success", "Password Changed Successfully!", "$access_url");

                //check in case of incorrect
            } else {
                LOCATION("warning", "Unable to change password!", "$access_url");
            }
        } else {
            LOCATION("warning", "User Not Found at the time of Password Change Request, Please try again...", "$access_url");
        }
    }
}
