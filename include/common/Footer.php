<?php include(__DIR__ . "/../../include/common/Message.php"); ?>
<section class="fixed-bottom bg-white shadow-sm">
  <div class="text-gray-600 text-center mb-0 flex-s-b">
    <div>
      <b><?php echo APP_NAME; ?></b> &copy; <?php echo date("Y"); ?>
    </div>
    <div>
      <b>
        <i class="fa fa-clock text-success"></i>
        <span id='CurrentTime'></span> | <i class="fa fa-calendar-day text-danger"></i>
        <span><?php echo date("d D M, Y"); ?></span>
      </b>
    </div>
  </div>
</section>