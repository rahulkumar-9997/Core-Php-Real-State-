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
    <title><?php echo $_SESSION['title'].": Add Branch"; ?></title>
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
            <li class="active">Installment</li>
            <li class="active">Deposit Installment</li>
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
          <div class="box box-info" id="refreshDiv">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Deposit Installment </h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
             <div class="loader_gif" id="loader-gif" style="display:none;"></div>
             <div class="box-body" style="margin-top: -20px;">
                 <?php
                    if($_SESSION['role']=='ROL001'){
                   ?>
                <form role="form" action="#" method="POST">
                    <input type="hidden" name="token" value="<?php echo $_REQUEST['token']?>" id="token"/>  
                  <div class="box-body">
                    <div class="form-group col-lg-3">
                      <label for="customerId"> Customer Id/Customer Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="customerId" class="form-control col-lg-6 input-sm"  id="customerId" required="required" onchange="searchCustomerPlanName()">
                          <option value=""> Select Customer Id/Customer Name </option>
                          <?php
                          /*$selectCustomer="SELECT cu.customer_id, cu.name FROM customer AS cu, cpm.customer_id, cpm.plan_type AS cpm WHERE cu.customer_id=cpm.customer_id AND status=1 AND claimed_maturity_payment_status=0 ORDER BY id";*/
                          $selectCustomer="SELECT cu.customer_id, cu.name, cpm.customer_id, cpm.plan_type "
                                  . "FROM customer AS cu, customer_plan_mapping AS cpm  "
                                  . "WHERE cu.customer_id = cpm.customer_id AND cu.status=1 AND cu.claimed_maturity_payment_status =0 AND cpm.plan_type='RD'";
                          $customerResult=$con->query($selectCustomer);
                          while ($customerRow = mysqli_fetch_array($customerResult)) {
                           ?>
                            <option value="<?php echo $customerRow['customer_id']?>"><?php echo $customerRow['customer_id'].'-'.$customerRow['name']?></option>
                          <?php
                           }
                          ?>
                      </select>
                    </div>
                    <!--=======select customer plan through ajax start=========-->  
                    <div class="customerPlanName">


                    </div>  
                    <!--=======select customer plan through ajax end=========-->  
                  </div>
                </form>
                 <p style="color: #00de83; display: none;" id="successPay"><b>You Have Successfully Pay Amount/Deposit Installment .</b></p>
                 <p style="color: #cc093f; display: none;" id="unsuccessPay"><b>Something went wrong please try again !</b></p>
                 <?php
                    }else{
                     ?>
                 <form role="form" action="#" method="POST">
                    <input type="hidden" name="token" value="<?php echo $_REQUEST['token']?>" id="token"/>  
                  <div class="box-body">
                    <div class="form-group col-lg-3">
                      <label for="customerId"> Customer Id/Customer Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="customerId" class="form-control col-lg-6 input-sm"  id="customerId" required="required" onchange="searchCustomerPlanName()">
                          <option value=""> Select Customer Id/Customer Name </option>
                          <?php
                          $selectCustomer="SELECT cu.customer_id, cu.name, cpm.customer_id, cpm.plan_type FROM customer AS cu,"
                                  . " customer_plan_mapping AS cpm  WHERE cu.customer_id = cpm.customer_id AND cu.status=1 "
                                  . "AND cu.claimed_maturity_payment_status =0 branch_id='{$_SESSION['branch_id']}' ORDER BY id";
                          $customerResult=$con->query($selectCustomer);
                          while ($customerRow = mysqli_fetch_array($customerResult)) {
                           ?>
                            <option value="<?php echo $customerRow['customer_id']?>"><?php echo $customerRow['customer_id'].'-'.$customerRow['name']?></option>
                          <?php
                           }
                          ?>
                      </select>
                    </div>
                     <!--=======select customer plan through ajax start=========-->  
                    <div class="customerPlanName">


                    </div>  
                    <!--=======select customer plan through ajax end=========-->   
                  </div>
                </form>
                    <?php
                    }
                 ?>
                 <p style="color: #00de83; display: none;" id="successPay"><b>You Have Successfully Pay Amount</b></p>
                 <p style="color: #cc093f; display: none;" id="unsuccessPay"><b>Something went wrong please try again !</b></p>
                 <div class="box-body SeaechInstallmentDetails" id="refreshDivIn">
                    
                </div>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php require_once '../../includes/bottom.php'; ?>
    <?php require_once '../../includes/footer_includes.php'; ?>
      <script>
      /*=======================Ajax search deposit  Installment  details start==============================*/    
       function searchInstallment(){
              var customerId=$("#customerId").val();
              var planId=$("#planId").val();
              var token=$("#token").val();
              var actionId = 'searchInstallment';
              $("#loader-gif").show();
              var url = "../ajax/ajaxCommon.php?" + "token="+ token + "&actionId=" + actionId; 
              $.ajax({
                 url: url,
                 type: 'POST',
                 data:{customerId:customerId,planId:planId,token:token},
                 beforeSend: function () {
                          $('.sidebar-mini').css("opacity", ".5");
                      },
                 success:function(data){
                     $('.SeaechInstallmentDetails').html(data);
                     $("#loader-gif").hide();
                     $('.sidebar-mini').css("opacity", "");
                     //alert(data);
                 }
              });
          }
       /*=======================Ajax search deposit Installment details end==============================*/ 
      </script>
      <script type="text/javascript">
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
/*=============================Ajax deposit installment code start========================================*/
/*=======================Ajax search deposit Installment start==============================*/    
        $(document).on('click', '#payInstallment', function(){
              var instaAmount=$("#instaAmount").val();
              var depNoOfIns=$("#noOfInsta").val();
              var deposit_amount=$("#depositeAmount").val();
              var cuId=$("#cuId").val();
              var planId=$("#planId").val();
              var token=$("#token").val();
              var customerMobileNo=$("#customerMobileNo").val();
              $("#loader-gif").show();
              $.ajax({
                 url:"ajaxDepositInstallment.php",
                 type: 'POST',
                 data:{depNoOfIns:depNoOfIns,deposit_amount:deposit_amount,cuId:cuId,planId:planId,token:token,customerMobileNo:customerMobileNo},
                 dataType: "text",
                    success: function(data) {
                    //alert(data);
                    if(data==1){    
                    $("#loader-gif").hide();
                    $("#refreshDivIn").load(location.href + " #refreshDivIn");
                    $("#successPay").show();
                    setTimeout(function() { $("#successPay").hide(); }, 5000);
                    }
                    else{
                       $("#loader-gif").hide();
                       $("#refreshDivIn").load(location.href + " #refreshDivIn");
                       $("#unsuccessPay").show();
                       setTimeout(function() { $("#unsuccessPay").hide(); }, 5000);
                      }
                    },
              });
         });
       /*=======================Ajax search deposit Installment end==============================*/ 
/*=============================Ajax deposit installment code end========================================*/
/*============================================Ajax Search Plan name start======================================================*/
function searchCustomerPlanName(){
            $('.SeaechInstallmentDetails').html('');
              var customerId=$("#customerId").val();
              var token=$("#token").val();
              var planId=$("#planId").val();
              var actionId = 'searchCustomerPlanName';
              if(planId==''){
                   searchInstallment();
               }
              $("#loader-gif").show();
              var url = "../ajax/ajaxCommon.php?" + "token="+ token + "&actionId=" + actionId; 
              $.ajax({
                 url: url,
                 type: 'POST',
                 data:{customerId:customerId,token:token},
                 beforeSend: function () {
                          $('.sidebar-mini').css("opacity", ".5");
                      },
                 success:function(data){
                     $('.customerPlanName').html(data);
                     $("#loader-gif").hide();
                     $('.sidebar-mini').css("opacity", "");
                     //alert(data);
                 }
              });
          }
         
/*============================================Ajax Search Plan name end======================================================*/
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
