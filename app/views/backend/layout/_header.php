<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $globalParameter['AppTitle'];?> | <?php echo $pageTitle;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<base href="<?php echo $base_url;?>">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo ASSETS_CSS;?>fonts.googleapis.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo ASSETS_CSS;?>backend/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/themes/grey.css" id="style_color" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script src="<?php echo ASSETS_PLUGINS;?>jquery.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_PLUGINS;?>jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script language="javascript">var domain = '<?php echo $base_url_index;?>';</script>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<?php if(isset($closeSidebar) && $closeSidebar){ ?>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed">
<?php } else { ?>
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php } ?>
