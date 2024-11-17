<div class="col-md-2 col-lg-2 col-sm-3 col-12">
    <div class="shadow-sm p-2">
        <h4 class="app-sub-heading"><i class="fa fa-gear fa-spin blink-data"></i> All Available Tools</h4>
        <div class="w-pr-100">
            <div class='app-setting-menus'>
                <?php foreach (TOOLS_MENU as $CalculatorKey => $Values) { ?>
                    <a href="<?php echo APP_URL . $Values['url']; ?>?v=<?php echo $Values['name']; ?>&key=<?php echo $CalculatorKey; ?>" class='RecordsList' id='<?php echo $CalculatorKey; ?>'>
                        <img loading="lazy" src="<?php echo STORAGE_URL; ?>/cal-icons/<?php echo $Values['icon']; ?>" class="cal-icon"> <?php echo $Values['name']; ?> <i class="fa fa-angle-right"></i>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>