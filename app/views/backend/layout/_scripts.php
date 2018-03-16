<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <?php echo date('Y');?> © <?php echo $globalParameter['EmployerTitle'];?> - <?php echo $globalParameter['AppTitle'];?>. ALL Rights Reserved.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->

    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->
    <script src="<?php echo ASSETS_PLUGINS;?>jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_PLUGINS;?>jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_PLUGINS;?>jquery-ui-touch-punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_PLUGINS;?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_PLUGINS;?>bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_PLUGINS;?>jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_PLUGINS;?>jquery.blockui.min.js" type="text/javascript"></script> 
    <script src="<?php echo ASSETS_PLUGINS;?>jquery.cokie.min.js" type="text/javascript"></script> 
    <script src="<?php echo ASSETS_PLUGINS;?>uniform/jquery.uniform.min.js" type="text/javascript"></script> 
    
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery-validation/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>jquery-validation/js/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-switch/js/bootstrap-switch.min.js"></script>

	<!-- END PAGE LEVEL PLUGINS -->
    
    <script src="<?php echo ASSETS_JS;?>backend/metronic.js"></script>
    <script src="<?php echo ASSETS_JS;?>backend/layout.js"></script>
    <script src="<?php echo ASSETS_JS;?>backend/quick-sidebar.js"></script>
    <script src="<?php echo ASSETS_JS;?>backend/global.js"></script>
    <script src="<?php echo ASSETS_JS;?>backend/validation.js"></script>
    
    
        
    <script type="text/javascript">
		var domain = '<?php echo $base_url_index; ?>';
		
			jQuery(document).ready(function() {       
				// initiate layout and plugins
				Metronic.init(); // init metronic core components
				Layout.init(); // init current layout
				QuickSidebar.init(); // init quick sidebar
			});			
    </script>
