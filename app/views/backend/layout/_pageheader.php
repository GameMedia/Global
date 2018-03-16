<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="">
			<img src="assets/images/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -- >
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					< ?php echo ($notifications['count'])?count($notifications['rows']):0; ?> </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3><span class="bold">< ?php echo ($notifications['count'])?count($notifications['rows']):0; ?> pending</span> notifications</h3>
						</li>
						< ?php if($notifications['count']){ ?>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								< ?php foreach($notifications['rows'] as $key){ ?>
								<li>
									<a href="javascript:;">
									<span class="time">< ?php echo date('d M H:i', strtotime($key['entry_time']));?></span>
									<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-plus"></i>
									< ?php if($key['type'] == 'Register'){ ?>
									</span>< ?php echo $key['name'];?> is registered. </span>
									< ?php } ?>
									< ?php if($key['type'] == 'IPKA'){ ?>
									</span>New IPKA from < ?php echo $key['name'];?> </span>
									< ?php } ?>
									< ?php if($key['type'] == 'ABTC'){ ?>
									</span>New ABTC from < ?php echo $key['name'];?> </span>
									< ?php } ?>
									</a>
								</li>
								< ?php } ?>								
							</ul>
						</li>
						< ?php } ?>
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->
				
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="assets/images/global/user-48.png"/>
					<span class="username username-hide-on-mobile"><?php echo $profile['name_employee'];?></span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="user-management/account">
							<i class="icon-user"></i> My Profile </a>
						</li>
						
						<li class="divider">
						</li>
						<li>
							<a href="backend/lockscreen">
							<i class="icon-lock"></i> Lock Screen </a>
						</li>
						<li>
							<a href="backend/out">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="backend/out" class="dropdown-toggle" title="Log Out"><i class="icon-logout"></i></a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
