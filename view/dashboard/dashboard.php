<?php
    session_start();
    if($_SESSION['token']===$_REQUEST['token'] && $_SESSION['uid']===$_SESSION['euid']){
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<!---->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['title']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
    <link rel="stylesheet" href="../../assets/chart/morris.css">
  </head>
  
  <body class="hold-transition skin-blue sidebar-mini">
      <?php 
        
      ?>
    <div class="wrapper">
        <!-- Top navigation includes -->
        <?php require_once '../../includes/top.php'; ?>
        <!-- Left navigation includes -->
        <?php include_once '../../includes/left.php'; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Welcome
            <small><?php echo $_SESSION['user']; ?></small>
          </h1>
          <ol class="breadcrumb">
            <?php include '../../includes/showBranch.php';?>
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <?php
         include './openingClosingAmount.php';
        ?>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <?php 
                if(!empty($_REQUEST['info'])){
                    if(strpos(($_REQUEST['info']), 'success') !== FALSE){
                    ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b><i class="icon fa fa-check"></i><?php echo $_REQUEST['info']; ?></b>
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b><i class="icon fa fa-warning"></i><?php echo $_REQUEST['info']; ?></b>
                        </div>
                <?php
                    }
                }
            ?>
          <?php 
                //echo time() - $_SESSION["LAST_ACTIVITY"];
               /*() if (isset($_SESSION["LAST_ACTIVITY"])) {
                    if (time() - $_SESSION["LAST_ACTIVITY"] > 180) {
                        session_unset();     // unset $_SESSION variable for the run-time 
                        session_destroy();   // destroy session data in storage
                    } else{
                        $_SESSION["LAST_ACTIVITY"] = time(); // update last activity time stamp
                    }
                }*/
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-plus"></i> Dashboard</h3>

              <!--
                <abbr class="text-right">
                    <h6 class="help-block">D.S.M - Direct Sponsered Member</h6>
                </abbr>
              -->
            </div><!-- /.box-header -->
            
            <?php
             if($_SESSION['role']=='ROL001'){
            ?>
            <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/agent/agentList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Agent">  
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Active Agent</span>
                            <span class="info-box-number">
                                <?php
                                      $selectAgent = $con->query("SELECT COUNT(*) FROM agent WHERE status=1");
                                      while ($agentRow = mysqli_fetch_array($selectAgent)) {
                                          $agentCount = $agentRow['COUNT(*)'];
                                      }

                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                             <?php  echo $agentCount; ?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div>
              </a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/customerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Customer">
                    <div class="info-box bg-orange">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Active Customer</span>
                            <span class="info-box-number">
                                <?php
                                    $selectCustomer = $con->query("SELECT COUNT(*) FROM customer WHERE status=1");
                                    while ($customerRow = mysqli_fetch_array($selectCustomer)) {
                                        $customerCount = $customerRow['COUNT(*)'];
                                    }

                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $customerCount; ?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/branch/branchList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Branch">
                    <div class="info-box bg-blue">
                      <span class="info-box-icon"><i class="fa fa-code-fork"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> Total Active Branch</span>
                            <span class="info-box-number">
                                <?php
                                    $selectBranch = $con->query("SELECT COUNT(*) FROM branch WHERE status=1");
                                    while ($branchRow = mysqli_fetch_array($selectBranch)) {
                                        $branchCount = $branchRow['COUNT(*)'];
                                    }

                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php  echo $branchCount;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
               </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/plan/planList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Plan">
                    <div class="info-box bg-aqua">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Active Plan</span>
                            <span class="info-box-number">
                                <?php
                                  $selectPlan = $con->query("SELECT COUNT(*) FROM plan WHERE status=1");
                                    while ($planRow = mysqli_fetch_array($selectPlan)) {
                                        $planCount = $planRow['COUNT(*)'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $planCount;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/rdCustomerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total RD Customer">
                    <div class="info-box bg-yellow-active">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total RD Customer</span>
                            <span class="info-box-number">
                                <?php
                                /*cuPlnMap===Customer Plan Mapping Full Name*/
                                  $cuPlnMapRD = $con->query("SELECT COUNT(*) FROM customer_plan_mapping WHERE status=1 AND plan_type='RD'");
                                    while ($cuPlnMapRowRD = mysqli_fetch_array($cuPlnMapRD)) {
                                        $totalRdCustomer = $cuPlnMapRowRD['COUNT(*)'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $totalRdCustomer;?>
                            </span>
                        </div><!-- /.info-box-content -->
                   </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/fdCustomerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total FD Customer">
                    <div class="info-box bg-olive">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total FD Customer</span>
                                <span class="info-box-number">
                                    <?php
                                      $cuPlnMapFD = $con->query("SELECT COUNT(*) FROM customer_plan_mapping WHERE status=1 AND plan_type='FD'");
                                        while ($cuPlnMapRowFD = mysqli_fetch_array($cuPlnMapFD)) {
                                            $totalFdCustomer = $cuPlnMapRowFD['COUNT(*)'];
                                        }
                                    ?>
                                </span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                  <?php echo $totalFdCustomer;?>
                                </span>
                            </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/misCustomerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total MIS Customer">
                    <div class="info-box bg-maroon-gradient">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total MIS Customer</span>
                            <span class="info-box-number">
                                <?php
                                  $cuPlnMapMIS = $con->query("SELECT COUNT(*) FROM customer_plan_mapping WHERE status=1 AND plan_type='MIS'");
                                    while ($cuPlnMapRowMIS = mysqli_fetch_array($cuPlnMapMIS)) {
                                        $totalMisCustomer = $cuPlnMapRowMIS['COUNT(*)'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $totalMisCustomer;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
          <!--================================================== Agent Commission Amount Start ===================================-->
          <!--===================================== Agent Commission amount start========================================-->
              <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="#" title="Agent Commission Total Amount">
                  <!--<a href="../../view/agent/agentCommissionTotalAmountList.php?token=<?php echo $_REQUEST['token'];?>&dashboard" title="Agent Commission Total Amount">-->
                    <div class="info-box bg-fuchsia-active">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Agent Commission Total Amount</span>
                            <span class="info-box-number">
                                <?php
                                  $agentCommssionAmount = $con->query("SELECT SUM(commission_amount) AS agent_commission_amount FROM agent_commission_history WHERE status=1");
                                    while ($agentCommssionAmountRow = mysqli_fetch_array($agentCommssionAmount)) {
                                        $totalAmount = $agentCommssionAmountRow['agent_commission_amount'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalAmount, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Agent Commission Paid Amount">
                    <div class="info-box bg-purple-gradient">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Agent Commission Paid Amount</span>
                            <span class="info-box-number">
                                <?php
                                  $agentCommssionPaidAmount = $con->query("SELECT SUM(pay_amount) AS agent_commission_paid_amount FROM agent_pay_commission_history WHERE status=1");
                                    while ($agentCommssionPaidAmountRow = mysqli_fetch_array($agentCommssionPaidAmount)) {
                                        $totalPaidAmount = $agentCommssionPaidAmountRow['agent_commission_paid_amount'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalPaidAmount, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--===========================Agent commission available amount start==============================================-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Agent Commission Available Amount">
                    <div class="info-box bg-lime-active">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Agent Commission Payable Amount</span>
                            <span class="info-box-number">

                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalAmount-$totalPaidAmount, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--===========================Agent commission available amount end==============================================-->
            <!--==================Total deposit installment amt start=================-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Total Deposite Installment Amount">
                    <div class="info-box bg-maroon">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Deposit Amount</span>
                            <span class="info-box-number">
                              <?php
                                  $totalInstallmentAmount = $con->query("SELECT SUM(pay_amount) AS total_deposit_ins_amt FROM customer_installment_history WHERE status=1");
                                    while ($totalInsAmtRow = mysqli_fetch_array($totalInstallmentAmount)) {
                                        $totalDepositInsAmt = $totalInsAmtRow['total_deposit_ins_amt'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalDepositInsAmt, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--==================Total deposit installment amt end===================-->
            <!--========Total Paid Mis Amount Start==========-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Total Paid MIS Amount">
                    <div class="info-box bg-teal">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Paid MIS Amount</span>
                            <span class="info-box-number">
                              <?php
                                  $totalMisAmount = $con->query("SELECT SUM(pay_amount) AS total_paid_mis_amt FROM customer_pay_mis_history WHERE status=1");
                                    while ($totalMisAmtRow = mysqli_fetch_array($totalMisAmount)) {
                                        $totalPaidMisAmt = $totalMisAmtRow['total_paid_mis_amt'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalPaidMisAmt, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--========Total Paid Mis Amount End==========-->
           <!---================Expense============================ -->
           <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Total Expense">
                    <div class="info-box bg-fuchsia-active">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Expense</span>
                            <span class="info-box-number">
                              <?php
                                  $expense = $con->query("SELECT SUM(expense_amount) AS expAmt FROM expense WHERE status=1");
                                    while ($expeRow = mysqli_fetch_array($expense)) {
                                        $totalExp = $expeRow['expAmt'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalExp, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
           <!---================Expense============================ -->
           
            
          </div>
          <div class="row">
              <?php
              //print_r($monthOfDate);
                /*$date = '2017-07-01';
                $date = date('F, Y', strtotime($date));
                echo $date;*/
              $selectGraph="SELECT YEAR(c_date) AS y, MONTH(c_date) AS m, c_date, "
                      . "COUNT(CASE WHEN plan_type='RD'  THEN c_date END) AS rdCount, "
                      . "COUNT(CASE WHEN plan_type='FD'  THEN c_date END) AS fdCount, "
                      . "COUNT(CASE WHEN plan_type='MIS'  THEN c_date END) AS misCount"
                      . " FROM customer_plan_mapping  WHERE status=1 GROUP BY y, m;";
              $resultGraph=$con->query($selectGraph);
              $chart_data = '';
              while ($row1 = mysqli_fetch_array($resultGraph)){
                  $c_date=$row1['c_date'];
                  $cuDate = date('F y', strtotime($c_date));
                  /*$chart_data .= "{ m:'".$cuDate."', cuCount:".$row1["cuCount"]."}, ";*/
                   $chart_data .= "{ m:'".$cuDate."', rdCount:".$row1["rdCount"].", fdCount:".$row1["fdCount"].", misCount:".$row1["misCount"]."}, ";
              }
              $chart_data = substr($chart_data, 0, -2);
            ?>
            <!--Total Customer Register report month wise-->
            <div class="col-lg-6">
                <div style="width:500px">
                    <h4 align="center">Monthly Register Customer Graph</h4>
                  <div id="chart"></div>
                </div>
            </div>
            <!--Total Customer Register report month wise-->
            
            <!--Total Agent Register report month wise-->
            <?php
            $selectAgentGraph="SELECT YEAR(c_date) AS y, MONTH(c_date) AS m, c_date, COUNT(DISTINCT agency_code) AS agntCount FROM agent WHERE status=1 GROUP BY y, m";
            $agentGraphRe=$con->query($selectAgentGraph);
              $agent_data = '';
              while ($agentRowG = mysqli_fetch_array($agentGraphRe)){
                  $agentDate=$agentRowG['c_date'];
                  $agentDayYea = date('F y', strtotime($agentDate));
                  $agent_data .= "{ m:'".$agentDayYea."', agntCount:".$agentRowG["agntCount"]."}, ";
              }
              $agent_data = substr($agent_data, 0, -2);
            ?>
            <div class="col-lg-6">
                <div style="width:500px">
                    <h4 align="center">Monthly Register Agent Graph</h4>
                  <div id="agentChart"></div>
                </div>
            </div> 
            <!--Total Agent Register report month wise-->
          </div>
          <?php
             }else{
              ?>
              <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/agent/agentList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Agent">
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Active Agent</span>
                            <span class="info-box-number">
                                <?php
                                      $selectAgent = $con->query("SELECT COUNT(*) FROM agent WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'");
                                      while ($agentRow = mysqli_fetch_array($selectAgent)) {
                                          $agentCount = $agentRow['COUNT(*)'];
                                      }

                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                             <?php  echo $agentCount; ?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/customerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Customer">
                    <div class="info-box bg-orange">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Active Customer</span>
                            <span class="info-box-number">
                                <?php
                                    $selectCustomer = $con->query("SELECT COUNT(*) FROM customer WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'");
                                    while ($customerRow = mysqli_fetch_array($selectCustomer)) {
                                        $customerCount = $customerRow['COUNT(*)'];
                                    }

                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $customerCount; ?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/branch/branchList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Branch">
                    <div class="info-box bg-blue">
                      <span class="info-box-icon"><i class="fa fa-code-fork"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text"> Total Active Branch</span>
                            <span class="info-box-number">
                                <?php
                                    $selectBranch= $con->query("SELECT COUNT(*) FROM branch WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'");
                                    while ($branchRow = mysqli_fetch_array($selectBranch)) {
                                        $branchCount = $branchRow['COUNT(*)'];
                                    }

                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php  echo $branchCount;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/plan/planList.php?token=<?php echo $_REQUEST['token'];?>" title="Total Active Plan">
                    <div class="info-box bg-aqua">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Active Plan</span>
                            <span class="info-box-number">
                                <?php
                                    $selectPlan = $con->query("SELECT COUNT(*) FROM plan WHERE status=1");
                                    while ($planRow = mysqli_fetch_array($selectPlan)) {
                                        $planCount = $planRow['COUNT(*)'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $planCount;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/rdCustomerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total RD Customer">
                    <div class="info-box bg-yellow-active">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total RD Customer</span>
                            <span class="info-box-number">
                                <?php
                                /*cuPlnMap===Customer Plan Mapping Full Name*/
                                  $cuPlnMapRD = $con->query("SELECT COUNT(*) FROM customer_plan_mapping WHERE status=1 AND plan_type='RD' AND branch_id='{$_SESSION['branch_id']}'");
                                    while ($cuPlnMapRowRD = mysqli_fetch_array($cuPlnMapRD)) {
                                        $totalRdCustomer = $cuPlnMapRowRD['COUNT(*)'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $totalRdCustomer;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/fdCustomerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total FD Customer">
                    <div class="info-box bg-olive">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total FD Customer</span>
                            <span class="info-box-number">
                                <?php
                                  $cuPlnMapFD = $con->query("SELECT COUNT(*) FROM customer_plan_mapping WHERE status=1 AND plan_type='FD' AND branch_id='{$_SESSION['branch_id']}'");
                                    while ($cuPlnMapRowFD = mysqli_fetch_array($cuPlnMapFD)) {
                                        $totalFdCustomer = $cuPlnMapRowFD['COUNT(*)'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo $totalFdCustomer;?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="../../view/customer/misCustomerList.php?token=<?php echo $_REQUEST['token'];?>" title="Total MIS Customer">
                    <div class="info-box bg-maroon-gradient">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total MIS Customer</span>
                                <span class="info-box-number">
                                    <?php
                                      $cuPlnMapMIS = $con->query("SELECT COUNT(*) FROM customer_plan_mapping WHERE status=1 AND plan_type='MIS' AND branch_id='{$_SESSION['branch_id']}'");
                                        while ($cuPlnMapRowMIS = mysqli_fetch_array($cuPlnMapMIS)) {
                                            $totalMisCustomer = $cuPlnMapRowMIS['COUNT(*)'];
                                        }
                                    ?>
                                </span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                  <?php echo $totalMisCustomer;?>
                                </span>
                            </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <!--==============================================Commission amount start=============================================-->
             <div class="col-md-3 col-sm-6 col-xs-12">
                 <a href="#" title="Agent Commission Total Amount">
                    <div class="info-box bg-purple-gradient">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text"> Total Agent Commission Amount</span>
                            <span class="info-box-number">
                                <?php
                                $totalAmount=0;
                                $agentCommssionAmount = $con->query("SELECT ag.branch_id, ach.commission_amount FROM agent AS ag, agent_commission_history AS ach WHERE ach.status=1 AND ag.status=1 AND ag.agency_code=ach.agency_code AND ag.branch_id='{$_SESSION['branch_id']}'");
                                    while ($agentCommssionAmountRow = mysqli_fetch_array($agentCommssionAmount)) {
                                        $totalAmount += $agentCommssionAmountRow['commission_amount'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo number_format($totalAmount, 2);?>
                            </span>
                        </div>
                    </div>
                 </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Agent Commission Paid Amount">
                    <div class="info-box bg-purple-gradient">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Agent Commission Paid Amount</span>
                            <span class="info-box-number">
                                <?php
                                  $agentCommssionPaidAmount = $con->query("SELECT ag.branch_id, SUM(apch.pay_amount) AS agent_commission_paid_amount FROM agent AS ag, agent_pay_commission_history AS apch WHERE apch.status=1 AND ag.agency_code=apch.agency_code AND ag.status=1 AND ag.branch_id='{$_SESSION['branch_id']}'");
                                    while ($agentCommssionPaidAmountRow = mysqli_fetch_array($agentCommssionPaidAmount)) {
                                        $totalPaidAmount = $agentCommssionPaidAmountRow['agent_commission_paid_amount'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                              <?php echo number_format($totalPaidAmount, 2);?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <!--==============================================Commission amount end=============================================-->
            <!--===========================Agent commission available amount start==============================================-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Agent Commission Available Amount"> 
                    <div class="info-box bg-lime">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Agent Commission Payable Amount</span>
                            <span class="info-box-number">

                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalAmount-$totalPaidAmount, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--===========================Agent commission available amount end==============================================-->
            <!--==================Total deposit installment amt start=================-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Total Deposite Installment Amount">
                    <div class="info-box bg-maroon">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Deposit Amount</span>
                            <span class="info-box-number">
                              <?php
                                  $totalInstallmentAmount = $con->query("SELECT SUM(cih.pay_amount) AS total_deposit_installment FROM customer AS cu, customer_installment_history AS cih WHERE cu.customer_id = cih.customer_id AND cu.status=1 AND cih.status=1 AND cu.branch_id='{$_SESSION['branch_id']}'");
                                    while ($totalInsAmtRow = mysqli_fetch_array($totalInstallmentAmount)) {
                                        $totalDepositInsAmt = $totalInsAmtRow['total_deposit_installment'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalDepositInsAmt, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--==================Total deposit installment amt end===================-->
            <!--========Total Paid Mis Amount Start==========-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Total Paid MIS Amount">
                    <div class="info-box bg-teal">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Paid MIS Amount</span>
                            <span class="info-box-number">
                              <?php
                                  $totalMisAmount = $con->query("SELECT SUM(cpmh.pay_amount) AS total_paid_mis_amt FROM customer AS cu, customer_pay_mis_history AS cpmh WHERE cu.customer_id = cpmh.customer_id AND cu.status=1 AND cpmh.status=1 AND cu.branch_id='{$_SESSION['branch_id']}' ");
                                    while ($totalMisAmtRow = mysqli_fetch_array($totalMisAmount)) {
                                        $totalPaidMisAmt = $totalMisAmtRow['total_paid_mis_amt'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalPaidMisAmt, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
            <!--========Total Paid Mis Amount End==========-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="#" title="Total Expense">
                    <div class="info-box bg-fuchsia-active">
                      <span class="info-box-icon"><i class="fa fa-rupee"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Expense</span>
                            <span class="info-box-number">
                              <?php
                                  $expense = $con->query("SELECT SUM(expense_amount) AS expAmt FROM expense WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'");
                                    while ($expeRow = mysqli_fetch_array($expense)) {
                                        $totalExp = $expeRow['expAmt'];
                                    }
                                ?>
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-rupee"></i> <?php echo number_format($totalExp, 2);?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col --> 
          </div>
             <?php
             }
          ?>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php require_once '../../includes/bottom.php'; ?>
      
    <?php require_once '../../includes/footer_includes.php'; ?>
      
         <!--<script src="../../assets/chart/jquery.min.js"></script>-->
      <script type="text/javascript" src="../../assets/chart/morris.min.js"></script>
      <script type="text/javascript" src="../../assets/chart/raphael-min.js"></script>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>-->
<script>
        Morris.Bar({
         element : 'chart',
         data:[<?php echo $chart_data; ?>],
         xkey:'m',
         ykeys:['rdCount', 'fdCount', 'misCount'],
         //ykeys:['cuCount', 'purchase', 'sale'],
         labels:['Total RD Customer', 'Total FD Customer', 'Total MIS Customer'],
         //labels:['Profit', 'Purchase', 'Sale'],
         hideHover:'auto',
         stacked:true
        });
</script>
<script>
        Morris.Bar({
         element : 'agentChart',
         data:[<?php echo $agent_data; ?>],
         xkey:'m',
         ykeys:['agntCount'],
         //ykeys:['cuCount', 'purchase', 'sale'],
         labels:['Total agent'],
         //labels:['Profit', 'Purchase', 'Sale'],
         hideHover:'auto',
         stacked:true
        });
</script>
     <?php 
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
    ?>
  </body>
</html>
