<?php
    session_start();
    if($_SESSION['token']===$_REQUEST['token'] && $_SESSION['uid']===$_SESSION['euid']){
        include_once '../../includes/timeout.php';
        ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['title'].": Customer Profile"; ?></title>
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
            <li class="active">Customer List</li>
            <li class="active">Customer Profile</li>
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
             <?php
             $query = "SELECT cu.registration_no, cu.sr_no, cu.agency_code,"
                                . " cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, cu.gender, cu.mobil_no, cu.aadhar_card_no, cu.pan_card_no, cu.bank_name, cu.account_no, cu.ifsc_code, cu.nominee_date_of_birth,"
                                . "cu.country, cu.post, cu.district, cu.pin_code, cu.address, cu.nominee, cu.realation, cu.customer_img,"
                                . "cpm.no_of_installment, cpm.no_of_pay_installment, cpm.plan_name, cpm.plan_duration,"
                                . " cpm.commision_in_per, cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, cpm.total_installment_amount, "
                                . "cpm.installment_amount, cpm.maturity_return, ach.agency_code, cih.pay_amount"
                                . " FROM customer AS cu, customer_plan_mapping AS cpm, agent_commission_history AS ach, customer_installment_history AS cih"
                     . " WHERE cpm.customer_id = ach.customer_id AND cpm.customer_id = cu.customer_id AND cpm.customer_id = cih.customer_id AND cu.customer_id='{$_REQUEST['cuId']}' AND cpm.customer_id='{$_REQUEST['cuId']}' AND cih.customer_id='{$_REQUEST['cuId']}' AND ach.customer_id='{$_REQUEST['cuId']}'";
                     $result = $con->query($query);
                while ($customerRow = mysqli_fetch_array($result)) {
                    $name=$customerRow['name'];
                    $father=$customerRow['father'];
                    $dob=$customerRow['dob'];
                    $date_of_joining=$customerRow['date_of_joining'];
                    $expairy_date=$customerRow['expairy_date'];
                    $country=$customerRow['country'];
                    $gender=$customerRow['gender'];
                    $plan_type=$customerRow['plan_type'];
                    $post=$customerRow['post'];
                    $district=$customerRow['district'];
                    $pin_code=$customerRow['pin_code'];
                    $address=$customerRow['address'];
                    $mobil_no=$customerRow['mobil_no'];
                    $plan_name=$customerRow['plan_name'];
                    $plan_duration=$customerRow['plan_duration'];
                    $pay_mode=$customerRow['pay_mode'];
                    $no_of_installment=$customerRow['no_of_installment'];
                    $no_of_pay_installment=$customerRow['no_of_pay_installment'];
                    $adrCardNo=$customerRow['aadhar_card_no'];
                    $panCardNo=$customerRow['pan_card_no'];
                    $bankName=$customerRow['bank_name'];
                    $accountNo=$customerRow['account_no'];
                    $ifscCode=$customerRow['ifsc_code'];
                    $nomineeDOB=$customerRow['nominee_date_of_birth'];
                    $nomineeName=$customerRow['nominee'];
                    $nomineeRelation=$customerRow['realation'];
                    $customerPhoto=$customerRow['customer_img'];
                    $planAmount=$customerRow['total_installment_amount'];
                    $installmentAmount=$customerRow['installment_amount'];
                    $totalPayAmount=$customerRow['pay_amount'];
                    $interest_rate_in_per=$customerRow['interest_rate_in_per'];
                    $maturityReturn=$customerRow['maturity_return'];
                }
             ?>
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-user-plus"></i> Customer Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 ">
                                <span class="profile-picture">
                                    <?php
                                    if(!empty($customerPhoto)){
                                    ?>
                                    <img src="<?php echo $customerPhoto; ?>" style="height: 120px; width: 100px;" class="editable img-responsive"/>
                                    <?php
                                    }else{
                                    }
                                    ?>
                                    <!--<img class="editable img-responsive" alt=" Avatar" id="avatar2" src="http://bootdey.com/img/Content/avatar/avatar6.png">-->
                                </span>

                            </div><!-- /.col -->
                            <div class="col-xs-12 col-sm-10">
                                <?php
                                 if(!empty($_REQUEST['page'])){
                                    ?>
                                      <div class="alert alert-alert alert-dismissable" style="background-color: #007f3d;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b style="color: white;"><i class="icon fa fa-check"></i> The maturity amount has been paid to this customer. </b>
                                      </div>                                        
                                    <?php
                                 }else{
                                        if($no_of_installment===$no_of_pay_installment){
                                         ?>   
                                            <div class="alert alert-alert alert-dismissable" style="background-color: #007f3d;">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b style="color: white;"><i class="icon fa fa-warning"></i>Total installment has been submitted to you (<?php echo $name;?>)!</b>
                                            </div>
                                         <?php   
                                        }else{
                                            $availableInstallment=$no_of_installment-$no_of_pay_installment;   
                                           ?>
                                           <div class="alert alert-alert alert-dismissable" style="background-color: #8f1e1e;">
                                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                               <b style="color: white;"><i class="icon fa fa-warning"></i>Your Pending Installment ( <?php echo $availableInstallment. ' '.$pay_mode;?> )</b>
                                           </div>
                                <?php
                                        }
                                 }
                                 ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo strtoupper($name);?></td>
                                        <th>Father Name</th>
                                        <td><?php echo strtoupper($father); ?></td>
                                    </tr>
                                    <tr>
                                        <th>DOB</th>
                                        <td><?php echo $dob; ?></td>
                                        <th>Mobile No</th>
                                        <td><?php echo $mobil_no;?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $address.' '.$district.', '.$country.'-'.$pin_code;?></td>
                                        <th>Gender</th>
                                        <td><?php echo $gender;?></td>
                                    </tr>
                                    <tr>
                                        <th>Aadhar Card No.</th>
                                        <td><?php echo $adrCardNo; ?></td>
                                        <th>Pan Card No.</th>
                                        <td><?php echo $panCardNo;?></td>
                                    </tr>
                                    <tr>
                                        <th>Bank Name</th>
                                        <td><?php echo strtoupper($bankName); ?></td>
                                        <th>Nominee Name.</th>
                                        <td><?php echo strtoupper($nomineeName);?></td>
                                    </tr>
                                    <tr>
                                        <th>Nominee Relation</th>
                                        <td><?php echo $nomineeRelation; ?></td>
                                        <th>Nominee DOB</th>
                                        <td><?php echo $nomineeDOB;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: center; background-color: #f80; color: #FFF;"><b>Plan Summary</b></td>
                                    </tr>
                                    <tr>
                                        <th>Date Of Joining</th>
                                        <td><?php echo "".date("l M,dS Y",strtotime($date_of_joining));?></td>
                                        <th>Expiry Date</th>
                                        <td><?php echo "".date("l M,dS Y",strtotime($expairy_date));?></td>
                                    </tr>
                                    <tr>
                                        <th>Plan Name</th>
                                        <td><?php echo strtoupper($plan_name); ?></td>
                                        <th>Plan Duration</th>
                                        <td><?php echo $plan_duration;?> Month</td>
                                    </tr>
                                    <tr>
                                        <th>Plan Type</th>
                                        <td><?php echo $plan_type; ?></td>
                                        <th>Mode Of Payment</th>
                                        <?php
                                        if($plan_type=='RD'){
                                        ?>
                                        <td class="bg-fuchsia"><?php echo "Regular";?></td>
                                        <?php
                                        }else if($plan_type=='MIS' OR $plan_type=='FD'){
                                          ?>
                                        <td class="bg-fuchsia"><?php echo "Single";?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th>Total Installment Amt.</th>
                                        <td><i class="fa fa-rupee"></i> <?php echo $planAmount; ?></td>
                                        <th>Installment Amount</th>
                                        <td><i class="fa fa-rupee"></i> <?php echo $installmentAmount;?></td>
                                    </tr>
                                    <tr>
                                        <th>No Of Installment</th>
                                        <td><?php echo $no_of_installment; ?></td>
                                        <th>No Of Pay Installment</th>
                                        <td><?php echo $no_of_pay_installment;?></td>
                                    </tr>
                                    <tr>
                                        <th>Maturity Return</th>
                                        <td colspan="3"><i class="fa fa-rupee"></i> <?php echo number_format($maturityReturn, 2); ?></td>
                                        
                                    </tr>
                                     <?php
                                    if(!empty($_REQUEST['page'])){
                                          $selectMaturityAmt="SELECT maturity_return_amount, return_date FROM customer_maturity_return_history WHERE customer_id='{$_REQUEST['cuId']}'";    
                                           $maturityResult = $con->query($selectMaturityAmt);
                                           while ($maturityRow = mysqli_fetch_array($maturityResult)) {
                                                 $maturityPaidAmount=$maturityRow['maturity_return_amount'];
                                                 $paidDate=$maturityRow['return_date']; 
                                           }
                                        ?>
                                           <tr>
                                                <th>Maturity Paid Amount</th>
                                                <td class="bg-fuchsia"><i class="fa fa-rupee"></i> <?php echo number_format($maturityPaidAmount, 2); ?></td>
                                                <th>Paid Date</th>
                                                <td class="bg-fuchsia"><?php echo date("d-m-Y", strtotime($paidDate)); ?></td>
                                            </tr>    
                                        <?php
                                    }
                                    ?>
                                </table>
                                <div style="background-color: #f80; border-radius: 0px; text-align: center;">
                                    <span style="padding: 10px; color: #FFF;"><b>Customer Installment Summary</b></span>
                                </div>
                                <table class="table">
                                  <tr>
                                        <th>Sr. no.</th>
                                        <th>Receipt. no.</th>
                                        <th>Pay Amount</th>
                                        <th>Deposit Installment</th>
                                        <th>Deposit Date</th>
                                       
                                  </tr>   
                                <?php
                                $totalPayAmount=0;
                                $n=1;
                                 $selectCuIHis="SELECT reciept_no, pay_amount, no_of_installment, pay_date, status FROM customer_installment_history WHERE status=1 AND customer_id='{$_REQUEST['cuId']}'";
                                 $resultCuIHis=$con->query($selectCuIHis); 
                                 while ($cuIHisRow = mysqli_fetch_array($resultCuIHis)) {
                                 $totalPayAmount+=$cuIHisRow['pay_amount'];  
                                 ?>  
                                    <tr>
                                        <td><?php echo $n;?></td>
                                        <td><?php echo $cuIHisRow['reciept_no'];?></td>
                                        <td><?php echo $cuIHisRow['pay_amount'];?></td>
                                        <td><?php echo $cuIHisRow['no_of_installment'];?></td>
                                        <td>
                                            <?php echo "".date("l M,dS Y",strtotime($cuIHisRow['pay_date']));?>
                                            &nbsp;&nbsp;&nbsp;<a target="_blank" href="../../view/installment/printSingleInstallment.php?token=<?php echo $_REQUEST['token'];?>&receiptNo=<?php echo $cuIHisRow['reciept_no'];?>&cuId=<?php echo $_REQUEST['cuId'];?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Detail</a>
                                        </td>
                                        
                                    </tr>
                                     <?php
                                     $n++;
                                 }
                                 $maturity=$totalPayAmount*$interest_rate_in_per/100;
                                 $matirityReturn=$maturity+$totalPayAmount;
                                 ?>
                                 <tr>
                                     <td></td>
                                     <td><b>Total</b> </td>
                                     <td colspan="5"><i class="fa fa-rupee"></i> <?php echo number_format($totalPayAmount, 2, '.', '') ;?></td>
                                     <td colspan=""><a target="_blank" href="../../view/installment/printTotalInstallment.php?token=<?php echo $_REQUEST['token'];?>&cuId=<?php echo $_REQUEST['cuId'];?>" class="btn btn-foursquare btn-xs"><i class="fa fa-print"></i> Print Receipt</a></td>
                                 </tr>
                                 <!--<tr>
                                     <td></td>
                                     <td><b>Maturity Return</b> </td>
                                     <td colspan="4"><i class="fa fa-rupee"></i> <?php echo number_format($matirityReturn, 2, '.', '') ;?></td>
                                 </tr>-->
                                </table>
                                <div class="hr hr-8 dotted"></div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                               
                    </div><!-- /.col -->
                </div>
            </div>
            <!-- Content Here -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <style>
          

.profile-user-info {
    display: table;
    width: 98%;
    width: calc(100% - 24px);
    margin: 0 auto
}

.profile-info-row {
    display: table-row
}

.profile-info-name,
.profile-info-value {
    display: table-cell;
    border-top: 1px dotted #D5E4F1
}

.profile-info-name {
    text-align: right;
    padding: 6px 10px 6px 4px;
    font-weight: 400;
    color: #667E99;
    background-color: transparent;
    width: 110px;
    vertical-align: middle
}

.profile-info-value {
    padding: 6px 4px 6px 6px
}

.profile-info-value>span+span:before {
    display: inline;
    content: ",";
    margin-left: 1px;
    margin-right: 3px;
    color: #666;
    border-bottom: 1px solid #FFF
}


.profile-info-row:first-child .profile-info-name,
.profile-info-row:first-child .profile-info-value {
    border-top: none
}

.profile-user-info-striped {
    border: 1px solid #DCEBF7
}

.profile-user-info-striped .profile-info-name {
    color: #336199;
    background-color: #EDF3F4;
    border-top: 1px solid #F7FBFF
}

.profile-user-info-striped .profile-info-value {
    border-top: 1px dotted #DCEBF7;
    padding-left: 12px
}

.profile-picture {
    border: 1px solid #CCC;
    background-color: #FFF;
    padding: 4px;
    display: inline-block;
    max-width: 100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, .15)
}

      </style>
      <?php require_once '../../includes/bottom.php'; ?>
    </div>
    <?php require_once '../../includes/footer_includes.php'; ?>

    <?php 
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
    ?>
  </body>
</html>
