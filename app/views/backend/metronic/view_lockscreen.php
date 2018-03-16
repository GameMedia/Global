<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $globalParameter['AppTitle'];?> | <?php echo $pageTitle;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<base href="<?php echo $base_url;?>">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/backend/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/backend/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/css/backend/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/backend/layout.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/backend/themes/darkblue.css" id="style_color" rel="stylesheet" type="text/css"/>
<link href="assets/css/backend/pages/lock.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/backend/custom.css" rel="stylesheet" type="text/css"/>

<link href="assets/css/backend/style-responsive.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script language="javascript">var domain = '<?php echo $base_url_index;?>';</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
	<div class="page-logo">
		<a class="brand" href="index.html">
			<img src="assets/images/logo-big.png" alt="logo"/>
		</a>
	</div>
	<div class="page-body">
		<img class="page-lock-img" src="assets/images/global/user-512.png" alt="">
		<div class="page-lock-info">
			<h1><?php echo $profile['name_employee'];?></h1>
			<span class="email">
				 <?php echo $profile['email'];?>
			</span>
			<span class="locked">
				 Locked
			</span>
			<form class="lock-form" action="javascript:;" method="post">
				<div id="errorMessage" class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<span>Enter password. </span>
				</div>
				<div class="input-group input-medium">
					<input type="password" id="userpass" name="userpass" class="form-control" placeholder="Password">
					<span class="input-group-btn">
						<button type="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i></button>
					</span>
				</div>
				<!-- /input-group -->
				<div class="relogin">
					<a href="">
						 Not <?php echo $profile['name_employee'];?> ?
					</a>
					<a href="backend/out">
						 Log Out
					</a>
				</div>
			</form>
		</div>
	</div>
	<div class="page-footer">
		 <?php echo date('Y');?> &copy; <?php echo $globalParameter['AppTitle'];?>
	</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="assets/js/backend/metronic.js"></script>
<script type="text/javascript" src="assets/js/backend/layout.js"></script>
<script type="text/javascript" src="assets/js/backend/global.js"></script>

<script src="assets/js/backend/backstretch.js"></script>
<script src="assets/js/backend/lockscreen.js"></script>
<script>
jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	backstretch.init();
	Lock.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
