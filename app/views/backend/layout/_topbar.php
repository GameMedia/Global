   <div class="header navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
         <div class="container-fluid">
            <a class="brand" href="<?php echo $base_url;?>">
            <img src="assets/images/logo.png" alt="logo" style="height:40px !important; margin-top:-7px" />
            </a>
            <ul class="nav pull-right">
               <li class="dropdown user">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img alt="" src="assets/img/metronic/avatar/default.png" />
                  <span class="username"><?php echo $this->session->userdata['profile']['username'];?></span>
                  <i class="icon-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a href="<?php echo $base_url;?>user-management/account"><i class="icon-user"></i> My Profile</a></li>
                     <li class="divider"></li>
                     <li><a id="logout" href="javascript:;"><i class="icon-key"></i> Log Out</a></li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div id="logout-confirm" title="Logout ?" class="hide">
   <p><span class="icon icon-warning-sign"></span>
   You are about to logout from <?php echo $globalParameter['AppTitle'];?>. Are you sure?</p>
   </div>
