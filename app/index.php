<?php
$Dir = "..";
require $Dir . '/acm/SysFileAutoLoader.php';
require $Dir . '/handler/AuthController/AuthAccessController.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard @ <?php echo APP_NAME; ?></title>
  <?php include $Dir . "/assets/app/HeaderFiles.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("Home").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body>
  <div class="wrapper">
    <?php include $Dir . "/include/common/TopHeader.php"; ?>

    <div class="content-wrapper">
      <?php include $Dir . "/include/common/MainNavbar.php"; ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-s-b">
              <h4 class="app-heading w-100 mb-0"><i class='fa fa-home text-warning'></i> Dashboard </h4>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 col-lg-3 col-sm-4 col-12">
            <div class="shadow-sm p-2">
              <h4 class="app-sub-heading"><i class="fa fa-bell blink-data"></i> All Alerts & Notifications</h4>
              <div class="w-pr-100">
                <marquee onmouseover="this.stop()" direction='up' onmouseleave="this.start()" scrollamount='3'>
                  <ul>
                    <li>
                      <a href="#"><i class="fa fa-bell blink-data text-danger"></i>
                        Attention: Due to scheduled maintenance, our online services will be temporarily unavailable on [Date] from [Start Time] to [End Time]. We apologize for any inconvenience this may cause and appreciate your understanding. If you have urgent matters during this period, please contact our support team at [Support Email/Phone]. Thank you for your patience.
                        <span><i class="fa fa-clock"></i> 13 feb, 2024, 17:00 PM</span>
                      </a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-bell blink-data text-danger"></i>
                        Urgent Notice: We have detected unusual activity on your account. To ensure the security of your information, we recommend changing your password immediately. Log in to your account and follow the password reset instructions. If you did not initiate this action, please contact our support team at [Support Email/Phone]. Your account safety is our top priority. Thank you for your prompt attention to this matter.
                        <span><i class="fa fa-clock"></i> 13 feb, 2024, 17:00 PM</span>
                      </a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-bell blink-data text-danger"></i>
                        Urgent Notice: We have detected unusual activity on your account. To ensure the security of your information, we recommend changing your password immediately. Log in to your account and follow the password reset instructions. If you did not initiate this action, please contact our support team at [Support Email/Phone]. Your account safety is our top priority. Thank you for your prompt attention to this matter.
                        <span><i class="fa fa-clock"></i> 13 feb, 2024, 17:00 PM</span>
                      </a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-bell blink-data text-danger"></i>
                        Urgent Notice: We have detected unusual activity on your account. To ensure the security of your information, we recommend changing your password immediately. Log in to your account and follow the password reset instructions. If you did not initiate this action, please contact our support team at [Support Email/Phone]. Your account safety is our top priority. Thank you for your prompt attention to this matter.
                        <span><i class="fa fa-clock"></i> 13 feb, 2024, 17:00 PM</span>
                      </a>
                    </li>
                  </ul>
                </marquee>
              </div>
            </div>
          </div>

          <div class="col-md-9 col-lg-9 col-sm-8 col-12">
            <div class="shadow-sm p-2">
              <div class='row'>
                <div class='col-lg-2 col-md-3 col-sm-4 col-6 col-xs-6 widget-box'>
                  <a href="#">
                    <div class="shadow-sm p-2">
                      <h2>1</h2>
                      <p><i class='fa fa-info-circle'></i> All Enquiries</p>
                    </div>
                  </a>
                </div>
                <div class='col-lg-2 col-md-3 col-sm-4 col-6 col-xs-6 widget-box'>
                  <a href="#">
                    <div class="shadow-sm p-2">
                      <h2>1</h2>
                      <p><i class='fa fa-file'></i> All Estimates</p>
                    </div>
                  </a>
                </div>
                <div class='col-lg-2 col-md-3 col-sm-4 col-6 col-xs-6 widget-box'>
                  <a href="#">
                    <div class="shadow-sm p-2">
                      <h2>1</h2>
                      <p><i class='fa fa-users'></i> All Customers</p>
                    </div>
                  </a>
                </div>
                <div class='col-lg-2 col-md-3 col-sm-4 col-6 col-xs-6 widget-box'>
                  <a href="#">
                    <div class="shadow-sm p-2">
                      <h2>1</h2>
                      <p><i class='fa fa-list'></i> All Projects</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include $Dir . "/include/common/Footer.php";
  include $Dir . "/assets/app/FooterFiles.php";
  ?>
</body>

</html>