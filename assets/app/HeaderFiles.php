<link rel="shortcut icon" href="<?php echo MAIN_LOGO; ?>">
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/app/css/adminlte.min.css" />
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/app/css/app.css" />
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/app/css/message.css" />
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/app/css/theme.css" />
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/app/css/utility.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
<script src="<?php echo ASSETS_URL; ?>/app/js/textarea.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo CONFIG('GOOGLE_MAP_API'); ?>"></script>
<script>
  tinymce.init({
    selector: 'textarea.editor',
    menubar: false
  });
</script>