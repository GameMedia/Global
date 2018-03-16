	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<?php if(isset($closeSidebar) && $closeSidebar){ ?>
			<ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<?php } else { ?>
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">				
			<?php } ?>
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper hide">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -- >
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -- >
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -- >
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -- >
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span clas put-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -- >
				</li>-->
				<li style="margin-top:15px"></li>
				
<?php	
	if($menu['count']){
		$first = true;
		for($i=0; $i<count($menu['rows']); $i++){
			$start = "";
			if($first == true){
				$start = 'start ';
				$first = false;
			}
			$active = '';
			$open = '';
			if($parentList['count']){
				for($x=0; $x<count($parentList['rows']); $x++){				
					if($menu['rows'][$i]['id']==$parentList['rows'][$x]){
						$active = 'active ';
						$open = 'open ';
						
						#Set The title, description, breadcumb
						$menu['pageTitle'] = $menu['rows'][$i]['name'];
						$pageTitle = $menu['rows'][$i]['name'];
						$pageDescription = $menu['rows'][$i]['description'];
					}
				}
			}
			
			if(!empty($menu['rows'][$i]['sub'])){
				?>
                <li class="<?php echo $start.$active;?>">
					<a href="javascript:;">
					<i class="<?php echo $menu['rows'][$i]['icon'];?>"></i> 
					<span class="title"><?php echo $menu['rows'][$i]['name'];?></span>
					<span class="arrow <?php echo $open;?>"></span>
					<?php if(!empty($open)){?> <span class="selected"></span><?php }?>
					</a>
					<ul class="sub-menu">
                    	<?php
							for($ii=0; $ii<count($menu['rows'][$i]['sub']['rows']); $ii++){
								$activeSub = '';
								$openSub = '';
								for($x=0; $x<count($parentList['rows']); $x++){				
									if($menu['rows'][$i]['sub']['rows'][$ii]['id']==$parentList['rows'][$x]){
										$activeSub = 'active ';
										$openSub = 'open ';
										
										#Set The title, description, breadcumb
										$menu['pageTitle'] = $menu['rows'][$i]['sub']['rows'][$ii]['name'];
										$this->pageTitle = $menu['rows'][$i]['sub']['rows'][$ii]['name'];
										$pageDescription = $menu['rows'][$i]['sub']['rows'][$ii]['description'];
									}
								}
								if(!empty($menu['rows'][$i]['sub']['rows'][$ii]['sub']) && !empty($menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'])){
								?>
                                <li class="<?php echo $activeSub;?>">
                                	<a href="javascript:;">
										<i class="<?php echo $menu['rows'][$i]['icon'];?>"></i>
										<span class="title"><?php echo $menu['rows'][$i]['sub']['rows'][$ii]['name'];?></span>
										<span class="arrow <?php echo $open;?>"></span>
                                    <?php if(!empty($open)){?> <span class="selected"></span><?php }?>
                                    </a>
                                    <ul class="sub-menu">
                                    	<?php 
											for($iii=0; $iii<count($menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows']); $iii++){
												$activeSubSub = '';
												$openSubSub = '';
												for($x=0; $x<count($parentList['rows']); $x++){				
													if($menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['id']==$parentList['rows'][$x]){
														$activeSubSub = 'active ';
														$openSubSub = 'open ';
														
														#Set The title, description, breadcumb
														$menu['pageTitle'] = $menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['name'];
														$this->pageTitle = $menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['name'];
														$pageDescription = $menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['description'];
													}
												}
										?>
                                        <li class="<?php echo $activeSubSub;?>">
                                            <a href="<?php echo $menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['url'];?>">
												<i class="<?php echo $menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['icon'];?>"></i> 
												<span class="title"><?php echo $menu['rows'][$i]['sub']['rows'][$ii]['sub']['rows'][$iii]['name'];?></span>
                                        	</a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                <?php
								} else {
								?>
                                	<li class="<?php echo $activeSub;?>"> 
                                    	<a href="<?php echo $base_url_index.$menu['rows'][$i]['sub']['rows'][$ii]['url'];?>"><i class="<?php echo $menu['rows'][$i]['sub']['rows'][$ii]['icon'];?>"></i> <?php echo $menu['rows'][$i]['sub']['rows'][$ii]['name'];?></a></li>
                                <?php
								}
							}
						?>
					</ul>
				</li>
                <?php
			} else {
				?>
                <li class="<?php echo $start.$active;?>">
					<a href="<?php echo $base_url_index.$menu['rows'][$i]['url'];?>">
						<i class="<?php echo $menu['rows'][$i]['icon'];?>"></i> 
						<span class="title"><?php echo $menu['rows'][$i]['name'];?></span>
						<?php if(!empty($open)){?> <span class="selected"></span><?php }?>
					</a>
				</li>
                <?php
			}
		}
	}
?> 
		</div>
	</div>
	<!-- END SIDEBAR -->
