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
    <title><?php echo $_SESSION['title'].":MIS (Monthly Income Scheme) Customer List"; ?></title>
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
              <li><a href=../../view/dashboard/dashboard.php?token=<?php echo $_REQUEST['token'];?>"../"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Customer</li>
            <li class="active">MIS (Monthly Income Scheme)Customer List</li>
          </ol>
        </section>
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
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-list"></i>MIS (Monthly Income Scheme)Customer</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php
                if($_SESSION['role']=='ROL001'){
                ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Customer Name</th>
                        <th>Plan Name</th>
                        <th>Joining Date</th>
                        <th>Expiry Date.</th>
                        <th>Plan Type</th>
                        <th>Total Installment</th>
                        <th>Paid Installment</th>
                        <th>Deposit Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "SELECT cu.id, cu.customer_id, cu.registration_no, cu.sr_no, cu.agency_code,"
                                    . " cu.branch_id, cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, "
                                    . "cu.country, cu.post, cu.district, cu.pin_code, cu.address, cpm.id, cpm.customer_id, "
                                    . "cpm.agency_code, cpm.no_of_installment, cpm.no_of_pay_installment, cpm.plan_name, cpm.plan_duration,"
                                    . " cpm.commision_in_per, cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, "
                                    . "cpm.installment_amount, cpm.maturity_return, ach.id, ach.agency_code, ach.customer_id "
                                    . "FROM customer AS cu, customer_plan_mapping AS cpm, agent_commission_history AS ach WHERE cpm.customer_id = ach.customer_id AND cpm.customer_id = cu.customer_id AND cu.status=1 AND ach.status=1 AND cpm.status=1 AND cpm.plan_type='MIS' group by cu.customer_id DESC";
                            $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td title="<?php echo $row['name']; ?>"><?php echo strtoupper($row['name']); ?></td>
                                        <td><?php echo strtoupper ($row['plan_name']); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['date_of_joining'])); ?></td>
                                        <td><span class="label label-danger">
                                            <?php 
                                             echo date("d-m-Y", strtotime($row['expairy_date'])); 
                                              if(strtotime($row['expairy_date']) < strtotime(date("Y-m-d")) ) {
                                               echo " Expire";  
                                              }
                                            ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row['plan_type']; ?></td>
                                        <td><?php echo $row['no_of_installment']; ?></td>
                                        <td>
                                            <?php 
                                             echo $row['no_of_pay_installment']; 
                                              if($row['no_of_installment']===$row['no_of_pay_installment']){
                                                  echo '<i class="fa fa-check"></i>';
                                              }
                                            ?>
                                        </td>
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
                                        <td>
                                            <a href="editCustomer.php?token=<?php echo $_REQUEST['token']; ?>&id=<?php echo $row['customer_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                            <a href="viewCustomerDetail.php?token=<?php echo $_REQUEST['token']; ?>&cuId=<?php echo $row['customer_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button></a>
                                            <a href="printBond.php?token=<?php echo $_REQUEST['token']; ?>&cuId=<?php echo $row['customer_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Print Bond"><i class="fa fa-print"></i></button></a>
                                            <!--<a href="../mis/payMisWithTransactionId.php?cuId=<?php echo $row['customer_id'];?>&cuName=<?php echo $row['name'];?>&token=<?php echo $_REQUEST['token']; ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="Pay MIS"><i class="fa fa-rupee"></i> Pay MIS</a>-->
                                            <!--<a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['customer_id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>-->
                                        </td>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                <a href="exportMisCustomerList.php?token=<?php echo $_REQUEST['token'];?>" class="btn btn-info btn-xs"> <i class="fa fa-file-archive-o"></i> Export to excel</a>
                <?php
                }else{
                ?>    
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Customer Name</th>
                        <th>Customer Id</th>
                        <th>Plan Name</th>
                        <th>Joining Date</th>
                        <th>Expiry Date.</th>
                        <th>Plan Type</th>
                        <th>Total Installment</th>
                        <th>Paid Installment</th>
                        <th>Deposit Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "SELECT cu.id, cu.customer_id, cu.registration_no, cu.sr_no, cu.agency_code,"
                                    . " cu.branch_id, cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, "
                                    . "cu.country, cu.post, cu.district, cu.pin_code, cu.address, cpm.id, cpm.customer_id, "
                                    . "cpm.agency_code, cpm.no_of_installment, cpm.no_of_pay_installment, cpm.plan_name, cpm.plan_duration, cpm.plan_type='MIS',"
                                    . " cpm.commision_in_per, cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, "
                                    . "cpm.installment_amount, cpm.maturity_return, ach.id, ach.agency_code, ach.customer_id "
                                    . "FROM customer AS cu, customer_plan_mapping AS cpm, agent_commission_history AS ach WHERE cpm.customer_id = ach.customer_id AND cpm.customer_id = cu.customer_id AND cu.status=1 AND ach.status=1 AND cpm.status=1 AND cu.branch_id='{$_SESSION['branch_id']}' AND cpm.branch_id='{$_SESSION['branch_id']}' group by cu.customer_id DESC";
                            $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td><?php echo strtoupper($row['name']); ?></td>
                                        <td><?php echo $row['customer_id']; ?></td>
                                        <td><?php echo strtoupper($row['plan_name']); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['date_of_joining'])); ?></td>
                                        <td><span class="label label-danger">
                                            <?php 
                                             echo date("d-m-Y", strtotime($row['expairy_date'])); 
                                              if(strtotime($row['expairy_date']) < strtotime(date("Y-m-d")) ) {
                                               echo " Expire";  
                                              }
                                            ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row['plan_type']; ?></td>
                                        <td><?php echo $row['no_of_installment']; ?></td>
                                        <td>
                                            <?php 
                                             echo $row['no_of_pay_installment']; 
                                              if($row['no_of_installment']===$row['no_of_pay_installment']){
                                                  echo '<i class="fa fa-check"></i>';
                                              }
                                            ?>
                                        </td>
                                        <?php
                                        if($row['pay_mode']=='daily' OR $row['pay_mode']=='monthly' OR $row['pay_mode']=='quarterly' OR $row['pay_mode']=='halfyearly' OR $row['pay_mode']=='yearly'){
                                        ?>
                                        <td><span class="label label-primary"><?php echo "Regular"; ?></span></td>
                                        <?php
                                         }else {
                                            ?>
                                        <td><span class="label label-primary"><?php echo "Single"; ?></span></td>
                                         <?php
                                         }
                                         ?>
                                        <td>
                                            <a href="editCustomer.php?token=<?php echo $_REQUEST['token']; ?>&id=<?php echo $row['customer_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                            <a href="viewCustomerDetail.php?token=<?php echo $_REQUEST['token']; ?>&cuId=<?php echo $row['customer_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button></a>
                                            <a href="printBond.php?token=<?php echo $_REQUEST['token']; ?>&cuId=<?php echo $row['customer_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Print Bond"><i class="fa fa-print"></i></button></a>
                                            <!--<a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['customer_id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>-->
                                        </td>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                <a href="exportMisCustomerList.php?token=<?php echo $_REQUEST['token'];?>" class="btn btn-info btn-xs"> <i class="fa fa-file-archive-o"></i> Export to excel</a>
                <?php
                }
                ?>
                </div>
              </div>
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->

        <?php require_once '../../includes/bottom.php'; ?>
        <?php require_once '../../includes/footer_includes.php'; ?>
        <script>
            $(document).on('click', '.deldp', function(){
                var tr = $(this).closest('tr'),
                    del_id = $(this).attr('id');
                    idArr = del_id.split('-');
                    if(idArr[1]=='dl'){
                        var c = confirm("Do you want to delete this Customer?");
                        if(c==true){
                            var url = "ajaxDeleteCustomer.php?id=";
                            stts=0;
                        }else{
                             url = "";
                        }
                    }
                $.ajax({
                    url: url+idArr[0]+"&sts="+stts,
                    cache: false,
                    success:function(result){
                        tr.fadeOut(300, function(){
                            $(this).remove();
                        });
                    }
                });
            });
        </script>
    </body>
</html>
    <?php
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
?>



