				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.css" type="text/css" />
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
								  <option value="1" data-column="1" selected>Name</option>
								  <option value="2" data-column="2" selected>Email User</option>
								  <option value="3" data-column="3" selected>Host</option>
								  <option value="4" data-column="4" selected>Port</option>
								  <option value="5" data-column="5" selected>Is Active?</option>
								  <option value="6" data-column="6" selected>Action</option>
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
									<th class="no-sort" width="50px"> Rec. </th>
									<th> Name </th>
									<th> Email User </th>
									<th width="130px"> Host </th>
									<th width="100px"> Port </th>
									<th width="100px"> is Active? </th>
									<th class="no-sort" width="100px"> Actions </th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_email_user" name="search_email_user" placeholder="Search by Email">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_host" name="search_host" placeholder="Search by Host">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_port" name="search_port" placeholder="Search by Port">
									</td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</td>
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm blue filter-submit margin-bottom" title="Search">Search</button>
										</div>
										
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
				<div id="formAdd" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_email" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose a name" data-container="body"></i>
											<input type="text" maxlength="50" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Email User</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email user" data-container="body"></i>
										<input type="text" maxlength="100" name="email_user" id="email_user" data-required="1" class="form-control" title="Email User" placeholder="Email User" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Email Pass</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email password" data-container="body"></i>
										<input type="password" maxlength="255" name="email_pass" id="email_pass" data-required="1" class="form-control" title="Email Password" placeholder="Email Password" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Email Host</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email host" data-container="body"></i>
										<input type="text" maxlength="100" name="host" id="host" data-required="1" class="form-control" title="Email Host" placeholder="Email Host" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Email Port</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email port" data-container="body"></i>
										<input type="text" maxlength="5" name="port" id="port" data-required="1" class="form-control" title="Email Port" placeholder="Email Port" />
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
								<div class="modal-footer">
									<button type="button" class="btn btn-close-modal" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red<?php echo ($accessEdit)?' btn-edit':'';?><?php echo ($accessAdd)?' btn-add':'';?>"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-multiselect/bootstrap-multiselect.js"></script>	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/datatable.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/datatables.js?<?php echo date("mdH");?>"></script>
    <script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/parameters/email.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						name: {minlength: 4,required: true},
						email_user: {required: true, email: true},
						host: {required: true},
						port: {required: true}
						};			
			
            FormValidation.init('form_email', rules);
            
			TableAjax.init("datatable", "parameters/email/loadEmail");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
			
			/*FormValidation.init();
			TableAjax.init();
			UIToastr.init();*/
						
			//success,info,warning,error
			//UIToastr.showToaster("error", "Tes", "Halo");
		});
    </script>
	<?php $this->load->view($folderLayout.'_modal');?>
