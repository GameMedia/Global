				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-multiselect/bootstrap-multiselect.css" type="text/css"/>
				<!--<div class="row margin-top-20">-->
				<div class="col-md-12 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase"><?php echo $pageTitle;?></span>
							</div>
							<div class="actions">
								<select id="colList" multiple="multiple" class="toggle-vis yellow-stripe">
								  <option value="0" data-column="0" selected>Rec</option>
								  <option value="1" data-column="1" selected>User Type</option>
								  <option value="2" data-column="2" selected>Privilege</option>
								  <option value="3" data-column="3" selected>Employee</option>
								  <option value="4" data-column="4" selected>Email</option>
								  <option value="5" data-column="5" selected>Phone</option>
								  <option value="6" data-column="6" selected>Is Active?</option>
								  <option value="7" data-column="7" selected>Action</option>
								</select>
								<?php if($accessAdd){?>
								<a href="#" class="btn default yellow-stripe" data-target="#formAdd" data-toggle="modal">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">Add <?php echo $pageTitle;?> </span>
								</a>
								<?php } ?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<div class="table-actions-wrapper">
									<span>
									</span>
								</div>
								<table class="table table-striped table-bordered table-hover" id="datatable">
								<thead>
								<tr role="row" class="heading">
									<th class="no-sort" width="30px">Rec.</th>
									<th>User Type</th>
									<th>Privilege</th>
									<th>Employee</th>
									<th>Email</th>
									<th width="85px">Phone</th>
									<th width="70px">is Active?</th>
									<th class="no-sort" width="85px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_user_type" id="search_id_user_type" class="form-control form-filter input-sm" onchange="getSelect(this.value, '', '<?php echo $privilege['title'];?>', '<?php echo $privilege['url'];?>', 'search_id_privilege')">
											<option value="">- All -</option>
											<?php 
											if($user_type['count']){ 
												for($i=0; $i<count($user_type['rows']); $i++){
											?>
											<option value="<?php echo $user_type['rows'][$i]['id']; ?>"><?php echo $user_type['rows'][$i]['name']; ?></option>
											<?php 
												}
											}
											?>
										</select>
									</td>
									<td>
										<select name="search_id_privilege" id="search_id_privilege" class="form-control form-filter input-sm" disabled>
											<option value="">- All -</option>
										</select>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_email" name="search_email" placeholder="Search by E-mail">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_phone" name="search_phone" placeholder="Search by Phone">
									</td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</td>
									<td><center>
										<div class="margin-bottom-5">
											<button class="btn btn-sm blue filter-submit margin-bottom" title="Search">Search</button>
											</div></center>
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--</div>-->
				<!-- /.modal -->
				<div id="formAdd" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="true" data-attention-animation="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_employees" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="50" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">E-mail</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email" data-container="body"></i>
											<input type="text" maxlength="50" name="email" id="email" data-required="1" class="form-control" title="Email" placeholder="E-mail" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Phone</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a phone number" data-container="body"></i>
											<input type="text" maxlength="20" name="phone" id="phone" data-required="1" class="form-control" title="Phone Number" placeholder="Phone Number" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Address</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="100" name="address" id="address" data-required="1" class="form-control" title="Address" placeholder="Address" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">is Active?</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose is Active" data-container="body"></i>
											<input type="checkbox" id="status" name="status" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
										</div>
									  </div>
									</div>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">User Type</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose a user type" data-container="body"></i>
											<select name="id_user_type" id="id_user_type" class="form-control form-filter" onchange="getSelect(this.value, '', '<?php echo $privilege['title'];?>', '<?php echo $privilege['url'];?>', 'id_privilege')">
												<option value="">- Choose User Type -</option>
												<?php 
												if($user_type['count']){ 
													for($i=0; $i<count($user_type['rows']); $i++){
												?>
												<option value="<?php echo $user_type['rows'][$i]['id']; ?>"><?php echo $user_type['rows'][$i]['name']; ?></option>
												<?php 
													}
												}
												?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-3 control-label">Privilege</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose a privilege" data-container="body"></i>
											<select name="id_privilege" id="id_privilege" class="form-control form-filter" disabled>
												<option value="">- Choose Privilege -</option>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Username</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a username" data-container="body"></i>
											<input type="text" maxlength="25" name="username" id="username" data-required="1" class="form-control" title="Username" placeholder="Username" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Password</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email" data-container="body"></i>
											<input type="password" maxlength="50" name="password" id="password" data-required="1" class="form-control" title="Password" placeholder="Password" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Conf. Password</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a conf. password" data-container="body"></i>
											<input type="password" maxlength="50" name="conf_password" id="conf_password" data-required="1" class="form-control" title="Conf. Password" placeholder="Conf. Password" />
										</div>
									  </div>
									</div>
								</div>
								<div class="modal-footer">
									<p style="float:left">Last update by <i id="update_by"></i> On <i id="update_time"></i></p>
									<button type="button" class="btn btn-close-modal" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red<?php echo ($accessEdit)?' btn-edit':'';?><?php echo ($accessAdd)?' btn-add':'';?>"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
	
	<script type="text/javascript" src="assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	
	<script type="text/javascript" src="assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="assets/plugins/bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
	<script type="text/javascript" src="assets/js/backend/datatables.js?<?php echo date("mdH");?>"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/user-management/employees.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">		
		var deleteID = "",
			deleteLangID = "",
			privilegeTitle = "<?php echo $privilege['title'];?>",
			privilegeUrl = "<?php echo $privilege['url'];?>";
		
		jQuery(document).ready(function() {	
			
			//Define Validation
			var rules = {
						id_user_type: {required: true},
						id_privilege: {required: true},
						name: {minlength: 4,required: true},
						email: {required: true},
						phone: {required: true},
						username: {required: true},
						password: {minlength: 8},
						conf_password: {minlength: 8}
						};			
			
            FormValidation.init('form_employees', rules);
            
			TableAjax.init("datatable", "user-management/employees/loadEmployees");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
		});
    </script>
	<?php $this->load->view($folderLayout.'_modal');?>
