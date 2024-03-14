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
    <title><?php echo $_SESSION['title'].": Edit Plan"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
  </head>
  <script>
  function checkPlan(){
            var uid = document.getElementById('planName').value;
            var url = "ajaxCheckPlan.php?q="+uid;
            //alert(url);
            $.ajax({
                url: url,
                cache: false,
                success:function(response){
                    //alert(response);
                    if(response==0){
                    $('#success').removeClass('hidden');
                       $('#error').addClass('hidden');
                       document.getElementById('submit').disabled = false;
                }
                else{
                   $('#error').removeClass('hidden');
          $('#success').addClass('hidden');
          document.getElementById('submit').disabled = true;
                }
            }
            });
        }
  </script>
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
            <li class="active">Manage Plan</li>
            <li class="active">Edit Plan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Edit Plan </h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
            <div class="box-body">
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
                  $selectPlan="SELECT plan_id, duration_month, plan_name, commission_in_per, plan_type, interest_rate_in_per, status FROM plan WHERE plan_id='{$_REQUEST['id']}'";
                  $planResult=$con->query($selectPlan);
                  while ($planRow = mysqli_fetch_array($planResult)) {
                      $planName=$planRow['plan_name'];
                      $duration=$planRow['duration_month'];
                      $commission=$planRow['commission_in_per'];
                      $planType=$planRow['plan_type'];
                      $planID=$planRow['plan_id'];
                      $interestRate=$planRow['interest_rate_in_per'];
                  }
                ?>
                <form role="form" action="../../controller/plan/planController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST">
                  <input type="hidden" name="action" id="action" value="addUser"/>
                  <div class="box-body">
                    <span class="help-block hidden" id="success" style="color: green;">Plan name available!</span>
                    <span class="help-block hidden" id="error" style="color: red">Plan name already taken!</span>  
                    <div class="form-group col-lg-3">
                      <label for="planeName">Plan Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" value="<?php echo $planName;?>" name="planName" onkeyup="checkPlan()" id="planName"  placeholder="Enter Plane Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="planType">Plan Type. <font style="color: #ff1e1e;">*</font></label>
                      <select name="planType" class="form-control input-sm col-lg-6" required="required">
                          <option value="">Select Plan Type</option>
                          <option value="RD" <?php if($planType=='RD'){ echo "selected"; }?>>RD</option>
                          <option value="FD" <?php if($planType=='FD'){ echo "selected"; }?>>FD</option>
                          <option value="MIS" <?php if($planType=='MIS'){ echo "selected"; }?>>MIS</option>
                      </select>
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="planDuration">Plan Duration (In Month)<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="planDuration" value="<?php echo $duration;?>" placeholder="Enter Plan Duration" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="amount">Interest Rate(In %)<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="interestRate" value="<?php echo $interestRate;?>" placeholder="Interest Rate In %" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                        <label for="comission">Commission (In %)<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="comission" value="<?php echo $commission;?>" placeholder="Enter Comission" required="">
                    </div> 
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <a href="planList.php?token=<?php echo $_REQUEST['token'];?>" class="text-bold">Back</a>
                      <input type="hidden" name="action" value="editPlan">
                      <input type="hidden" name="planId" value="<?php echo $planID;?>">
                      <button type="submit" class="btn btn-primary pull-right" id="submit">Update</button>
                  </div>
                </form>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

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
