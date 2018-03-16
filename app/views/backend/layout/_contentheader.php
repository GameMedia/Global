			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						Home
						<i class="fa fa-angle-right"></i>
					</li>
					<?php 
					$temp = '';
					for($i=count($parentList['name'])-1; $i>=0; $i--){
						if($parentList['name'][$i]!=""){
							if($i==0){
					?>
						  <li><?php echo $parentList['name'][$i];?></li>               
						  
					<?php 
							} else {
					?>
						  <li>
							<?php echo $parentList['name'][$i];?></a>
							<?php if($i!=0){ ?>
							<i class="fa fa-angle-right"></i>  
							<?php }?>
						  </li>
					<?php
							} 
						}
					}?>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
