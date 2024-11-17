<?php
$Dir = "../..";
require $Dir . '/acm/SysFileAutoLoader.php';
require $Dir . '/handler/AuthController/AuthAccessController.php';


//pagevariables
$PageName = "All Users";
$PageDescription = "Manage all customers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>
    <?php echo $PageName; ?> |
    <?php echo APP_NAME; ?>
  </title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SECURE(SHORT_DESCRIPTION, "d"); ?>">
  <?php include $Dir . "/assets/app/HeaderFiles.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("users").classList.add("active");
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
        <div class="shadow-sm rounded">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10">
                <h4 class="app-heading mt-0">
                  <i class='fa fa-users text-warning'></i>
                  <?php echo $PageName; ?>
                </h4>
              </div>
              <div class="col-md-2">
                <a href="#" onclick="Databar('AddNewUsers')" class="btn btn-md btn-block btn-danger"><i class="fa fa-plus"></i> New
                  Users</a>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>S/RefNo</th>
                        <th>FullName</th>
                        <th>PhoneNo</th>
                        <th>EmailId</th>
                        <th>CompanyName</th>
                        <th>WorkProfile</th>
                        <th>DateOfBirth</th>
                        <th>CreatedAt</th>
                        <th>UserType</th>
                        <th>UserStatus</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $Start = START_FROM;
                      $LISTING_END = DEFAULT_RECORD_LISTING;
                      if (LOGIN_UserType == "RESELLER") {
                        $UserSql = "SELECT * FROM users WHERE UserCreatedBy='" . LOGIN_UserId . "' ORDER BY DATE(UserCreatedAt) DESC";
                      } else {
                        $UserSql = "SELECT * FROM users ORDER BY DATE(UserCreatedAt) DESC";
                      }
                      $AllUsers = SET_SQL($UserSql . " limit $Start, $LISTING_END", true);
                      if ($AllUsers != null) {
                        $SERIAL_NO = SERIAL_NO;
                        foreach ($AllUsers as $Users) {
                          $SERIAL_NO++; ?>
                          <tr>
                            <td>UID<?php echo $Users->UserId; ?>/<?php echo $SERIAL_NO; ?></td>
                            <td>
                              <a onclick="Databar('update_users_records_<?php echo $Users->UserId; ?>')" class='text-underline'>
                                <b><?php echo $Users->UserSalutation; ?> <?php echo $Users->UserFullName; ?></b>
                              </a>
                            </td>
                            <td><?php echo PHONE($Users->UserPhoneNumber, "link", "shadow-sm rounded text-black", "fa fa-phone text-success"); ?>
                            </td>
                            <td><?php echo EMAIL($Users->UserEmailId, "link", "text-black", "fa fa-envelope text-danger"); ?></td>
                            <td><?php echo $Users->UserCompanyName; ?></td>
                            <td><?php echo $Users->UserDesignation; ?></td>
                            <td><i class='fa fa-birthday-cake text-danger'></i> <?php echo DATE_FORMATES("d M, Y", $Users->UserDateOfBirth); ?></td>
                            <td><?php echo DATE_FORMATES("d M, Y", $Users->UserCreatedAt); ?></td>
                            <td><?php echo $Users->UserType; ?></td>
                            <td><?php echo StatusViewWithText($Users->UserStatus); ?></td>
                          </tr>
                      <?php
                          include $Dir . "/include/forms/Update-Users-Details.php";
                        }
                      } else {
                        NoDataTableView("No Users Found!", "");
                      }
                      echo "</tbody>";
                      echo "</table>";
                      echo PaginationFooter(TOTAL($UserSql), "index.php"); ?>
                </div>
              </div>
            </div>
          </div>
      </section>
    </div>
  </div>

  <?php
  include $Dir . "/include/forms/Add-New-Users.php";
  include $Dir . "/include/common/Footer.php";
  include $Dir . "/assets/app/FooterFiles.php";
  ?>
</body>

</html>