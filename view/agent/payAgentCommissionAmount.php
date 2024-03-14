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
    <title><?php echo $_SESSION['title'].": Pay Agent Commission"; ?></title>
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
            <li class="active">Manage Agent</li>
            <li class="active">Pay Agent Commission</li>
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
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Pay Agent Commission </h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
             <div class="loader_gif" id="loader-gif" style="display:none;"></div>
            <div class="box-body" style="margin-top: -20px;">
                <?php
                    if($_SESSION['role']=='ROL001'){
                   ?>
                <form role="form" action="#" method="POST">
                  <div class="box-body">
                    <div class="form-group col-lg-4">
                      <label for="agentName"> Agent Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="agencyId" id="agencyId" class="form-control col-lg-6 input-sm" onchange="searchAgentCommissionDetails()" required="required">
                          <option value=""> -- Select Agent Name/Agency Code -- </option>
                           <?php
                            $selectAgent="SELECT agency_code, agent_name FROM agent WHERE status=1";
                            $agentResult=$con->query($selectAgent);
                            while ($agentRow = mysqli_fetch_array($agentResult)) {
                              ?>
                            <option value="<?php echo $agentRow['agency_code'];?>"><?php echo $agentRow['agent_name'].'-'.$agentRow['agency_code'];?></option>
                            <?php

                            }
                           ?>
                      </select>
                    </div>
                      <input type="hidden" name="token" id="token" value="<?php echo $_REQUEST['token']?>">
                  </div>
                   <div class="box-body agentCommissionDetail">
                 
             
                   </div> 
                </form>
                <?php
                    }else{
                    ?>
                     <form role="form" action="#" method="POST">
                  <div class="box-body">
                    <div class="form-group col-lg-4">
                      <label for="agentName"> Agent Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="agencyId" id="agencyId" class="form-control col-lg-6 input-sm" onchange="searchAgentCommissionDetails()" required="required">
                          <option value=""> -- Select Agent Name/Agency Code -- </option>
                           <?php
                            $selectAgent="SELECT agency_code, agent_name FROM agent WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'";
                            $agentResult=$con->query($selectAgent);
                            while ($agentRow = mysqli_fetch_array($agentResult)) {
                              ?>
                            <option value="<?php echo $agentRow['agency_code'];?>"><?php echo $agentRow['agent_name'].'-'.$agentRow['agency_code'];?></option>
                            <?php

                            }
                           ?>
                      </select>
                    </div>
                      <input type="hidden" name="token" id="token" value="<?php echo $_REQUEST['token']?>">
                  </div>
                   <div class="box-body agentCommissionDetail">
                 
             
                   </div> 
                </form>
                    <?php
                    }
                ?>
                <p style="color: #00de83; display: none; margin-top: 20px;" id="successPay"><b>You Have Successfully Pay Amount</b></p>
                <p style="color: #cc093f; display: none; margin-top: 20px;" id="unsuccessPay"><b>Something went wrong please try again !</b></p>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
        /*======================================Jquery search payment detail start=============================================================*/
        function searchAgentCommissionDetails(){
            var agencyId=$("#agencyId").val();
            var token=$("#token").val();
            $("#loader-gif").show();
            $.ajax({
               url:"ajaxSearchPayAgentCommission.php",
               type: 'POST',
               data:{agencyId:agencyId,token:token},
               beforeSend: function () {
                        $('.sidebar-mini').css("opacity", ".5");
                    },
               success:function(data){
                   $('.agentCommissionDetail').html(data);
                   $("#loader-gif").hide();
                   $('.sidebar-mini').css("opacity", "");
                   //alert(data);
               }
            });
        }
        /*======================================Jquery search payment detail end=============================================================*/
        </script> 
        <script>
        /*===========Button Disabled and able=====================*/
        function manageCommissionAmount(){
        var availableAmt = document.getElementById('availableAmount').value;
        var commissionPayAmount = document.getElementById('commissionPayAmt').value;
        if(parseInt(availableAmt)>=parseInt(commissionPayAmount) && parseInt(commissionPayAmount)>0){
        document.getElementById('payCommissionAmountButton').disabled = false;
    }else{
        var ale='Your Available Amount';
        alert(ale +"  "+ availableAmt);
        document.getElementById('payCommissionAmountButton').disabled = true;
       }
    }
        /*===========Button Disabled and able=====================*/
        /*===========Submit Commission Amount start=====================*/
        function payAgentCommission(){
            var agencyId=$("#agencyId").val();
            var commissionPayAmt=$("#commissionPayAmt").val();
            var token=$("#token").val();
            var actionId = 'payAgentCommission';
            $("#loader-gif").show();
            var url = "../ajax/ajaxCommon.php?" + "token="+ token + "&actionId=" + actionId;
            $.ajax({  
                 method:"POST",
                 url: url,
                 data: {agencyId:agencyId,commissionPayAmt:commissionPayAmt},
                 dataType: "text",
                 success:function(data){ 
                      if(data==1){
                      $("#loader-gif").hide();
                      $("#successPay").show();
                      setTimeout(function() { $("#successPay").hide(); }, 5000);
                      $(".box-body").load(location.href + " .box-body");
                    }
                    else{
                        $("#loader-gif").hide();
                        $("#unsuccessPay").show();
                        setTimeout(function() { $("#unsuccessPay").hide(); }, 5000);
                         $(".box-body").load(location.href + " .box-body");
                    }
                    },
            });  
        }    
     /*===========Submit Commission Amount start=====================*/          
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
