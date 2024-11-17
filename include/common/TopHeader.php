<div class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-s-b">
                    <div class='w-pr-25'>
                        <div class="header-logo">
                            <a href="<?php echo APP_URL; ?>">
                                <img src="<?php echo APP_LOGO; ?>" title='<?php echo APP_NAME; ?>' class="img-fluid rounded" alt="<?php echo APP_NAME; ?>">
                                <span class="title"><?php echo APP_NAME; ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="w-pr-50">
                        <form class="p-1">
                            <input type="search" class='form-control form-control-lg' placeholder="Search anything..." name="search" id='SearchIn' oninput="SearchData('SearchIn', 'RecordsList')">
                        </form>
                    </div>
                    <div class=" w-pr-25">
                        <div class="header-profile">
                            <a href="<?php echo APP_URL; ?>/profile">
                                <img src="<?php echo AuthAppUser("UserProfileImage"); ?>" title='<?php echo LOGIN_UserFullName; ?>' class="img-fluid rounded" alt="<?php echo LOGIN_UserFullName; ?>">
                                <span class="title"><?php echo LOGIN_UserFullName; ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>