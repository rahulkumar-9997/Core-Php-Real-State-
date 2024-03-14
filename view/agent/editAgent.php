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
    <title><?php echo $_SESSION['title'].": Edit Agent"; ?></title>
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
            <li class="active">Agent List</li>
            <li class="active">Edit Agent</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Edit Agent </h3><span style="color: #ff1e1e;"> * Field Required</span>
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
                 $selectAgent="SELECT id, agency_code, agent_name, country, state, district, post, pin_code,"
                         . " address, mobile_no, email, bank_name, bank_account_no, bank_ifsc_code, aadhar_card_no, bank_branch_name, account_holder_name,"
                         . "pan_card_no FROM agent WHERE id='{$_REQUEST['id']}' AND status=1";
                  $agentResult=$con->query($selectAgent);
                  while ($agentRow = mysqli_fetch_array($agentResult)) {
                      $agencyCode=$agentRow['agency_code'];
                      $agentName=$agentRow['agent_name'];
                      $country=$agentRow['country'];
                      $state=$agentRow['state'];
                      $district=$agentRow['district'];
                      $postOffice=$agentRow['post'];
                      $pinCode=$agentRow['pin_code'];
                      $address=$agentRow['address'];
                      $mobileNo=$agentRow['mobile_no'];
                      $email=$agentRow['email'];
                      $id=$agentRow['id'];
                      $panCard=$agentRow['pan_card_no'];
                      $aadharCard=$agentRow['aadhar_card_no'];
                      $bankName=$agentRow['bank_name'];
                      $bankAccountNo=$agentRow['bank_account_no'];
                      $ifscNo=$agentRow['bank_ifsc_code'];
                      $bankBranchName=$agentRow['bank_branch_name'];
                      $accountHolderName=$agentRow['account_holder_name'];
                      
                  }
                 ?>
                <form role="form" action="../../controller/agent/agentController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST">
                  <div class="box-body" style="margin-top: -20px;">
                    <div class="form-group col-lg-3">
                        <label for="agencyCode">Agency Code <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $agencyCode;?>" readonly="" name="agencyCode" placeholder="Branch Code" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="agentName">Agent Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="agentName" value="<?php echo $agentName;?>" placeholder="Enter Agent Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="country">Country <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="country" value="<?php echo $country;?>" placeholder="Enter Country" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="state">State <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="state" value="<?php echo $state;?>" placeholder="Enter State" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="district">District <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="district" value="<?php echo $district;?>" placeholder="Enter District" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="postOffice">Post Office <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="postOffice" value="<?php echo $postOffice;?>" placeholder="Enter Post Office" required="">
                    </div>   
                    <div class="form-group col-lg-3">
                      <label for="pinCode">Pin Code <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="pinCode" maxlength="6" value="<?php echo $pinCode;?>" placeholder="Enter Pin Code" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="contactNo">Contact No. <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" maxlength="10" class="form-control input-sm" name="contactNo" value="<?php echo $mobileNo;?>" placeholder="Enter Mobile No." required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="email">Email </label>
                      <input type="email" class="form-control input-sm" name="email" value="<?php echo $email;?>" placeholder="Enter Email">
                    </div>   
                    
                    <div class="form-group col-lg-6">
                      <label for="address">Address <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="address" value="<?php echo $address;?>" placeholder="Enter Full Address" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="panCardNo">Pan Card No<font style="color: #ff1e1e;"></font></label>
                      <input type="text" class="form-control input-sm" name="panCardNo" placeholder="Enter Pan Card No" value="<?php echo $panCard;?>">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="aadharCardNo">Aadhar Card No<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="aadharCardNo" placeholder="Enter Aadhar Card No" required="" maxlength="12" value="<?php echo $aadharCard;?>">
                    </div>   
                  </div><!-- /.box-body -->
                  <div class="box-body" style="margin-top: -20px;">
                   <legend class="text-purple">Account Information</legend>   
                   <div class="form-group col-lg-3">
                      <label for="bankName">Bank Name </label>
                      <input type="text" class="form-control input-sm" name="bankName" placeholder="Enter Bank Name" value="<?php echo $bankName;?>">
                    </div> 
                   <div class="form-group col-lg-3">
                        <label for="branchName">Branch Name<font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" name="bankBranchName" placeholder="Enter Branch Name"  required="" value="<?php echo $bankBranchName;?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="branchName">Account Holder Name<font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" name="accHolderName" placeholder="Enter Account Holder Name"  required="" value="<?php echo $accountHolderName?>">
                    </div>
                   
                   
                   <div class="form-group" style="width: 120px; float: left;">
                        <label for="accountNo">Account No<font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" name="accountNo" placeholder="Enter Account No" maxlength="16" required="" value="<?php echo $bankAccountNo;?>">
                    </div>
                    <div class="form-group" style="width: 120px; float: left; padding-left: 15px;">
                        <label for="ifscCode">IFSC Code<font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" name="ifscNo" placeholder="Enter IFSC Code" maxlength="16" required="" value="<?php echo $ifscNo;?>">
                    </div>
                  </div>
                  <div class="box-footer">
                      <a href="agentList.php?token=<?php echo $_REQUEST['token'];?>" class="text-bold">Back</a>
                      <input type="hidden" name="action" value="editAgent">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
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
