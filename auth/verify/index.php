<?php
require "../../acm/SysFileAutoLoader.php";
if (isset($_SESSION['LOGIN_USER_ID'])) {
    LOCATION("info", "Welcome User, You are login in successfully!", DOMAIN . "/app");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo APP_NAME; ?> | Forget</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <?php include "../../assets/app/HeaderFiles.php"; ?>
</head>

<body class="hold-transition login-page app-bg">
    <div class="login-box">
        <div class="card">
            <div class="card-header text-center">
                <img src="<?php echo MAIN_LOGO; ?>" class="img-fluid w-25"><br>
                <br>
                <a href="<?php echo DOMAIN; ?>" class="h5"><i class="fa fa-shield text-success"></i> Verify Your Account!</a>
            </div>
            <div class="card-body">
                <h4><i class="fa fa-check-circle-o text-success"></i> Password Reset Link Sent!</h4>
                <hr>
                <p> Password Reset Link is sent successfully on submitted email id <b><?php echo $_SESSION['REQUESTED_EMAIL']; ?></b>. Change your password by following that link.</p>
                <a href="<?php echo DOMAIN; ?>/app" class="btn btn-block btn-dark"><i class='fa fa-angle-left'></i> Back to Login</a>
            </div>
            <div class="mb-15px">
                <hr class="bg-gray-600 opacity-2 mt-50px" />
                <?php include "../../include/common/login-footer.php"; ?>
                <br>
            </div>
        </div>
    </div>
    <?php include "../../assets/app/FooterFiles.php"; ?>
</body>

</html>