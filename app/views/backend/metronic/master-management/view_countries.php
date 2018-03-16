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
								  <option value="1" data-column="1" selected>Code</option>
								  <option value="2" data-column="2" selected>Name</option>
								  <option value="3" data-column="3" selected>Timezone</option>
								  <option value="4" data-column="4" selected>Phone Prefix</option>
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
									<span></span>
								</div>
								<table class="table table-striped table-bordered table-hover" id="datatable">
								<thead>
								<tr role="row" class="heading">
									<th class="no-sort" width="50px">Rec.</th>
									<th width="130px">Code</th>
									<th>Name</th>
									<th width="90px">Timezone</th>
									<th width="90px">Phone Prefix</th>
									<th width="90px">is Active?</th>
									<th  class="no-sort" width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td><input type="text" name="search_code" id="search_code" class="form-control form-filter input-sm" placeholder="Search by Code"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name"></td>
									<td>
										<select class="form-control form-filter input-sm" id="search_utc_timezone" name="search_utc_timezone">
											<option value="">- Choose Timezone -</option>
											<?php 
											foreach($utc_timezone as $key => $val){
											?>
											<option value="<?php echo $key;?>"><?php echo $val;?></option>
											<?php } ?>
										</select>
									</td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_prefix" name="search_prefix" placeholder="Search by Description"></td>
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
							<form action="javascript:;" id="form_countries" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Country Code</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a country code" data-container="body"></i>
											<input type="text" maxlength="2" name="code" id="code" class="form-control form-filter" title="Country Code" placeholder="Country Code">
										</div>
									  </div>
									</div>
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
									  <label  class="col-md-3 control-label">Phone Prefix</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="3" name="prefix" id="prefix" class="form-control form-filter" title="Phone Prefix" placeholder="Phone Prefix">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Description</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="255" name="description" id="description" class="form-control form-filter" title="Description" placeholder="Description">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Timezone</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<select class="form-control" id="utc_timezone" name="utc_timezone">
												<option value="">- Choose Timezone -</option>
												<?php 
												foreach($utc_timezone as $key => $val){
												?>
												<option value="<?php echo $key;?>"><?php echo $val;?></option>
												<?php } ?>
											</select>
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
									<p style="float:left">Last update by <i id="update_by"></i> On <i id="update_time"></i></p>
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
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
	<script type="text/javascript" src="assets/js/backend/datatables.js?<?php echo date("mdH");?>"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/master-management/countries.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						code: {minlength: 2, maxlength: 2, required: true},
						name: {minlength: 4,required: true}
						};			
			
            FormValidation.init('form_countries', rules);
            
			TableAjax.init("datatable", "master-management/countries/loadCountries");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
						
		});

    </script>
<?php $this->load->view($folderLayout.'_modal');?>
