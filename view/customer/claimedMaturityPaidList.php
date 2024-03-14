<?php
    session_start();
    if($_SESSION['token']===$_REQUEST['token'] && $_SESSION['uid']===$_SESSION['euid']){
        include '../../includes/timeout.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['title'].": Claimed Maturity Payment List"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
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
            <li class="active">Manage Customer</li>
            <li class="active">Claimed Maturity Paid List</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-list"></i> Claimed Maturity Paid List</h3>
            </div><!-- /.box-header -->
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
            <div class="box-body" style="overflow-x: auto; ">
                <?php
                if($_SESSION['role']=='ROL001'){
                ?>
                <table id="example1" class="table table-bordered table-striped" style="width: 135%;">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Customer Name</th>
                        <th>Plan Name</th>
                        <th>Plan Type</th>
                        <th>Joining Date</th>
                        <th>Expiry Date.</th>
                        <th>No Of Installment.</th>
                        <th>No. Of Paid Installment.</th>
                        <th>Installment Amount.</th>
                        <th>Paid Installment Amount.</th>
                        <!--<th>Installment</th>-->
                        <th>Maturity Return</th>
                        <th>Maturity Paid Amount</th>
                        <th>Maturity Paid Date</th>
                        <th>Pay Mode</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "SELECT cu.id, cu.customer_id, cu.registration_no, cu.sr_no, cu.agency_code, cu.claimed_maturity_payment_status,"
                                    . " cu.branch_id, cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, "
                                    . "cpm.customer_id, cpm.agency_code, cpm.no_of_installment, cpm.no_of_pay_installment, cpm.plan_name, cpm.plan_duration,"
                                    . " cpm.commision_in_per, cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, "
                                    . "cpm.installment_amount, cpm.maturity_return, cmrh.maturity_return_amount, cmrh.return_date"
                                    . " FROM customer AS cu, customer_plan_mapping AS cpm, customer_maturity_return_history AS cmrh "
                                    . " WHERE cpm.customer_id = cu.customer_id  AND cu.customer_id=cmrh.customer_id AND cu.status=1 AND cpm.status=1 AND cu.claimed_maturity_payment_status=1 group by cu.customer_id ORDER BY cu.id DESC";
                            $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td><?php echo strtoupper($row['name']); ?></td>
                                        <td><?php echo strtoupper($row['plan_name']); ?></td>
                                        <td><?php echo $row['plan_type']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['date_of_joining'])); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['expairy_date'])); ?></span></td>
                                        <td><?php echo $row['no_of_installment'];?></td>
                                        <td><?php echo $row['no_of_pay_installment'];?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row['installment_amount'];?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row['installment_amount']*$row['no_of_pay_installment'];?></td>
                                        <!--<td>
                                            <?php 
                                             if($row['no_of_installment']==$row['no_of_pay_installment']){
                                                   echo '<span class="label label-success">Installment Amount Paid <i class="fa fa-check"></i></span>'; 
                                             }else{
                                                $pendingInstallment=$row['no_of_installment']-$row['no_of_pay_installment'];
                                                   echo '<span class="label label-danger"> '.$pendingInstallment.' Installment Pending </span>';               
                                                   
                                             }
                                            ?>
                                        </td>-->
                                         <td><i class="fa fa-rupee"></i> <?php echo number_format($row['maturity_return'], 2, '.', '') ;?></td>
                                         <td style="background-color: #1abc9c; color: #ffffff;"><b><i class="fa fa-rupee"></i> <?php echo number_format($row['maturity_return_amount'], 2, '.', '') ;?></b></td>
                                         <td style="background-color: #f80; color: #ffffff;"><?php echo date("d-m-Y", strtotime($row['return_date'])); ?></td>
                                        <?php
                                        if($row['plan_type']=='RD'){
                                        ?>
                                         <td title="Regular"><span class="label label-primary"><?php echo "Regular"; ?></span></td>
                                        <?php
                                         }else if($row['plan_type']=='FD' OR $row['plan_type']=='MIS') {
                                            ?>
                                         <td title="Single"><span class="label label-primary"><?php echo "Single"; ?></span></td>
                                        <?php
                                         }
                                        ?>
                                        <td style="width: 40px;">
                                           <?php
                                            if ($row['claimed_maturity_payment_status']=='1') {
                                              ?>
                                             <a href="#" class="btn btn-success btn-xs deldp pull-right" data-toggle="tooltip" title="Paid">Paid</a>   
                                             <?php
                                             }
                                            ?>
                                            <a href="viewCustomerDetail.php?token=<?php echo $_REQUEST['token']; ?>&cuId=<?php echo $row['customer_id']; ?>&page=maturityPaidList"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button></a>
                                            <!--<a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['customer_id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>-->
                                        </td>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                <?php
                }else{
                ?>    
                <table id="example1" class="table table-bordered table-striped" style="width: 135%;">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Customer Name</th>
                        <th>Plan Name</th>
                        <th>Plan Type</th>
                        <th>Joining Date</th>
                        <th>Expiry Date.</th>
                        <th>No Of Installment.</th>
                        <th>No. Of Pay Installment.</th>
                        <th>Installment Amount.</th>
                        <th>Paid Installment Amount.</th>
                        <!--<th>Installment</th>-->
                        <th>Maturity Return</th>
                        <th>Maturity Paid Amount</th>
                        <th>Maturity Paid Date</th>
                        <th>Pay Mode</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "SELECT cu.id, cu.customer_id, cu.registration_no, cu.sr_no, cu.agency_code,"
                                    . " cu.branch_id, cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, cu.claimed_maturity_payment_status, "
                                    . "cu.country, cu.post, cu.district, cu.pin_code, cu.address, cpm.id, cpm.customer_id, "
                                    . "cpm.agency_code, cpm.no_of_installment, cpm.no_of_pay_installment, cpm.plan_name, cpm.plan_duration,"
                                    . " cpm.commision_in_per, cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, "
                                    . "cpm.installment_amount, cpm.maturity_return, cmrh.maturity_return_amount, cmrh.return_date"
                                    . " FROM customer AS cu, customer_plan_mapping AS cpm, customer_maturity_return_history AS cmrh "
                                    . " WHERE cpm.customer_id = cu.customer_id AND cu.customer_id=cmrh.customer_id AND cu.status=1 "
                                    . "AND cu.claimed_maturity_payment_status=1 AND cpm.status=1 AND cu.branch_id='{$_SESSION['branch_id']}'"
                                    . " AND cpm.branch_id='{$_SESSION['branch_id']}' group by cu.customer_id ORDER BY cu.id DESC";
                                    $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['plan_name']; ?></td>
                                        <td><?php echo $row['plan_type']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['date_of_joining'])); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['expairy_date'])); ?></td>
                                        <td><?php echo $row['no_of_installment'];?></td>
                                        <td><?php echo $row['no_of_pay_installment'];?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row['installment_amount'];?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row['installment_amount']*$row['no_of_pay_installment'];?></td>
                                        <!--<td>
                                            <?php 
                                             if($row['no_of_installment']==$row['no_of_pay_installment']){
                                                   echo '<span class="label label-success">Installment Amount Paid <i class="fa fa-check"></i></span>'; 
                                             }else{
                                                $pendingInstallment=$row['no_of_installment']-$row['no_of_pay_installment'];
                                                   echo '<span class="label label-danger"> '.$pendingInstallment.' Installment Pending </span>';               
                                                   
                                             }
                                            ?>
                                        </td>-->
                                         <td><i class="fa fa-rupee"></i> <?php echo number_format($row['maturity_return'], 2, '.', '') ;?></td>
                                         <td style="background-color: #1abc9c; color: #ffffff;"><b><i class="fa fa-rupee"></i> <?php echo number_format($row['maturity_return_amount'], 2, '.', '') ;?></b></td>
                                         <td style="background-color: #f80; color: #ffffff;"><?php echo date("d-m-Y", strtotime($row['return_date'])); ?></td>
                                        <?php
                                        if($row['plan_type']=='RD'){
                                        ?>
                                        <td><span class="label label-primary"><?php echo "Regular"; ?></span></td>
                                        <?php
                                         }else if($row['plan_type']=='FD' OR $row['plan_type']=='MIS') {
                                            ?>
                                        <td><span class="label label-primary"><?php echo "Single"; ?></span></td>
                                        <?php
                                         }
                                        ?>
                                        <td style="width: 40px;">
                                           <?php
                                             if ($row['claimed_maturity_payment_status']=='1') {
                                              ?>
                                             <a href="#" class="btn btn-success btn-xs deldp pull-right" data-toggle="tooltip" title="Paid">Paid</a>   
                                             <?php
                                             }
                                            ?>
                                            <a href="viewCustomerDetail.php?token=<?php echo $_REQUEST['token']; ?>&cuId=<?php echo $row['customer_id']; ?>&page=maturityPaidList"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button></a>
                                            <!--<a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['customer_id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>-->
                                        </td>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                <?php
                }
                ?>
                </div>
              </div>
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->

        <?php require_once '../../includes/bottom.php'; ?>
        <?php require_once '../../includes/footer_includes.php'; ?>
    </body>
</html>
    <?php
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
?>



