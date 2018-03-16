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
								  <option value="1" data-column="1" selected>Email</option>
								  <option value="2" data-column="2" selected>Template Code</option>
								  <option value="3" data-column="3" selected>Name</option>
								  <option value="4" data-column="4" selected>Title</option>
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
									<th class="no-sort" width="50px">Rec.</th>
									<th>Email</th>
									<th>Template Code</th>
									<th>Name</th>
									<th>Title</th>
									<th width="70px">is Active?</th>
									<th class="no-sort" width="85px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_email" id="search_id_email" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php 
											if($emails['count']){ 
												for($i=0; $i<count($emails['rows']); $i++){
											?>
											<option value="<?php echo $emails['rows'][$i]['id'];?>"><?php echo $emails['rows'][$i]['name'];?></option>
											<?php } } ?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_code" name="search_code" placeholder="Search by Code">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_title" name="search_title" placeholder="Search by Title">
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
											<button class="btn btn-sm yellow filter-submit margin-bottom" title="Search"><i class="fa fa-search"></i></button>
											<button class="btn btn-sm red filter-cancel" title="Reset" onclick="clearSearchForm()"><i class="fa fa-times"></i></button>
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
							<form action="javascript:;" id="form_email_template" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Email Sender</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose a name" data-container="body"></i>
											<select name="id_email" id="id_email" class="form-control form-filter">
												<option value="">- Email Sender -</option>
												<?php 
												if($emails['count']){ 
													for($i=0; $i<count($emails['rows']); $i++){
												?>
												<option value="<?php echo $emails['rows'][$i]['id'];?>"><?php echo $emails['rows'][$i]['name'];?></option>
												<?php } } ?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Template Code</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a template code" data-container="body"></i>
											<input type="text" maxlength="50" name="code" id="code" data-required="1" class="form-control" title="Template Code" placeholder="Template Code" />
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
									  <label  class="col-md-3 control-label">Email Title</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a email title" data-container="body"></i>
										<input type="text" maxlength="255" name="title" id="title" data-required="1" class="form-control" title="Email Title" placeholder="Email Title" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Email Content</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<a href="#" class="btn default yellow-stripe" data-target="#formEditor" data-toggle="modal">
												<i class="fa fa-share"></i>
												<span class="hidden-480">Editor</span>
											</a>
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
				
				<!-- /.modal Editor-->
				<div id="formEditor" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog modal-full">
						<div class="modal-content" id="modal-content-editor">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?> - Content</h4>
							</div>
							<div class="modal-body" id="modal-body-editor">
								<div class="form-group">
								  <div class="col-md-12">
									<textarea name="content" id="content" class="m-wrap"></textarea>
								  </div>
								</div>									
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-close-modal" data-dismiss="modal">Close</button>
							</div>
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
	
	<script type="text/javascript" src="<?php echo ASSETS_JS;?>backend/parameters/email_template.js?<?php echo date("mdH");?>"></script>
	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>ckeditor/ckeditor.js"></script> 
	
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						id_email: {required: true},
						code: {minlength: 2,required: true},
						name: {minlength: 4,required: true},
						title: {required: true}
						};			
			
            FormValidation.init('form_email_template', rules);
            
			TableAjax.init("datatable", "parameters/email_template/loadEmail_Template");
			UIToastr.init();
						
			bootstrapMultiselect("colList");
		});
		
		$(function(){
		  $('#modal-body-editor').css({ height: ($(window).innerHeight()-180)});
		  $('#cke_1_contents').css({ height: ($(window).innerHeight()-340) });
		  $(window).resize(function(){
			$('#modal-body-editor').css({ height: ($(window).innerHeight()-180) });
			$('#cke_1_contents').css({ height: ($(window).innerHeight()-340) });
		  });
		});
		
		CKEDITOR.replace( 'content', {
			fullPage: true,
			allowedContent: true,
			extraPlugins: 'wysiwygarea'
		});
    </script>
	<?php $this->load->view($folderLayout.'_modal');?>
