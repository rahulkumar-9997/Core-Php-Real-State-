<!-- Main Header -->
      <header class="main-header">
        <!-- Logo -->
        <a href="../dashboard/dashboard.php?token=<?php echo $_REQUEST['token']; ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?php echo $_SESSION['shortName']; ?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><img src="../../images/logo/logo.png" style="margin-left: -20px; margin-top: -1px;"/></b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
                 <?php
                    include '../../logger/incLog.php';
                    include '../../controller/config/dbConnection.php';
                    
                  $claMaturityPenList = "SELECT COUNT(*) FROM customer  WHERE status=1 AND claimed_maturity_payment_status=0 AND date(expairy_date) < NOW()";
                  $result = $con->query($claMaturityPenList);
                  if(mysqli_num_rows($result)>0){
                    while ($countRow = mysqli_fetch_array($result)) {
                                  $countPendingList = $countRow['COUNT(*)'];
                    }
                  ?>
              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" title="Maturity Pending <?php echo $countPendingList;?>" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-danger">
                      <?php
                      if(!empty($countPendingList)){
                          echo "<span title=".$countPendingList.">$countPendingList</span>";
                      }
                      ?> 
                      
                  </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header" style="color: #ff0000"><b>You have New notifications</b></li>
                  <li>
                    <ul class="menu">
                      <li>
                          <a href="../../view/customer/claimedMaturityPendingList.php?token=<?php echo $_REQUEST['token']; ?>">
                            <i class="fa fa-rupee"></i> <?php //echo $tMemb; ?> Claimed Maturity Pending.
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--<li class="footer"><a href="#?token=<?php echo $_REQUEST['token']; ?>">View all</a></li>-->
                </ul>
              </li>
              <?php
                  }else{
                  }
              ?>
              <!-- Tasks Menu -->
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo $_SESSION['profile_pic']; ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $_SESSION['user']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                      <img src="<?php echo $_SESSION['profile_pic']; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php 
                        echo $_SESSION['uid']; 
                      ?>
                      <small>Member since <?php echo $_SESSION['crDate'] ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                        <a href="../../view/user/changePassword.php?token=<?php echo $_REQUEST['token'] ?>" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                        <a href="../../controller/authentication/loginController.php?a=logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
