<?php 	
	$this->load->view('layout/_header');
	$this->load->view('layout/_pageheader');
?>
<!-- BEGIN PAGE CONTAINER -->  
    <div class="page-container">
  
        <!-- BEGIN BREADCRUMBS -->   
        <div class="row breadcrumbs margin-bottom-40">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1><?php echo $pageTitle;?></h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="">Home</a></li>
                        <?php 
						$temp = '';
						for($i=count($parentList['name'])-1; $i>=0; $i--){
							if($parentList['name'][$i]!=""){
								if($i==0){
						?>
							  <li class="active"><?php echo $parentList['name'][$i];?></li>               
						<?php 
								} else {
						?>
							  <li>
								<a href="<?php echo ($i==0)?'':$_SERVER['REQUEST_URI'];?>"><?php echo $parentList['name'][$i];?></a>
								<?php if($i!=0){ ?>
								<i class="icon-angle-right"></i>   
								<?php }?>
							  </li>
						<?php
								} 
							}
						}?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->

	  
		<div class="container min-hight">
			<!-- ROW 1 -->
			<div class="row margin-bottom-40">
         	<?php 
				$this->load->view($pageTemplate);
			?>
         </div>
         <!-- END PAGE CONTAINER-->    
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php 
	$this->load->view('layout/_scripts');
	$this->load->view('layout/_footer');
?>
