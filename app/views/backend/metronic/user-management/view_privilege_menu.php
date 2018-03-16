				<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.css"/>
				<!--<div class="row margin-top-20">-->
				<div class="col-md-12 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase"><?php echo $pageTitle;?></span>
							</div>
							<div class="actions">
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
									<th width="50px">Rec.</th>
									<th>Privilege</th>
									<th>Name</th>
									<th>URL</th>
									<th width="120px">Icon</th>
									<th width="100px">is Active?</th>
									<th width="145px">Access</th>
									<th width="95px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td> <!-- 1 rec-->
									<td> <!-- 2 privilege-->
										<select name="search_id_privilege" id="search_id_privilege" class="form-control form-filter input-sm">
											<?php 
											if($privileges['count']){ 
												for($i=0; $i<count($privileges['rows']); $i++){
											?>
											<option value="<?php echo $privileges['rows'][$i]['id']; ?>"><?php echo $privileges['rows'][$i]['name']; ?></option>
											<?php 
												}
											}
											?>
										</select></td>
									<td><!-- 3 name-->
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td> <!-- 4 url-->
										<select name="search_id_menu" id="search_id_menu" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php 
											if(isset($sortedMenu['rows'])){ 
												for($i=0; $i<count($sortedMenu['rows']); $i++){
											?>
											<option value="<?php echo $sortedMenu['rows'][$i]['id']; ?>"><?php echo $sortedMenu['rows'][$i]['name']; ?></option>
											<?php 
												}
											}
											?>
										</select>
									</td>
									<td><!-- 5 icon--></td>
									<td><!-- 6 active-->
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</td>
									<td><!-- 6 access --></td>
									<td><!-- 7 action-->
										<div class="margin-bottom-5">
											<button class="btn btn-sm blue filter-submit margin-bottom" onclick="loadPrivilege_Menu()" title="Search">Search</button>
										</div>	
									</td>
								</tr>
								</thead>
								<tbody id="body-table">
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--</div>-->
				<!-- /.modal pop up-->
				<div id="formAdd" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_privilege_menu" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Parent</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<select name="parent" id="parent" class="form-control form-filter">
												<option value="0">- Parent -</option>
												<?php 
												if(isset($sortedMenu['rows'])){ 
													for($i=0; $i<count($sortedMenu['rows']); $i++){
												?>
												<option value="<?php echo $sortedMenu['rows'][$i]['id']; ?>"><?php echo $sortedMenu['rows'][$i]['name']; ?></option>
												<?php 
													}
												}
												?>
											</select>
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
									  <label  class="col-md-3 control-label">Description</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="text" maxlength="50" name="description" id="description" data-required="1" class="form-control" title="Description" placeholder="Description" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">URL</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a url" data-container="body"></i>
											<input type="text" maxlength="100" name="url" id="url" data-required="1" class="form-control" title="URL" placeholder="URL" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Icon</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<select name="icon" id="icon" class="form-control form-filter">
												<option value="">- Choose Icon -</option>
												<option value="icon-action-redo"> icon-action-redo </option>
												<option value="icon-action-undo"> icon-action-undo </option>
												<option value="icon-anchor"> icon-anchor </option>
												<option value="icon-arrow-down"> icon-arrow-down </option>
												<option value="icon-arrow-left"> icon-arrow-left </option>
												<option value="icon-arrow-right"> icon-arrow-right </option>
												<option value="icon-arrow-up"> icon-arrow-up </option>
												<option value="icon-badge"> icon-badge </option>
												<option value="icon-bag"> icon-bag </option>
												<option value="icon-ban"> icon-ban </option>
												<option value="icon-bar-chart"> icon-bar-chart </option>
												<option value="icon-basket"> icon-basket </option>
												<option value="icon-basket-loaded"> icon-basket-loaded </option>
												<option value="icon-bell"> icon-bell </option>
												<option value="icon-book-open"> icon-book-open </option>
												<option value="icon-briefcase"> icon-briefcase </option>
												<option value="icon-bubble"> icon-bubble </option>
												<option value="icon-bubbles"> icon-bubbles </option>
												<option value="icon-bulb"> icon-bulb </option>
												<option value="icon-calculator"> icon-calculator </option>
												<option value="icon-calendar"> icon-calendar </option>
												<option value="icon-call-end"> icon-call-end </option>
												<option value="icon-call-in"> icon-call-in </option>
												<option value="icon-call-out"> icon-call-out </option>
												<option value="icon-camcorder"> icon-camcorder </option>
												<option value="icon-camera"> icon-camera </option>
												<option value="icon-check"> icon-check </option>
												<option value="icon-chemistry"> icon-chemistry </option>
												<option value="icon-clock"> icon-clock </option>
												<option value="icon-close"> icon-close </option>
												<option value="icon-cloud-download"> icon-cloud-download </option>
												<option value="icon-cloud-upload"> icon-cloud-upload </option>
												<option value="icon-compass"> icon-compass </option>
												<option value="icon-control-end"> icon-control-end </option>
												<option value="icon-control-forward"> icon-control-forward </option>
												<option value="icon-control-pause"> icon-control-pause </option>
												<option value="icon-control-play"> icon-control-play </option>
												<option value="icon-control-rewind"> icon-control-rewind </option>
												<option value="icon-control-start"> icon-control-start </option>
												<option value="icon-credit-card"> icon-credit-card </option>
												<option value="icon-crop"> icon-crop </option>
												<option value="icon-cup"> icon-cup </option>
												<option value="icon-cursor"> icon-cursor </option>
												<option value="icon-cursor-move"> icon-cursor-move </option>
												<option value="icon-diamond"> icon-diamond </option>
												<option value="icon-direction"> icon-direction </option>
												<option value="icon-directions"> icon-directions </option>
												<option value="icon-disc"> icon-disc </option>
												<option value="icon-dislike"> icon-dislike </option>
												<option value="icon-doc"> icon-doc </option>
												<option value="icon-docs"> icon-docs </option>
												<option value="icon-drawer"> icon-drawer </option>
												<option value="icon-drop"> icon-drop </option>
												<option value="icon-earphones"> icon-earphones </option>
												<option value="icon-earphones-alt"> icon-earphones-alt </option>
												<option value="icon-emoticon-smile"> icon-emoticon-smile </option>
												<option value="icon-energy"> icon-energy </option>
												<option value="icon-envelope"> icon-envelope </option>
												<option value="icon-envelope-letter"> icon-envelope-letter </option>
												<option value="icon-envelope-open"> icon-envelope-open </option>
												<option value="icon-equalizer"> icon-equalizer </option>
												<option value="icon-eye"> icon-eye </option>
												<option value="icon-eyeglasses"> icon-eyeglasses </option>
												<option value="icon-feed"> icon-feed </option>
												<option value="icon-film"> icon-film </option>
												<option value="icon-fire"> icon-fire </option>
												<option value="icon-flag"> icon-flag </option>
												<option value="icon-folder"> icon-folder </option>
												<option value="icon-folder-alt"> icon-folder-alt </option>
												<option value="icon-frame"> icon-frame </option>
												<option value="icon-game-controller"> icon-game-controller </option>
												<option value="icon-ghost"> icon-ghost </option>
												<option value="icon-globe"> icon-globe </option>
												<option value="icon-globe-alt"> icon-globe-alt </option>
												<option value="icon-graduation"> icon-graduation </option>
												<option value="icon-graph"> icon-graph </option>
												<option value="icon-grid"> icon-grid </option>
												<option value="icon-handbag"> icon-handbag </option>
												<option value="icon-heart"> icon-heart </option>
												<option value="icon-home"> icon-home </option>
												<option value="icon-hourglass"> icon-hourglass </option>
												<option value="icon-info"> icon-info </option>
												<option value="icon-key"> icon-key </option>
												<option value="icon-layers"> icon-layers </option>
												<option value="icon-like"> icon-like </option>
												<option value="icon-link"> icon-link </option>
												<option value="icon-list"> icon-list </option>
												<option value="icon-lock"> icon-lock </option>
												<option value="icon-lock-open"> icon-lock-open </option>
												<option value="icon-login"> icon-login </option>
												<option value="icon-logout"> icon-logout </option>
												<option value="icon-loop"> icon-loop </option>
												<option value="icon-magic-wand"> icon-magic-wand </option>
												<option value="icon-magnet"> icon-magnet </option>
												<option value="icon-magnifier"> icon-magnifier </option>
												<option value="icon-magnifier-add"> icon-magnifier-add </option>
												<option value="icon-magnifier-remove"> icon-magnifier-remove </option>
												<option value="icon-map"> icon-map </option>
												<option value="icon-microphone"> icon-microphone </option>
												<option value="icon-mouse"> icon-mouse </option>
												<option value="icon-moustache"> icon-moustache </option>
												<option value="icon-music-tone"> icon-music-tone </option>
												<option value="icon-music-tone-alt"> icon-music-tone-alt </option>
												<option value="icon-note"> icon-note </option>
												<option value="icon-notebook"> icon-notebook </option>
												<option value="icon-paper-clip"> icon-paper-clip </option>
												<option value="icon-paper-plane"> icon-paper-plane </option>
												<option value="icon-pencil"> icon-pencil </option>
												<option value="icon-picture"> icon-picture </option>
												<option value="icon-pie-chart"> icon-pie-chart </option>
												<option value="icon-pin"> icon-pin </option>
												<option value="icon-plane"> icon-plane </option>
												<option value="icon-playlist"> icon-playlist </option>
												<option value="icon-plus"> icon-plus </option>
												<option value="icon-pointer"> icon-pointer </option>
												<option value="icon-power"> icon-power </option>
												<option value="icon-present"> icon-present </option>
												<option value="icon-printer"> icon-printer </option>
												<option value="icon-puzzle"> icon-puzzle </option>
												<option value="icon-question"> icon-question </option>
												<option value="icon-refresh"> icon-refresh </option>
												<option value="icon-reload"> icon-reload </option>
												<option value="icon-rocket"> icon-rocket </option>
												<option value="icon-screen-desktop"> icon-screen-desktop </option>
												<option value="icon-screen-smartphone"> icon-screen-smartphone </option>
												<option value="icon-screen-tablet"> icon-screen-tablet </option>
												<option value="icon-settings"> icon-settings </option>
												<option value="icon-share"> icon-share </option>
												<option value="icon-share-alt"> icon-share-alt </option>
												<option value="icon-shield"> icon-shield </option>
												<option value="icon-shuffle"> icon-shuffle </option>
												<option value="icon-size-actual"> icon-size-actual </option>
												<option value="icon-size-fullscreen"> icon-size-fullscreen </option>
												<option value="icon-social-dribbble"> icon-social-dribbble </option>
												<option value="icon-social-dropbox"> icon-social-dropbox </option>
												<option value="icon-social-facebook"> icon-social-facebook </option>
												<option value="icon-social-tumblr"> icon-social-tumblr </option>
												<option value="icon-social-twitter"> icon-social-twitter </option>
												<option value="icon-social-youtube"> icon-social-youtube </option>
												<option value="icon-speech"> icon-speech </option>
												<option value="icon-speedometer"> icon-speedometer </option>
												<option value="icon-star"> icon-star </option>
												<option value="icon-support"> icon-support </option>
												<option value="icon-symbol-female"> icon-symbol-female </option>
												<option value="icon-symbol-male"> icon-symbol-male </option>
												<option value="icon-tag"> icon-tag </option>
												<option value="icon-target"> icon-target </option>
												<option value="icon-trash"> icon-trash </option>
												<option value="icon-trophy"> icon-trophy </option>
												<option value="icon-umbrella"> icon-umbrella </option>
												<option value="icon-user"> icon-user </option>
												<option value="icon-user-female"> icon-user-female </option>
												<option value="icon-user-follow"> icon-user-follow </option>
												<option value="icon-user-following"> icon-user-following </option>
												<option value="icon-user-unfollow"> icon-user-unfollow </option>
												<option value="icon-users"> icon-users </option>
												<option value="icon-vector"> icon-vector </option>
												<option value="icon-volume-1"> icon-volume-1 </option>
												<option value="icon-volume-2"> icon-volume-2 </option>
												<option value="icon-volume-off"> icon-volume-off </option>
												<option value="icon-wallet"> icon-wallet </option>
												<option value="icon-wrench"> icon-wrench </option>
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
									<button type="button" class="btn btn-close-modal" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red<?php echo ($accessEdit)?' btn-edit':'';?><?php echo ($accessAdd)?' btn-add':'';?>"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/user-management/privilege_menu.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		var accessEdit = "<?php echo ($accessEdit)?'1':'0';?>";
		var accessDelete = "<?php echo ($accessDelete)?'1':'0';?>";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						name: {minlength: 4,required: true},
						url: {required: true}
						};			
			
            FormValidation.init('form_privilege_menu', rules);
			loadPrivilege_Menu();
			UIToastr.init();
		});
    </script>
	<?php $this->load->view($folderLayout.'_modal');?>
