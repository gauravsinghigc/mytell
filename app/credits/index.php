<?php
$Dir = "../..";
require $Dir . '/acm/SysFileAutoLoader.php';
require $Dir . '/handler/AuthController/AuthAccessController.php';


//pagevariables
$PageName = "All Credits History";
$PageDescription = "Manage all customers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SECURE(SHORT_DESCRIPTION, "d"); ?>">
  <?php include $Dir . "/assets/app/HeaderFiles.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("credits").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body>
  <div class="wrapper">
    <?php include $Dir . "/include/common/TopHeader.php"; ?>

    <div class="content-wrapper">
      <?php include $Dir . "/include/common/MainNavbar.php"; ?>
      <section class="content">
        <div class="shadow-sm p-1 rounded">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <hr>
              </div>
              <?php if (LOGIN_UserType == "Admin" || LOGIN_UserType == "RESELLER") { ?>
                <div class='col-md-12'>
                  <div class="flex-s-b">
                    <div class="w-pr-90">
                      <h5 class='app-heading w-100 mb-0'><?PHP echo $PageName; ?></h5>
                    </div>
                    <div class="w-pr-10">
                      <a onclick="Databar('AddCreditForTheirUsers')" class='btn btn-block btn-md ml-1 mb-0 btn-danger'><i class='fa fa-plus'></i> Add Credit</a>
                    </div>
                  </div>
                </div>
              <?php  } else { ?>
                <div class='col-md-12'>
                  <h5 class='app-heading w-100 mb-0'><?PHP echo $PageName; ?></h5>
                </div>
              <?php } ?>
            </div>

            <?php
            if (LOGIN_UserType == "Admin") {
              include "sections/admin.php";
            } elseif (LOGIN_UserType == "RESELLER") {
              include "sections/reseller.php";
            } else {
              include "sections/user.php";
            } ?>
          </div>
        </div>
      </section>
    </div>
  </div>

</body>
<?php
include $Dir . "/include//forms/Add-Credit-Records.php";
include $Dir . "/include/common/Footer.php";
include $Dir . "/assets/app/FooterFiles.php"; ?>

</html>