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
    <title><?php echo $_SESSION['title'].": Add Agent"; ?></title>
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
            <li class="active">Register Agent</li>
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
            $selectLastId = "select agency_code from agent ORDER BY id DESC limit 1";
            $result = $con->query($selectLastId);
            $id="";
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['agency_code'];
            }
            if(empty($id)){
                $id = "UP00000";
            }
            $newAr = explode(" ", $id);
            //print_r($newAr);
            $pad_length = 2;
            $pad_lengthi = 5;
            $fId = substr($newAr[0], 5);
           // echo $fId;
            $iId = $fId+1;
            //$iId = $newAr[2]+1;
            //print_r($newAr[0]);
            //echo $iId;
            //$log->info("Id fetched : $fId");
            $nId = $fId;
            //$log->info("New id generated : $nId");
            $branchCode=$_SESSION['branch_code'];
            $id = 'UP'.$branchCode.str_pad($iId, $pad_lengthi, "0", STR_PAD_LEFT);
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Register Agent </h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
            <div class="box-body" style="margin-top: -20px;">
                <form role="form" action="../../controller/agent/agentController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST" onsubmit="return checkForm(this);">
                  <div class="box-body">
                    <div class="form-group col-lg-3">
                        <label for="agencyCode">Agency Code <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $id;?>" readonly="" name="agencyCode" placeholder="Branch Code" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="agentName">Agent Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="agentName"  placeholder="Enter Agent Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="country">Country <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" value="India" name="country" placeholder="Enter Country" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="state">State <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="state" value="Uttar Pradesh" placeholder="Enter State" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="district">District <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="district" placeholder="Enter District" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="postOffice">Post Office <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="postOffice" placeholder="Enter Post Office" required="">
                    </div>   
                    <div class="form-group col-lg-3">
                      <label for="pinCode">Pin Code <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="pinCode" maxlength="6" placeholder="Enter Pin Code" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="contactNo">Contact No. <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" maxlength="10" class="form-control input-sm" name="contactNo" placeholder="Enter Mobile No." required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="email">Email </label>
                      <input type="email" class="form-control input-sm" name="email" placeholder="Enter Email">
                    </div>   
                    
                    <div class="form-group col-lg-6">
                      <label for="address">Address <font style="color: #ff1e1e;"></font></label>
                      <input type="text" class="form-control input-sm" name="address" placeholder="Enter Full Address" >
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="panCardNo">Pan Card No<font style="color: #ff1e1e;"></font></label>
                      <input type="text" class="form-control input-sm" name="panCardNo" placeholder="Enter Pan Card No" >
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="aadharCardNo">Aadhar Card No<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="aadharCardNo" placeholder="Enter Aadhar Card No" required="" maxlength="12">
                    </div>  
                  </div><!-- /.box-body -->
                  <div class="box-body" style="margin-top: -20px;">
                   <legend class="text-purple">Bank Information</legend>   
                   <div class="form-group col-lg-3">
                      <label for="bankName">Bank Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="bankName" placeholder="Enter Bank Name" required="">
                    </div> 
                   <div class="form-group col-lg-3">
                        <label for="branchName">Branch Name<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="bankBranchName" placeholder="Enter Branch Name"  required="">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="branchName">Account Holder Name<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="accHolderName" placeholder="Enter Account Holder Name"  required="">
                    </div>
                   
                   <div class="form-group" style="width: 120px; float: left;">
                        <label for="accountNo">Account No<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="accountNo" placeholder="Enter Account No"  required="">
                    </div>
                    <div class="form-group" style="width: 120px; float: left; padding-left: 15px;">
                        <label for="ifscCode">IFSC Code<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="ifscNo" placeholder="Enter IFSC Code"  required="">
                    </div>
                  </div>
                  <div class="box-footer">
                      <input type="hidden" name="action" value="addAgent">
                      <button type="submit" class="btn btn-primary" id="submit" name="submitButton">Submit</button>
                  </div>
                </form>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php require_once '../../includes/bottom.php'; ?>
      
    <?php require_once '../../includes/footer_includes.php'; ?>
    <script>
    /*==============================Submit button disabled than click submit======================================================*/  
            function checkForm(form){
             form.submitButton.disabled = true;
             return true;
           }

    /*==============================Submit button disabled than click submit======================================================*/  
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
