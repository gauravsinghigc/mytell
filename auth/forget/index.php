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
                <a href="<?php echo DOMAIN; ?>" class="h5"><i class="fa fa-message text-success"></i> Forget Password</a>
            </div>
            <div class="card-body">
                <form action="<?php echo CONTROLLER("AuthController/AuthController.php"); ?>" method="POST" class="fs-13px">
                    <?php echo FormPrimaryInputs(true); ?>
                    <p>Enter your registered email id, we will sent a password reset link on it. You can change password by using that link.</p>

                    <div class="form-group mb-15px">
                        <label for="emailAddress" class="fs-13px text-gray-600">Email Address</label>
                        <input type="text" class="form-control h-40px fs-13px" name="UserEmailId" placeholder="Email Address" id="emailAddress" />
                    </div>
                    <div class="mb-10px text-dark text-right">
                        <a href="<?php echo DOMAIN; ?>/auth/login/" class="text-secondary">Know Password, Login?</a>
                        <br><br>
                    </div>
                    <div class="mb-15px mt-10">
                        <button type="submit" name="SearchAccountForPasswordReset" class="btn btn-dark d-block h-45px w-100 btn-lg fs-14px"><i class="fa fa-search text-white"></i> Search Account</button>
                    </div>
                    <hr class="bg-gray-600 opacity-2 mt-50px" />
                    <?php include "../../include/common/login-footer.php"; ?>
                </form>
            </div>

        </div>

    </div>
    <?php include "../../assets/app/FooterFiles.php"; ?>
</body>

</html>