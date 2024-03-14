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
    <title><?php echo $_SESSION['title'].": Claimed Maturity Return Amount"; ?></title>
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
            <li class="active">Claimed Maturity Pending List</li>
            <li class="">Claimed Maturity Return Amount</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Customer Maturity Return Form</h3><span style="color: #ff1e1e;"> * Field Required</span>
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
            <?php
            $selectCustomerDetails="SELECT  cu.name, cu.father, cu.dob, cu.bank_name, cu.account_no, cu.ifsc_code, cu.account_holder_name, cu.date_of_joining, cu.expairy_date, cu.country, "
                    . "cu.post, cu.district, cu.pin_code, cu.address, cu.mobil_no, cu.gender, cu.customer_img, cpm.id, cpm.customer_id, "
                    . "cpm.agency_code, cpm.plan_name, cpm.plan_duration, cpm.interest_rate_in_per, cpm.plan_type,  cpm.total_installment_amount,"
                    . " cpm.installment_amount, cpm.maturity_return, cpm.no_of_installment, cpm.no_of_pay_installment FROM customer AS cu, customer_plan_mapping AS cpm "
                    . "WHERE cu.customer_id=cpm.customer_id AND cu.customer_id='{$_REQUEST['cuId']}' AND cpm.customer_id='{$_REQUEST['cuId']}'";
                    $result = $con->query($selectCustomerDetails);
                    while ($row = mysqli_fetch_array($result)) {
                        $cuName=$row['name'];
                        $faName=$row['father'];
                        $dob=$row['dob'];
                        $dateOfJoining=$row['date_of_joining'];
                        $Expiry=$row['expairy_date'];
                        $planName=$row['plan_name'];
                        $planDuration=$row['plan_duration'];
                        $interest_rate_in_per=$row['interest_rate_in_per'];
                        $planType=$row['plan_type'];
                        $totalInstallmentAmt=$row['total_installment_amount'];
                        $maturityReturn=$row['maturity_return'];
                        $cuPhoto=$row['customer_img'];
                        $mobileNo=$row['mobil_no'];
                        $installmentAmount=$row['installment_amount'];
                        $noOfInsta=$row['no_of_installment'];
                        $noOfPayInsa=$row['no_of_pay_installment'];
                        $bank_name=$row['bank_name'];
                        $account_no=$row['account_no'];
                        $ifsc_code=$row['ifsc_code'];
                        $accountHolderName=$row['account_holder_name'];
                    }
            
            ?>
            <table class="table">
                <thead>
                      <tr>
                        <td><b>Customer Name</b></td>
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
                        <td><i class="fa fa-rupee"></i> <?php echo $noOfPayInsa*$installmentAmount;?></td>
                        <td><b>Installment Amount</b></td>
                        <td><i class="fa fa-rupee"></i> <?php echo $installmentAmount;?></td>  
                        <td><b>Total Installment Amount</b></td>
                        <td><i class="fa fa-rupee"></i> <?php echo $totalInstallmentAmt;?></td>
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
            <form role="form" action="../../controller/customer/customerController.php?token=<?php echo $_REQUEST['token'];?>&action=payCustomerMaturityAmount&cuId=<?php echo $_REQUEST['cuId'];?>&id=<?php echo $_REQUEST['id'];?>&name=<?php echo $cuName;?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group col-lg-3">
                        <label for="name">Enter Maturity Return Amount <i class="fa fa-rupee"></i><font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" id="maturityAmount" value="<?php echo $maturityReturn;?>" onkeyup="manageAmount()" name="maturity_return_amount" placeholder="Enter Maturity Return Amount" required="">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="transaction_id">Transaction Id <font style="color: #ff1e1e;"></font></label>
                        <input type="text" class="form-control input-sm" maxlength="12" name="transaction_id"  placeholder="Enter Transaction Id">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="date">Date <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm datepicker" name="date"  placeholder="Enter Maturity Return Date" required="">
                    </div>
                    <div class="col-lg-3 form-group" style="margin-top: 20px;">
                        <input type="hidden" name="action" value="payCustomerMaturityAmount">
                        <input type="hidden" name="customerId" value="<?php echo $_REQUEST['cuId']?>">
                        <input type="hidden" name="maturityReturnAmount" id="maturityReturnAmount" value="<?php echo $maturityReturn;?>">
                        <button type="submit" id="submit" class="btn btn-primary submitBtn" name="submitButton" onClick="if(confirm('Do you want to pay maturity amount ?')) { return true; } else { return false; }">Submit</button>
                    </div>
                </div>
            </form>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <script>
   /*==============================Submit button disabled than click submit======================================================*/  
   function checkForm(form)
  {
    form.submitButton.disabled = true;
    return true;
  }

    /*==============================Submit button disabled than click submit======================================================*/  
  /*===============================Ajax Check Installment Ammount Start===============================================*/ 
  function manageAmount(){
        var maturityReturnAmt=document.getElementById('maturityReturnAmount').value;
        var maturityAmount=document.getElementById('maturityAmount').value;
        if(parseInt(maturityReturnAmt)>=parseInt(maturityAmount)){
        document.getElementById('submit').disabled = false;
    }else{
        document.getElementById('submit').disabled = true;
       }
    }
    </script>
 <!--=============================Javacript able and disabled field end=================================================================-->    
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
