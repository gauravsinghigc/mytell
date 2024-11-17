<?php
$Dir = "../../../";
require $Dir . '/acm/SysFileAutoLoader.php';
require $Dir . '/handler/AuthController/AuthAccessController.php';


//pagevariables
$PageName = "App Configurations";
$PageDescription = "Manage System Profile, address, logo";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SECURE(SHORT_DESCRIPTION, "d"); ?>">
  <?php include $Dir . "/assets/app/HeaderFiles.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("config_app").classList.add("active");
      document.getElementById("settings").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/common/TopHeader.php"; ?>
    <div class="content-wrapper">
      <?php include $Dir . "/include/common/MainNavbar.php"; ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <?php include "../sections/common.php"; ?>
                    </div>

                    <div class="col-md-10">
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                      <div class="row">
                        <div class="col-md-4">
                          <h5 class="app-sub-heading">Available Configurations</h5>
                          <form action="<?php echo CONTROLLER("SystemController/ConfigController.php"); ?>" method="POST">
                            <?php echo FormPrimaryInputs(true); ?>
                            <div class="form-group flex-s-b">
                              <input type="text" name="ConfigGroupName" class="form-control mb-0 mr-2 w-100" placeholder="Configuration Group Name">
                              <button class="btn btn-sm btn-success w-75" name="SaveConfigurations" type="submit">Save</button>
                            </div>
                          </form>
                          <ul class="config-menu">
                            <?php
                            $Configs = SET_SQL("SELECT * FROM configs ORDER By ConfigsId DESC", true);
                            if ($Configs != null) {
                              $Count = 0;
                              foreach ($Configs as $Data) {
                                $Count++;
                                if (isset($_GET['id'])) {
                                  if ($Data->ConfigsId == $_GET['id']) {
                                    $selected = "active";
                                  } else {
                                    $selected = "";
                                  }
                                } else {
                                  if ($Count == 1) {
                                    $selected = "active";
                                  } else {
                                    $selected = "";
                                  }
                                }
                                $id = $Data->ConfigsId;
                            ?>
                                <li><a href="?id=<?php echo $Data->ConfigsId; ?>" class="<?php echo $selected; ?>"><?php echo $Data->ConfigGroupName; ?> <i class="fa fa-angle-right"></i></a></li>
                            <?php
                              }
                            } else {
                              NoData("No Configuration Group Found!");
                              $id = 0;
                            } ?>
                          </ul>
                        </div>
                        <div class="col-md-8">
                          <h5 class="app-sub-heading">Configurations Values</h5>
                          <form action="<?php echo CONTROLLER("SystemController/ConfigController.php"); ?>" method="POST">
                            <div class="row">
                              <?php
                              if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $ConfigSql = "SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigsId='$id' ORDER BY configs.ConfigsId DESC";
                              } else {
                                $id = FETCH("SELECT * FROM configs ORDER BY ConfigsId DESC limit 1", "ConfigsId");
                                $ConfigSql = "SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigsId='$id' ORDER BY configs.ConfigsId ASC";
                                $id = FETCH($ConfigSql, "ConfigsId");
                              }

                              echo FormPrimaryInputs(true, [
                                "ConfigValueGroupId" => $id
                              ]); ?>
                              <div class="col-md-8">
                                <div class="form-group flex-s-b mb-2">
                                  <input type="text" name="ConfigValueDetails" class="form-control w-75 mb-0 mr-2" placeholder="Enter New Value">
                                  <button type="submit" name="SaveNewConfigValue" class="btn btn-sm btn-success w-25">Save Details</button>
                                </div>
                              </div>
                            </div>
                          </form>
                          <hr>
                          <?php
                          $CValues = SET_SQL($ConfigSql, true);
                          if ($CValues != null) {
                            foreach ($CValues as $Values) {
                          ?>
                              <p class="data-list flex-s-b">
                                <span><?php echo $Values->ConfigValueDetails; ?> |
                                  <span class="text-grey"> <?php echo FETCH("SELECT * FROM config_values where ConfigValueId='" . $Values->ConfigReferenceId . "'", "ConfigValueDetails"); ?></span>
                                </span>
                                <span>
                                  <a href="#" onclick="Databar('update_<?php echo $Values->ConfigValueId; ?>')" class="text-info">Edit Details</a>
                                  <span>
                                    <?php CONFIRM_DELETE_POPUP(
                                      "delete_values",
                                      [
                                        "delete_configs_records" => true,
                                        "control_id" => $Values->ConfigValueId,
                                      ],
                                      "SystemController/ConfigController",
                                      "Remove",
                                      "text-danger"
                                    ); ?>
                                  </span>
                                </span>
                              </p>
                              <form action="<?php echo CONTROLLER("SystemController/ConfigController.php"); ?>" class="hidden" id="update_<?php echo $Values->ConfigValueId; ?>" method="POST">
                                <div class="row">
                                  <?php echo FormPrimaryInputs(true, [
                                    "ConfigValueId" => $Values->ConfigValueId
                                  ]);
                                  if ($id == 10) { ?>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <select name="ConfigReferenceId" class="form-control" required>
                                          <option value="0">Select Call Response</option>
                                          <?php $ConfigsOptions = SET_SQL("SELECT * FROM config_values where ConfigValueGroupId='7'", true);
                                          if ($ConfigsOptions != null) {
                                            foreach ($ConfigsOptions as $Options) {
                                              if ($Options->ConfigValueDetails == FETCH("SELECT * FROM config_values where ConfigValueId='" . $Values->ConfigReferenceId . "'", "ConfigValueDetails")) {
                                                $selected = "selected";
                                              } else {
                                                $selected = "";
                                              }
                                              echo "<option value='" . $Options->ConfigValueId  . "' $selected>" . $Options->ConfigValueDetails . "</option>";
                                            }
                                          } else {
                                            echo "<option value='0'>Please add one Call Status</option>";
                                          } ?>
                                        </select>
                                      </div>
                                    </div>
                                  <?php } ?>
                                  <div class="col-md-8">
                                    <div class="form-group flex-s-b mb-2">
                                      <input type="text" name="ConfigValueDetails" value="<?php echo $Values->ConfigValueDetails; ?>" class="form-control w-100 mb-0 mr-2" placeholder="Enter New Value">
                                      <button type="submit" name="UpdateConfigValues" class="btn btn-sm btn-success w-100">Update Details</button>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                              </form>
                          <?php
                            }
                          } else {
                            NoData(
                              "<br>No Details Found!"
                            );
                            if ($CValues == null) {
                              if ($Configs != null) {
                                CONFIRM_DELETE_POPUP(
                                  "delete_data",
                                  [
                                    "delete_configs_group" => true,
                                    "control_id" => $id,
                                  ],
                                  "SystemController/ConfigController",
                                  "Remove Configuration Group",
                                  "btn btn-sm btn-danger d-flex mx-auto"
                                );
                              }
                            }
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

  </div>

  <?php
  include $Dir . "/include/common/Footer.php";
  include $Dir . "/assets/app/FooterFiles.php"; ?>

</body>

</html>