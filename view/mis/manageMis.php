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
    <title><?php echo $_SESSION['title'].": Pay Mis (Monthly Income Scheme)"; ?></title>
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
            <li class="active">Manage MIS</li>
            <li class="active">Pay MIS (Monthly Income Scheme) Amount</li>
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
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Pay MIS (Monthly Income Scheme) Amount </h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
				
             <h4><p id="msg" style="font-weight: bold; margin-left: 20px;"></p></h4>  
            <div class="box-body" style="margin-top: -20px;">
                <?php
                    if($_SESSION['role']=='ROL001'){
                ?>
                <form role="form" action="#" method="POST">
                  <div class="box-body">
                    <div class="form-group col-lg-3">
                      <label for="customerId"> Customer Name/Registration No. <font style="color: #ff1e1e;">*</font></label>
                      <select name="customerId" id="customerId" class="form-control col-lg-6 input-sm" onchange="searchCustomer()" required="required">
                          <option value=""> -- Select Customer Name/Registration No -- </option>
                           <?php
                            $selectCustomer="SELECT cu.customer_id, cu.registration_no, cu.name, cpm.plan_type FROM customer AS cu, customer_plan_mapping AS cpm WHERE cu.customer_id = cpm.customer_id AND cu.status=1 AND cu.claimed_maturity_payment_status=0 AND cpm.status=1 AND cpm.plan_type='MIS'";
                            $customerResult=$con->query($selectCustomer);
                            while ($customerRow = mysqli_fetch_array($customerResult)) {
                              ?>
                            <option value="<?php echo $customerRow['customer_id'];?>"><?php echo $customerRow['name'].'-'.$customerRow['registration_no'];?></option>
                            <?php

                            }
                           ?>
                      </select>
                    </div>
                      <input type="hidden" name="token" id="token" value="<?php echo $_REQUEST['token']?>">
                  </div>
                   <div class="box-body searchCustomerDetails">
                 
             
                   </div> 
                </form>
                <?php
                    }else{
                    ?>
                     <form role="form" action="#" method="POST">
                        <div class="box-body">
                            <div class="form-group col-lg-3">
                              <label for="customerId"> Customer Name/Registration No. <font style="color: #ff1e1e;">*</font></label>
                              <select name="customerId" id="customerId" class="form-control col-lg-6 input-sm" onchange="searchCustomer()" required="required">
                                  <option value=""> -- Select Customer Name/Registration No -- </option>
                                   <?php
                                    $selectCustomer="SELECT cu.customer_id, cu.registration_no, cu.name, cpm.plan_type "
                                            . "FROM customer AS cu, customer_plan_mapping AS cpm WHERE "
                                            . "cu.customer_id = cpm.customer_id AND cu.status=1 AND cu.claimed_maturity_payment_status=0 AND cpm.status=1 AND cpm.plan_type='MIS' AND cu.branch_id='{$_SESSION['branch_id']}' AND cpm.branch_id='{$_SESSION['branch_id']}'";
                                    $customerResult=$con->query($selectCustomer);
                                    while ($customerRow = mysqli_fetch_array($customerResult)) {
                                      ?>
                                    <option value="<?php echo $customerRow['customer_id'];?>"><?php echo $customerRow['name'].'-'.$customerRow['registration_no'];?></option>
                                    <?php

                                    }
                                   ?>
                              </select>
                            </div>
                              <input type="hidden" name="token" id="token" value="<?php echo $_REQUEST['token']?>">
                        </div>
                   <div class="box-body searchCustomerDetails">
                 
             
                   </div> 
                </form>
                    <?php
                    }
                ?>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
        /*======================================Jquery search Customer Details start=============================================================*/
        function searchCustomer(){
            var customerId=$("#customerId").val();
            var token=$("#token").val();
            var actionId = 'searchCustomer';
            $("#loader-gif").show();
            var url = "../ajax/ajaxCommon.php?" + "token="+ token + "&actionId=" + actionId;
            $.ajax({
                 url: url,
                 type: 'POST',
                 data:{customerId:customerId},
                 beforeSend: function () {
                          $('.sidebar-mini').css("opacity", ".5");
                      },
                 success:function(data){
                     $('.searchCustomerDetails').html(data);
                     $("#loader-gif").hide();
                     $('.sidebar-mini').css("opacity", "");
                 }
              });
       
        }    
        /*====================================== Jquery search Customer Details start =============================================================*/
        /*===================================================Pay Amount Button able and disable Start=========================================*/
                    function manageMisAmount(){
                    var MisAmount = document.getElementById('MisAmount').value;
                    var noOfPayMis = document.getElementById('noOfPayMis').value;
                    var availableNoOfMis = document.getElementById('availableNoOfMis').value;
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
            if(transactionId==''){
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
                      $(".box-body").load(location.href + " .box-body");
                      userPreference = "Successfully paid MIS amount!";
                      //setTimeout(function() { $("#successPay").hide(); }, 5000);
                    }
                    else{
                        $("#loader-gif").hide();
                        //$("#unsuccessPay").show();
                        $(".box-body").load(location.href + " .box-body");
                        userPreference = "Error Try again!";
                        //setTimeout(function() { $("#unsuccessPay").hide(); }, 5000);
                    }
                     document.getElementById("msg").innerHTML = userPreference; 
                    },
            });  
        }
        }    
        /*===================================================Pay Amount Click Submit Button End=========================================*/
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
