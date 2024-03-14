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
    <title><?php echo $_SESSION['title'].": Deposit Installment"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini da">
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
            <li class="">Deposit Installment With Transaction Id</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i>Deposit Installment With Transaction Id</h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
            <div class="loader_gif" id="loader-gif" style="display:none;"></div>
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
                <h4><p id="msg" style="font-weight: bold; margin-left: 20px;"></p></h4>  
                <div class="box-body" style="margin-top: -10px;">
            <?php
            $customerID=$_REQUEST['cuId'];
            $planId=$_REQUEST['planId'];
            $token=$_REQUEST['token'];
            $selectCustomer="SELECT cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, cu.country, cu.gender, cu.post, cu.district, "
                    . "cu.pin_code, cu.address, cu.mobil_no, cu.gender, cu.nominee, cu.realation, cu.customer_img, "
                    . "cpm.agency_code, cpm.plan_name, cpm.plan_duration, cpm.plan_type, cpm.pay_mode, cpm.total_installment_amount, cpm.maturity_return, cpm.plan_type, cpm.installment_amount, "
                    . "cpm.no_of_installment, cpm.no_of_pay_installment, cih.customer_id, cih.reciept_no, cih.pay_amount, "
                    . "cih.pay_date, cih.no_of_installment AS cihNoOfInstallment FROM customer AS cu, customer_plan_mapping AS cpm, customer_installment_history AS cih "
                    . "WHERE cu.customer_id=cpm.customer_id AND cpm.customer_id = cih.customer_id AND cu.customer_id='{$customerID}' AND cpm.customer_id='{$customerID}' AND cih.customer_id='{$customerID}' AND cpm.plan_id='{$planId}'";
                $log->info("Select customer from ajaxSearchDepositInstallment.php : $selectCustomer");
                $customerResult=$con->query($selectCustomer);
                $countCu=mysqli_num_rows($customerResult);
                if($countCu>0){
                                while ($customerRow = mysqli_fetch_array($customerResult)) {
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
                                   $maturity_return=$customerRow['maturity_return'];
                                   $pay_amount[]=$customerRow['pay_amount'];
                                   $pay_date[]=$customerRow['pay_date'];
                                   $customer_id[]=$customerRow['customer_id'];
                                   $reciept_no[]=$customerRow['reciept_no'];
                                   $cihNoOfInstallment[]=$customerRow['cihNoOfInstallment'];

                                   $planAmount=$customerRow['total_installment_amount'];
                                   $installment_amount=$customerRow['installment_amount'];


                                }  
                                $availableInstallment=$no_of_installment-$no_of_pay_installment;
                            ?>

                                 <a href="#" class="btn btn-primary btn-block" style="padding-top: 1px; padding-bottom: 1px;"><b>Customer Detail</b></a>
                                    <table class="table">
                                        <thead>
                                              <tr>
                                                <td style="width: 130px;"><b>Customer Name</b></td>
                                                <td><?php echo strtoupper($name);?></td>
                                                <td><b>Father Name</b></td>
                                                <td><?php echo strtoupper($father);?></td>
                                                <td><b>DOB</b></td>
                                                <td><?php echo $dob;?></td>
                                                <td><b>Mobile Number</b></td>
                                                <td><?php echo $mobil_no;?></td>


                                              </tr>
                                              <tr>
                                                <td><b>Plan Name</b></td>
                                                <td><?php echo strtoupper($plan_name);?></td>
                                                <td><b>Plan Type</b></td>
                                                <td><?php echo $plan_type?></td>
                                                <td><b>Joining Date</b></td>
                                                <td><?php echo date("d-m-Y", strtotime($date_of_joining));?></td>  
                                                <td><b>Expiry Date.</b></td>
                                                <td><?php echo date("d-m-Y", strtotime($expairy_date));?></td>
                                              </tr>
                                              <tr>
                                                <td><b>Paid Installment Amount</b></td>
                                                <td><i class="fa fa-rupee"></i> <?php echo $no_of_pay_installment*$installment_amount;?></td>
                                                <td><b>Installment Amount</b></td>
                                                <td><i class="fa fa-rupee"></i> <?php echo $installment_amount;?></td>  
                                                <td><b>Total Installment Amount</b></td>
                                                <td><i class="fa fa-rupee"></i> <?php echo $planAmount;?></td>
                                                <td style="background-color: #f80; color: #ffffff;"><b>Maturity Return Amount</b></td>
                                                <td style="background-color: #f80; color: #ffffff;"><i class="fa fa-rupee"></i> <?php echo number_format($maturity_return, 2);?></td>
                                              </tr>
                                              <tr>
                                                  <td><b>Plan Duration</b></td>
                                                  <td><?php echo $plan_duration?> Month</td>
                                                  <td><b>No Of Installment</b></td>
                                                  <td><?php echo $no_of_installment; ?></td>
                                                  <td><b>No Of Paid Installment</b></td>
                                                  <td><?php echo $no_of_pay_installment;?></td>
                                                  <?php
                                                  if($no_of_installment!==$no_of_pay_installment){
                                                   ?> 
                                                     <td><b>Pending Installment</b></td>
                                                     <td><b><?php echo $no_of_installment-$no_of_pay_installment;?></b></td>
                                                  <?php    
                                                  }
                                                  ?>
                                              </tr>

                                            </thead>
                                    </table>
                                <a href="#" class="btn btn-primary btn-block" style="padding-top: 1px; padding-bottom: 1px; margin-top: 3px; margin-bottom: 3px;"><b>Installment Detail</b></a>
                                <?php
                                if($no_of_installment===$no_of_pay_installment){
                                 ?>
                                <div class="alert alert-alert alert-dismissable" style="background-color: #00733e;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b style="color: white;"><i class="icon fa fa-warning"></i>Total installment has been submitted to you (<?php echo $name;?>)!</b>
                                </div>
                                <?php
                                }else{
                                ?>
                                <form action="#" method="post">
                                <div class="form-group col-lg-2">
                                    <label for="name">Installment Amount <font style="color: #ff1e1e;">*</font></label>
                                    <input type="text" class="form-control input-sm" readonly="" value="<?php echo $installment_amount; ?>" name="instaAmount" id="instaAmount" placeholder="Enter Customer Name" required="">
                                </div>
                                <div class="form-group col-lg-2">
                                  <label for="fatherName">No. Of Installment <font style="color: #ff1e1e;">*</font></label>
                                  <input type="text" class="form-control input-sm" name="noOfInsta"  id="noOfInsta" placeholder="Enter No. Of Installment" onkeyup="manageAmount()" required="">
                                </div>
                                <div class="form-group col-lg-2">
                                  <label for="fatherName">Deposit Amount <font style="color: #ff1e1e;">*</font></label>
                                  <input type="text" class="form-control input-sm" readonly="" name="depositeAmount" id="depositeAmount"  placeholder="" required="">
                                </div>
                                 <div class="form-group col-lg-2">
                                    <label for="transactionId">Transaction Id <font style="color: #ff1e1e;">*</font></label>
                                    <input type="text" class="form-control input-sm" maxlength="12" name="transactionId" id="transactionId" placeholder="Transaction Id" required>
                                  </div>   
                                <!--<div class="form-group col-lg-2">
                                  <label for="fatherName">Available Amount <font style="color: #ff1e1e;">*</font></label>
                                  <input type="text" class="form-control input-sm" readonly="" id="pAvailableAMT" name="pAvailableAMT" placeholder="">
                                </div> -->   
                                <div class="form-group col-lg-2">
                                    <input type="button" class="form-control btn-success payInstallment" disabled="" id="payInstallment" value="Pay Now" style="margin-top: 20px;" onclick="depositInstallment()">
                                </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="customerMobileNo" id="customerMobileNo"  value="<?php echo $mobil_no;?>">
                                <input type="hidden" name="no_of_pay_installment" id="no_of_pay_installment"  value="<?php echo $no_of_pay_installment;?>">
                                <input type="hidden" name="no_of_installment" id="no_of_installment"  value="<?php echo $no_of_installment;?>">
                                <input type="hidden" name="cuId" id="cuId"  value="<?php echo $_REQUEST['cuId'];?>">
                                <input type="hidden" name="availableInstallment" id="availableInstallment"  value="<?php echo $availableInstallment;?>">
                                </form>
                                <table class="table">
                                    <thead>
                                        <tr style="background-color: #f80">
                                            <th>Receipt No</th>
                                            <th>Amount</th>
                                            <th>Pay Date</th>
                                            <th>No Of Installment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $paidAmount=0; 
                                        $selectCustomerIns="SELECT reciept_no, pay_amount, no_of_installment, pay_date FROM customer_installment_history WHERE status=1 AND customer_id='{$customerID}'";
                                        $log->info("$selectCustomerIns"); 
                                        $resultCuIns=$con->query($selectCustomerIns);
                                        while ($cuInsRow = mysqli_fetch_array($resultCuIns)) {
                                         $paidAmount+=$cuInsRow['pay_amount'];    
                                        ?>
                                        <tr>
                                            <td><?php echo $cuInsRow['reciept_no'];?></td>
                                            <td><?php echo $cuInsRow['pay_amount'];?></td>
                                            <td><?php echo $cuInsRow['pay_date'];?></td>
                                            <td><?php echo $cuInsRow['no_of_installment'];?></td>
                                            <td><a target="_blank" href="printSingleInstallment.php?token=<?php echo $token;?>&receiptNo=<?php echo $cuInsRow['reciept_no'];?>&cuId=<?php echo $customerID;?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Detail</a></td>
                                        </tr>
                                        <?php
                                        }
                                        /*echo $availableAmount= $planAmount-$paidAmount;*/
                                        ?>
                                        <tr>
                                           <!-- <input type="hidden" value="<?php echo $availableAmount; ?>" id="availableAmt">-->
                                            <td><b>Total</b> </td>
                                            <td colspan="3"><i class="fa fa-rupee"></i> <?php echo number_format($paidAmount, 2, '.', '') ;?></td>
                                            <td colspan=""><a target="_blank" href="printTotalInstallment.php?token=<?php echo $token;?>&cuId=<?php echo $customerID;?>" class="btn btn-foursquare btn-xs"><i class="fa fa-print"></i> Print Receipt</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php
                            }else{
                                echo '<div class="alert alert-alert alert-dismissable" style="background-color: #b01a1a;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b style="color: white;"><i class="icon fa fa-warning"></i>Data not match !</b>
                                    </div>';
                            }
                   
            ?>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <script>
     /*=============================Ajax Manage amount code start=================================================*/    
    function manageAmount(){
        var instaDepositAmount = document.getElementById('instaAmount').value;
        var noOfInsta = document.getElementById('noOfInsta').value;
        var no_of_pay_installment = document.getElementById('no_of_pay_installment').value;
        var no_of_installment = document.getElementById('no_of_installment').value;
        var availableInstallment = document.getElementById('availableInstallment').value;
        //alert(availableInstallment);
        //alert(noOfInsta);
        if(parseInt(availableInstallment)>=parseInt(noOfInsta) && parseInt(noOfInsta)>0){
        var payAmount =instaDepositAmount*noOfInsta;
        $('#depositeAmount').val(payAmount.toFixed(2));
        document.getElementById('payInstallment').disabled = false;
    }else{
        document.getElementById('payInstallment').disabled = true;
        var ale='Your Available No of Installment Value';
        alert(ale +"  "+ availableInstallment);
       }
    }
/*=============================Ajax manage amount code end========================================*/
     /*===================================================Pay Amount Click Submit Button Start=========================================*/
         function depositInstallment(){
              var instaAmount=$("#instaAmount").val();
              var depNoOfIns=$("#noOfInsta").val();
              var deposit_amount=$("#depositeAmount").val();
              var cuId=$("#cuId").val();
              var planId=$("#planId").val();
              var transactionId=$("#transactionId").val();
              var token=$("#token").val();
              var customerMobileNo=$("#customerMobileNo").val();
              if(transactionId===''){
                alert("Please enter transaction Id !");
                $( "#transactionId" ).focus();
              }else{
              $("#loader-gif").show();
              $.ajax({
                 url:"ajaxDepositInstallment.php",
                 type: 'POST',
                 data:{depNoOfIns:depNoOfIns,deposit_amount:deposit_amount,cuId:cuId,planId:planId,token:token,customerMobileNo:customerMobileNo,transactionId:transactionId},
                 dataType: "text",
                    success: function(data) {
                    //alert(data);
                    if(data==1){    
                    userPreference = "Successfully pay Installment amount!";    
                    $("#loader-gif").hide();
                    $(".box-body").load(location.href + " .box-body");
                    //$("#successPay").show();
                    //setTimeout(function() { $("#successPay").hide(); }, 5000);
                    }
                    else{
                       userPreference = "Error Try again!"; 
                       $("#loader-gif").hide();
                        $(".box-body").load(location.href + " .box-body");
                       //$("#unsuccessPay").show();
                       //setTimeout(function() { $("#unsuccessPay").hide(); }, 5000);
                      }
                       document.getElementById("msg").innerHTML = userPreference;
                    },
              });
          }
        }    
        /*===================================================Pay Amount Click Submit Button End============================*/
 </script>
      <?php require_once '../../includes/bottom.php'; ?>
      
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
