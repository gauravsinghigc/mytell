<?php
$Dir = "../..";
require $Dir . '/acm/SysFileAutoLoader.php';
require $Dir . '/handler/AuthController/AuthAccessController.php';


//pagevariables
$PageName = "All Campaigns";
$PageDescription = "Manage all customers";


if (!isset($_SESSION['CAMPAIGN_REF_NO'])) {
    $campaign_ref_no = "CMGN" . date("dmy") . rand(11111, 99999);
    $_SESSION['CAMPAIGN_REF_NO'] = $campaign_ref_no;
} else {
    $_SESSION['CAMPAIGN_REF_NO'] = $_SESSION['CAMPAIGN_REF_NO'];
}

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
            document.getElementById("Campaign").classList.add("active");
            document.getElementById("wcamp").classList.add("active");
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
                            <div class="col-md-4">
                                <h5 class="app-heading">Available Campaign options</h5>
                                <div class='app-setting-menus'>
                                    <a href="<?php echo APP_URL; ?>/settings/index.php" id='wcamp'>Whatsapp Campaign <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class='app-heading'>Create Campaign</h5>
                                <div class="shadow-sm p-2 b-r-1">
                                    <form class='row' action='<?php echo CONTROLLER; ?>' method="POST" enctype="multipart/form-data">
                                        <?php echo FormPrimaryInputs(true); ?>
                                        <?php if (LOGIN_UserType == "USER") {
                                            echo "<input type='hidden' name='campaign_main_user_id' value='" . LOGIN_UserId . "'>";
                                            echo "<input type='hidden' name='campaign_created_at' value='" . CURRENT_DATE_TIME . "'>";
                                        } else {
                                        ?>
                                            <div class='form-group col-md-8'>
                                                <label>Create Campaign For</label>
                                                <select name='campaign_main_user_id' class='form-control' required>
                                                    <?php
                                                    $AllUsers = SET_SQL("SELECT * FROM users ORDER BY UserFullName ASC", true);
                                                    if ($AllUsers != null) {
                                                        foreach ($AllUsers as $User) {
                                                            echo "<option value='" . $User->UserId . "'>" . $User->UserFullName . " - " . $User->UserCompanyName  . "</option>";
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class='form-group col-md-4'>
                                                <label>Campaign Date-Time</label>
                                                <input type='datetime-local' value='<?php echo date("Y-m-d h:m"); ?>' name='campaign_created_at' class='form-control' required>
                                            </div>
                                        <?php  } ?>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Add Phone Numbers (without +91); <?php echo $req; ?></label>
                                                <textarea name='campaign_phone_numbers' class='form-control' rows='35' required placeholder="9876543210, 987543210, 876545677,"></textarea>
                                            </div>
                                        </div>
                                        <div class='col-md-8'>
                                            <div class='row'>
                                                <div class="col-md-12 mb-3">
                                                    <label>Campaign Name <?php echo $req; ?></label>
                                                    <input type='text' name='campaign_name' class='form-control' required>
                                                </div>
                                                <div class='col-md-12 form-group mb-3'>
                                                    <label>Enter Campaign Message <?php echo $req; ?></label>
                                                    <textarea name='campaign_messages' class='form-control editor' rows='7'></textarea>
                                                </div>

                                                <div class='col-md-12 form-group mb-2'>
                                                    <label>Upload Images/Creatives (Max file size 1MB).</label>
                                                    <div class='flex-s-b mt-1'>
                                                        <div class='w-pr-50 m-1 form-group'>
                                                            <label>Upload Creative 1</label>
                                                            <input type='FILE' name='campaign_image_1' class='form-control form-control-sm' accept='image/*'>
                                                        </div>
                                                        <div class='w-pr-50 m-1 form-group'>
                                                            <label>Upload Creative 1</label>
                                                            <input type='FILE' name='campaign_image_2' class='form-control' accept='image/*'>
                                                        </div>
                                                    </div>
                                                    <div class='flex-s-b mt-1'>
                                                        <div class='w-pr-50 m-1 form-group'>
                                                            <label>Upload Creative 1</label>
                                                            <input type='FILE' name='campaign_image_3' class='form-control' accept='image/*'>
                                                        </div>
                                                        <div class='w-pr-50 m-1 form-group'>
                                                            <label>Upload Creative 1</label>
                                                            <input type='FILE' name='campaign_image_4' class='form-control' accept='image/*'>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class='col-md-12 form-group'>
                                                    <hr>
                                                    <div class='flex-s-b mt-1'>
                                                        <div class='w-pr-50 m-1 form-group'>
                                                            <label>Upload Whatsapp DP</label>
                                                            <input type='FILE' name='campaign_profile_photo' class='form-control' accept='image/*'>
                                                        </div>
                                                        <div class='w-pr-50 m-1 form-group'>
                                                            <label>Upload PDF (Max File size: 3MB)</label>
                                                            <input type='file' name='campaign_pdf' class='form-control' accept='.pdf'>
                                                        </div>
                                                    </div>
                                                    <div class='w-pr-50 mt-2 m-1 form-group'>
                                                        <label>Upload Video (Max File size : 4MB)</label>
                                                        <input type='file' name='campaign_videos' class='form-control' accept='video/*'>
                                                    </div>
                                                </div>
                                                <div class='col-md-12 form-group mb-3'>
                                                    <h6 class='text-danger'>I agree terms and canditions</h6>
                                                    <p class='text-justify mb-0'><input type='checkbox' name='campaign_agreement' value='true' required> I will not use this panel for any form of spam activity, including deceptive, misleading, fraudulent, offensive, harassing, or threatening messages. The owner of this panel shall not be held liable for any legal or other issues arising from the content of your messages. You as the user is solely responsible for the content of all messages sent through this panel.</p>
                                                </div>

                                                <div class='col-md-12 form-group mb-3'>
                                                    <p class='text-justify mb-0'><input type='checkbox' name='campaign_dp_type' value='false'> Send without DP</p>
                                                </div>

                                                <div class='col-md-12'>
                                                    <hr>
                                                    <div class="flex-s-b">
                                                        <button type='submit' name='SAVE_CAMPAIGN_DETIALS' class='btn btn-md btn-primary'><i class='fa fa-send'></i> SUBMIT FOR PROCESSING</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>
<?php
include $Dir . "/include/common/Footer.php";
include $Dir . "/assets/app/FooterFiles.php"; ?>

</html>