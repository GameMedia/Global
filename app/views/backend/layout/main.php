<?php 	
	$this->load->view($folderLayout.'_header');
	$this->load->view($folderLayout.'_pageheader');
?>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
	   
	  <?php $this->load->view($folderLayout.'_sidebar');?>
	  
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
         	<?php 
				$this->load->view($folderLayout.'_contentheader');
				?>
				<div class="row margin-top-20">
				<?php
				$this->load->view($folderView.$pageTemplate);
			?>
				</div>
			</div>
		</div>
		<!-- END Content -->
   </div>
   <!-- END CONTAINER -->

<?php 
	$this->load->view($folderLayout.'_scripts');
	$this->load->view($folderLayout.'_footer');
?>
