				<link rel="stylesheet" type="text/css" href="assets/css/backend/pages/profile.css"/>
				<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-toastr/toastr.min.css"/>
				
				
				
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar">
						<!-- PORTLET MAIN -->
						<div class="portlet light profile-sidebar-portlet">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
								<img src="assets/images/global/user-512.png" class="img-responsive" alt="">
							</div>
							<!-- END SIDEBAR USERPIC -->
							<!-- SIDEBAR USER TITLE -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									 <?php echo $profile['name_employee'];?>
								</div>
								<div class="profile-usertitle-job">
									 Developer
								</div>
							</div>
							<!-- END SIDEBAR USER TITLE -->
							
							<!-- SIDEBAR MENU -->
							<div class="profile-usermenu">
								<ul class="nav">
									<li class="active"><a href="user-management/account"><i class="icon-home"></i>Overview </a>
									</li>
									<li>
										<a href="#" data-target="#formAdd" data-toggle="modal"><i class="icon-settings"></i>Account Settings </a>
									</li>
									<li>
										<a href="#" data-target="#formChangePassword" data-toggle="modal"><i class="icon-key"></i>Change Password </a>
									</li>
								</ul>
							</div>
							<!-- END MENU -->
						</div>
						<!-- END PORTLET MAIN -->
					</div>
					<!-- END BEGIN PROFILE SIDEBAR -->
				</div>
				
				<!-- modal update data -->
				<div id="formAdd" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_account" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id_employee" id="id_employee" readonly class="span6 m-wrap" value="<?php echo $profile['id_employee'];?>"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="50" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" Readonly value="<?php echo $userInformation['name'];?>" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">E-mail</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="50" name="email" id="email" data-required="1" class="form-control" title="Email Account" placeholder="Email Account" value="<?php echo $userInformation['email'];?>"/>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Phone</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="50" name="phone" id="phone" data-required="1" class="form-control" title="Phone" placeholder="Phone" value="<?php echo $userInformation['phone'];?>"/>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Address</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="50" name="address" id="address" data-required="1" class="form-control" title="Address" placeholder="Address" value="<?php echo $userInformation['address'];?>"/>
										</div>
									  </div>
									</div>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- modal Change Password Account -->
				<div id="formChangePassword" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Change Password | <?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_change_password" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="change_password_id" id="change_password_id" readonly class="span6 m-wrap" value="<?php echo $profile['id'];?>"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Username</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="50" name="change_password_email_user" id="change_password_email_user" data-required="1" class="form-control" title="Email Account & Username" placeholder="Username" Readonly value="<?php echo $profile['username'];?>"/>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Curr. Password</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a current password" data-container="body"></i>
											<input type="password" maxlength="50" name="change_password_curr_password" id="change_password_curr_password" data-required="1" class="form-control" title="Current Password" placeholder="Current Password"/>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">New Password</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a new password" data-container="body"></i>
											<input type="password" maxlength="50" name="change_password_new_password" id="change_password_new_password" data-required="1" class="form-control" title="New Password" placeholder="New Password"/>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Conf. Password</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a confirmation password" data-container="body"></i>
											<input type="password" maxlength="50" name="change_password_conf_password" id="change_password_conf_password" data-required="1" class="form-control" title="Conf. Password" placeholder="Conf. Password"/>
										</div>
									  </div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
					
	<script type="text/javascript" src="assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	
	<script type="text/javascript" src="assets/plugins/bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/user-management/account.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			FormValidation.init();
			FormValidationChangePassword.init();
			UIToastr.init();
			
			$("#isAdmin").bootstrapSwitch();
		});
    </script>
	<?php $this->load->view($folderLayout.'_modal');?>
