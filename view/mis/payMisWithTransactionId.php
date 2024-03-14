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
    <title><?php echo $_SESSION['title'].": Pay Mis Amount"; ?></title>
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
            <li class="">Pay Mis With Transaction Id</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Pay Mis With Transaction Id</h3><span style="color: #ff1e1e;"> * Field Required</span>
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
            $selectCustomerDetails="SELECT  cu.name, cu.father, cu.bank_name, cu.account_no, cu.ifsc_code, cu.account_holder_name, cu.dob, cu.date_of_joining, cu.expairy_date, cu.country, "
                    . "cu.post, cu.district, cu.pin_code, cu.address, cu.mobil_no, cu.gender, cu.customer_img, cpm.id, cpm.customer_id, "
                    . "cpm.agency_code, cpm.plan_name, cpm.plan_duration, cpm.interest_rate_in_per, cpm.plan_type,  cpm.total_installment_amount,"
                    . " cpm.installment_amount, cpm.maturity_return, cpm.no_of_installment, cpm.no_of_pay_installment, cmi.no_of_mis, cmi.no_of_pay_mis, cmi.mis_paid_upto_date, p.calculation_rate "
                    . " FROM customer AS cu, customer_plan_mapping AS cpm, customer_mis_info AS cmi, plan AS p"
                    . " WHERE cu.customer_id=cpm.customer_id AND cmi.customer_id=cu.customer_id  AND cu.customer_id='{$_REQUEST['cuId']}' AND cpm.customer_id='{$_REQUEST['cuId']}' AND cmi.customer_id='{$_REQUEST['cuId']}' AND p.plan_id=cpm.plan_id";
                    $result = $con->query($selectCustomerDetails);
                    while ($row = mysqli_fetch_array($result)) {
                        $cuName=$row['name'];
                        $faName=$row['father'];
                        $dob=$row['dob'];
                        $dateOfJoining=$row['date_of_joining'];
                        $Expiry=$row['expairy_date'];
                        $planName=$row['plan_name'];
                        $planDuration=$row['plan_duration'];
                        //$interest_rate_in_per=$row['interest_rate_in_per'];
                        $planType=$row['plan_type'];
                        $maturityReturn=$row['maturity_return'];
                        $cuPhoto=$row['customer_img'];
                        $mobileNo=$row['mobil_no'];
                        $noOfInsta=$row['no_of_installment'];
                        $noOfPayInsa=$row['no_of_pay_installment'];
                        $no_of_mis=$row['no_of_mis'];
                        $no_of_pay_mis=$row['no_of_pay_mis'];
                        $totalInstallmentAmount=$row['total_installment_amount'];
                        $installment_amount=$row['installment_amount'];
                        $mis_paid_upto_date=$row['mis_paid_upto_date'];
                        /*$deductionRate=0;*/
                        $interest_rate_in_per=$row['calculation_rate'];
                        $bank_name=$row['bank_name'];
                        $account_no=$row['account_no'];
                        $ifsc_code=$row['ifsc_code'];
                        $accountHolderName=$row['account_holder_name'];
                    }
                     $availableNoOfMis=$no_of_mis-$no_of_pay_mis;
                     /*echo $totalInstallmentAmount.'-'.$interest_rate_in_per*/
                     $customerPayAmount=$totalInstallmentAmount*$interest_rate_in_per/100;
                     $newOneMonthAgoDate = strtotime("+1 months", strtotime($mis_paid_upto_date)); // returns timestamp
                     $newOneMonthAgoDate1= date('Y-m-d',$newOneMonthAgoDate);

                     /*===================Calculate Deduction Amount=========================*/
                     /*$deductionAmount=$customerPayAmount*$deductionRate/100;
                     $payMisAmountWithDecuction=$customerPayAmount-$deductionAmount;*/
                     /*===================Calculate Deduction Amount=========================*/
            
            ?>
            <table class="table">
                <thead>
                      <tr>
                          <td style="width: 130px;"><b>Customer Name</b></td>
                        <td><?php echo strtoupper($cuName);?></td>
                        <td><b>Father Name</b></td>
                        <td><?php echo strtoupper($faName);?></td>
                        <td><b>DOB</b></td>
                        <td><?php echo $dob;?></td>
                        <td><b>Mobile Number</b></td>
                        <td><?php echo $mobileNo;?></td>
                         
                        
                      </tr>
                      <tr>
                        <td><b>Plan Name</b></td>
                        <td><?php echo strtoupper($planName);?></td>
                        <td><b>Plan Type</b></td>
                        <td><?php echo $planType?></td>
                        <td><b>Joining Date</b></td>
                        <td><?php echo date("d-m-Y", strtotime($dateOfJoining));?></td>  
                        <td><b>Expiry Date.</b></td>
                        <td><?php echo date("d-m-Y", strtotime($Expiry));?></td>
                      </tr>
                      <tr>
                        <td><b>Paid Installment Amount</b></td>
                        <td><i class="fa fa-rupee"></i> <?php echo $noOfPayInsa*$installment_amount;?></td>
                        <td><b>Installment Amount</b></td>
                        <td><i class="fa fa-rupee"></i> <?php echo $installment_amount;?></td>  
                        <td><b>Total Installment Amount</b></td>
                        <td><i class="fa fa-rupee"></i> <?php echo $totalInstallmentAmount;?></td>
                        <td style="background-color: #f80; color: #ffffff;"><b>Maturity Return Amount</b></td>
                        <td style="background-color: #f80; color: #ffffff;"><i class="fa fa-rupee"></i> <?php echo number_format($maturityReturn, 2);?></td>
                      </tr>
                      <tr>
                          <td><b>Plan Duration</b></td>
                          <td><?php echo $planDuration?> Month</td>
                          <td><b>No Of Installment</b></td>
                          <td><?php echo $noOfInsta; ?></td>
                          <td><b>No Of Paid Installment</b></td>
                          <td><?php echo $noOfPayInsa;?></td>
                          <?php
                          if($noOfInsta!==$noOfPayInsa){
                           ?> 
                             <td><b>Pending Installment</b></td>
                             <td><b><?php echo $noOfInsta-$noOfPayInsa;?></b></td>
                          <?php    
                          }
                          ?>
                      </tr>
                      <tr>
                          <td><b>No Of MIS</b></td>
                          <td><?php echo $no_of_mis;?></td>
                          <td><b>No Of Paid MIS</b></td>
                          <td><?php echo $no_of_pay_mis;?></td>
                      </tr>
                      <tr><td colspan="10" class="bg-primary" style="text-align: center; padding: 2px;"> <b style="color: #ffffff; text-align: center;">Account Information</b></td></tr>
                      <tr>
                          <td><b>Bank Name</b></td>
                          <td><?php echo $bank_name;?></td>
                          <td><b>Account No.</b></td>
                          <td><?php echo $account_no;?></td>
                          <td><b>IFSC Code</b></td>
                          <td><?php echo $ifsc_code;?></td>
                          <td><b>Account Holder Name</b></td>
                          <td><?php echo $accountHolderName;?></td>
                      </tr>
                    </thead>
            </table>
                 <input type="hidden" name="TransactionPage" id="TransactionPage" value="TransactionPage">  
                 <input type="hidden" name="availableNoOfMis" id="availableNoOfMis" value="<?php echo $availableNoOfMis;?>">  
                 <input type="hidden" name="customerPayAmount" id="customerPayAmount" value="<?php echo $customerPayAmount;?>">  
                 <input type="hidden" name="customerId" id="customerId" value="<?php echo $_REQUEST['cuId'];?>">  
            <?php
                if($no_of_mis===$no_of_pay_mis){
                    ?>
                        <br><div class="alert alert-alert alert-dismissable" style="background-color: #00733e;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b style="color: white;"><i class="icon fa fa-warning"></i>MIS duration and payment has been completed!</b>
                        </div>
                    <?php
                }else{
                if(($newOneMonthAgoDate) < strtotime(date("Y-m-d")) ) {
                    /*=============Do Not Change This ====================*/
                    $date1 = $mis_paid_upto_date;
                    $date2 = date('Y-m-d');

                    $ts1 = strtotime($date1);
                    $ts2 = strtotime($date2);

                    $year1 = date('Y', $ts1);
                    $year2 = date('Y', $ts2);

                    $month1 = date('m', $ts1);
                    $month2 = date('m', $ts2);

                    $noOfMonth = (($year2 - $year1) * 12) + ($month2 - $month1);
                    /*=============Do Not Change This ====================*/
              ?>
              <br>    
               <div style="height: 20px; text-align: center;" class="bg-primary"><b>Pay MIS With Transaction Id</b></div>
              <div id="ajaxCalculateDeductionRate" class="ajaxCalculateDeductionRate">          
              <form action="#" method="post">
                <div class="form-group col-lg-2">
                    <label for="MisAmount">MIS Amount <font style="color: #ff1e1e;">*</font></label>
                    <input type="text" class="form-control input-sm" readonly="" value="<?php echo $customerPayAmount; ?>" name="MisAmount" id="MisAmount" placeholder="Enter Customer Name" required="">
                </div>
                <div class="form-group col-lg-2">
                  <label for="noOfPayMis">No. Of Pay MIS <font style="color: #ff1e1e;">*</font></label>
                  <select name="noOfPayMis" class="form-control" required="" id="noOfPayMis" onchange="manageMisAmount()">
                       <?php for($i=1;$i<=$noOfMonth;$i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                        <?php } ?>
                  </select>
                </div>

                 <!--============================Deduction rate start======================================-->
                <!--<div class="form-group col-lg-2">
                  <label for="deductionRate">Deduction Rate <font style="color: #ff1e1e;">*</font></label>
                  <input type="text" class="form-control input-sm" name="deductionRate" id="deductionRate" value="<?php echo $deductionRate; ?>" placeholder="" required="" onkeyup="calculateDeductionRate()">
                </div>--> 
                 <!--============================Deduction rate end======================================-->
                <div class="form-group col-lg-2">
                  <label for="payMisAmount">Pay Amount <font style="color: #ff1e1e;">*</font></label>
                  <input type="text" class="form-control input-sm" readonly="" name="payMisAmount" id="payMisAmount" value="<?php echo $customerPayAmount; ?>"  placeholder="" onkeyup="calculateDeductionRate()" required>
                </div>
                 <div class="form-group col-lg-2">
                  <label for="transactionId">Transaction Id <font style="color: #ff1e1e;">*</font></label>
                  <input type="text" class="form-control input-sm" maxlength="12" name="transactionId" id="transactionId" placeholder="Transaction Id" required>
                </div> 
                <div class="form-group col-lg-2">
                    <input type="button" class="form-control btn-success payInstallment" id="payMisAmountButton" value="Pay Now" style="margin-top: 20px;" onclick="payCustomerMisAmount()">
                </div>
             </form>
            </div>
            <br>
             <?php
                 }else{
                      echo '<br><div class="alert alert-alert alert-dismissable" style="background-color: #e8ee39;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <b style="color: black;"><i class="icon fa fa-warning"></i> You can not pay the MIS before the due date !</b>
                            </div>';
                      }
                 }
           ?>
            <?php            
                        $selectCustomerPayMis="SELECT cpmh.pay_amount, cpmh.on_of_pay_mis, cpmh.pay_date, cpmh.transaction_id, cih.reciept_no FROM customer_pay_mis_history  AS cpmh, customer_installment_history AS cih WHERE cpmh.status=1 AND cpmh.customer_id=cih.customer_id AND cpmh.customer_id='{$_REQUEST['cuId']}' AND cih.customer_id='{$_REQUEST['cuId']}' ORDER BY cpmh.id DESC";
                        $log->info("Select Customer pay MIS History (ajaxCommon.php) : $selectCustomerPayMis");
                        $customerMisResult=$con->query($selectCustomerPayMis);
                        $countCuMIS=mysqli_num_rows($customerMisResult);
                        if($countCuMIS>0){
                         ?>
                     <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <td colspan="6" class="bg-primary" style="text-align: center; padding: 0px;"> <b style="color: #ffffff; text-align: center;">Customer Pay MIS (Monthly Income Scheme) Details</b></td>
                                </tr>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Pay Date</th>
                                    <th>No Of Pay MIS</th>
                                    <th>Pay Amount</th>
                                    <th>Transaction ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n=1;
                                $totalPayMis=0;
                                 while ($cuMisRow = mysqli_fetch_array($customerMisResult)) {
                                   $totalPayMis+=$cuMisRow['pay_amount'];  
                                ?>
                                <tr>
                                    <td><?php echo $n;?></td>
                                    <td><?php echo "".date("l M,dS Y",strtotime($cuMisRow['pay_date']));?></span></td>
                                    <td><?php echo $cuMisRow['on_of_pay_mis'];?></td>
                                    <td><i class="fa fa-rupee"></i> <?php echo number_format($cuMisRow['pay_amount'], 2, '.', '') ;?></td>
                                    <?php
                                    if($cuMisRow['transaction_id']==0){
                                    ?>
                                    <td>NULL</td>
                                    <?php
                                    }else{
                                    ?>
                                    <td><?php echo $cuMisRow['transaction_id'];?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><!--<a target="_blank" href="printSingleInstallment.php?token=<?php echo $_REQUEST['token'];?>&receiptNo=<?php echo $cuMisRow['reciept_no'];?>&cuId=<?php echo $customerId;?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Detail</a>--></td>
                                </tr> 
                                <?php
                                 $n++;
                                 }
                                ?>
                                <tr>
                                    <td colspan="3" style="border-top: 1px solid black;"></td>
                                    <td style="border-top: 1px solid black;"> <b>Total</b> <i class="fa fa-rupee"></i> <?php echo number_format($totalPayMis, 2, '.', '') ;?></td>
                                    <td style="border-top: 1px solid black;" colspan=""><a target="_blank" href="../installment/printTotalInstallment.php?token=<?php echo $_REQUEST['token'];?>&cuId=<?php echo $_REQUEST['cuId'];?>" class="btn btn-foursquare btn-xs"><i class="fa fa-print"></i> Print Receipt</a></td>
                                </tr>
                            </tbody>
                    </table>
                    <?php
                   }
                ?>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <script>
  /*===================================================Pay Amount Button able and disable Start=========================================*/
    function manageMisAmount(){
            var MisAmount = document.getElementById('customerPayAmount').value;
            var noOfPayMis = document.getElementById('noOfPayMis').value;
            var availableNoOfMis = document.getElementById('availableNoOfMis').value;
            /*var deductionRate = document.getElementById('deductionRate').value;*/
            if(parseInt(availableNoOfMis)>=parseInt(noOfPayMis)){
            var TotalAmount=MisAmount*noOfPayMis;
            $('#payMisAmount').val(TotalAmount.toFixed(2));
            $("#payMisAmountButton").attr("disabled", false);
        }else{
        var ale='Your Available No of MIS Minimum Value';
        alert(ale +"  "+ availableNoOfMis);
        $("#payMisAmountButton").attr("disabled", true);
   
        }
     }
    
     /*===================================================Pay Amount Button able and disable End=========================================*/
     /*===================================================Pay Amount Click Submit Button Start=========================================*/
         function payCustomerMisAmount(){
            var customerId=$("#customerId").val();
            var token=$("#token").val();
            var totalPayMisAmount = document.getElementById('payMisAmount').value;
            var noOfPayMis = document.getElementById('noOfPayMis').value;
            var transactionId = document.getElementById('transactionId').value;
            var actionId = 'payCustomerMisAmount';
            if(transactionId===''){
                  alert("Please enter Transaction Id.")
                   $( "#transactionId" ).focus();
            }else{   
                $("#loader-gif").show();
                var url = "../ajax/ajaxCommon.php?" + "token="+ token + "&actionId=" + actionId;
                $.ajax({  
                 method:"POST",
                 url: url,
                 data: {customerId:customerId,totalPayMisAmount:totalPayMisAmount,noOfPayMis:noOfPayMis,transactionId:transactionId},
                 dataType: "text",
                 success:function(data){ 
                      if(data==1){
                      $("#loader-gif").hide();
                      //$("#successPay").show();
                      userPreference = "Successfully paid MIS amount!";
                      $(".box-body").load(location.href + " .box-body");
                      //setTimeout(function() { $("#successPay").hide(); }, 5000);
                    }
                    else{
                        $("#loader-gif").hide();
                        //$("#unsuccessPay").show();
                        userPreference = "Error Try again!";
                        $(".box-body").load(location.href + " .box-body");
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
