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
<!-- END GLOBAL MANDATORY STYLES -->

<base href="<?php echo $base_url;?>">
<!-- BEGIN GLOBAL MANDATORY STYLES --> 
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo ASSETS_PLUGINS;?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_PLUGINS;?>uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo ASSETS_PLUGINS;?>select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo ASSETS_CSS;?>backend/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/themes/darkblue.css" id="style_color" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS_CSS;?>backend/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script src="<?php echo ASSETS_PLUGINS;?>jquery.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_PLUGINS;?>jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script language="javascript">var domain = '<?php echo $base_url_index;?>';</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="assets/images/logo-big.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="javascript:;" method="post">
		<h3 class="form-title">Login to your account</h3>
		<div id="errorMessage" class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label>
			<button type="submit" class="btn blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="javascript:;" id="forget-password">
				here </a>
				to reset your password.
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="javascript:;" method="post">
		<h3>Forget Password ?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div id="errorMessageForget" class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter your email. </span>
		</div>
		<div id="successMessageForget" class="alert alert-success display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter your email. </span>
		</div>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input name="forgot-email" id="forgot-email" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn blue pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 <?php echo date('Y');?> &copy; <?php echo $globalParameter['AppTitle'];?>	 
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery-migrate.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery.blockui.min.js"></script> 
    <script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>uniform/jquery.uniform.min.js"></script> 
    <script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery.cokie.min.js"></script> 
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>backstretch/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/metronic.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/layout.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/global.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/login-soft.js" ></script>
<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/backstretch.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	backstretch.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
