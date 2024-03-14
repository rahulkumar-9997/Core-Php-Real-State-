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
    <title><?php echo $_SESSION['title'].": Add Customer"; ?></title>
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
            <li class=""> Manage Customer </li>
            <li class="">Customer List</li>
            <li class="active">Edit Customer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <?php
           $query = "SELECT cu.agency_code, cu.branch_id, cu.name, cu.father, cu.customer_relationship, cu.dob, cu.date_of_joining, cu.aadhar_card_no,"
                   . "cu.expairy_date, cu.country, cu.post, cu.district, cu.pin_code, cu.address, cu.mobil_no, cu.pan_card_no, cu.bank_name, cu.ifsc_code, cu.nominee_date_of_birth, cu.account_no, cu.bank_branch_name, cu.account_holder_name,"
                   . "cu.gender, cu.nominee, cu.realation, cu.customer_img,  cpm.customer_id,  cpm.plan_id, "
                   . "cpm.plan_name, cpm.plan_duration, cpm.plan_type, cpm.installment_amount,"
                   . "cpm.pay_mode, cpm.no_of_installment, cpm.no_of_pay_installment  "
                   . "FROM customer AS cu, customer_plan_mapping AS cpm WHERE cu.customer_id = cpm.customer_id AND cu.customer_id='{$_REQUEST['id']}' AND cpm.customer_id='{$_REQUEST['id']}'";
           $result = $con->query($query);
           while ($customerRow = mysqli_fetch_array($result)) {
              $name=$customerRow['name']; 
              $father=$customerRow['father']; 
              $dob=$customerRow['dob']; 
              $date_of_joining=$customerRow['date_of_joining']; 
              $expairy_date=$customerRow['expairy_date']; 
              $country=$customerRow['country']; 
              $post=$customerRow['post']; 
              $district=$customerRow['district']; 
              $pin_code=$customerRow['pin_code']; 
              $address=$customerRow['address']; 
              $mobil_no=$customerRow['mobil_no']; 
              $gender=$customerRow['gender']; 
              $nominee=$customerRow['nominee']; 
              $realation=$customerRow['realation']; 
              $customer_img=$customerRow['customer_img']; 
              $agency_code=$customerRow['agency_code']; 
              $plan_id=$customerRow['plan_id']; 
              $pay_mode=$customerRow['pay_mode']; 
              $plan_type=$customerRow['plan_type']; 
              $cuAdarCard=$customerRow['aadhar_card_no']; 
              $cuPanCard=$customerRow['pan_card_no']; 
              $cuBankName=$customerRow['bank_name']; 
              $cuIfscCode=$customerRow['ifsc_code']; 
              $cuNomineeName=$customerRow['nominee_date_of_birth']; 
              $cuAccountNo=$customerRow['account_no']; 
              $cuInstallmentAmt=$customerRow['installment_amount']; 
              $cuBankBranchName=$customerRow['bank_branch_name']; 
              $cuAccountHolderName=$customerRow['account_holder_name']; 
              $customerRelationship=$customerRow['customer_relationship']; 
           }
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Edit Customer </h3><span style="color: #ff1e1e;"> * Field Required</span>
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
                <form role="form" action="../../controller/customer/customerController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <legend class="text-purple"> Personal Information</legend>
                    <div class="form-group col-lg-3">
                        <label for="name">Name <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $name;?>" name="name" placeholder="Enter Customer Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="fatherName">Father/Husband Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" value="<?php echo $father;?>" name="fatherName"  placeholder="Enter Father Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="relationship"> Relationship <font style="color: #ff1e1e;">*</font></label>
                      <select name="customerRelationship" class="form-control col-lg-6 input-sm"  required="required">
                            <option value="">-- Select Relationship --</option>
                            <option value="S/O" <?php if($customerRelationship=='S/O'){ echo "selected"; }?>>S/O</option>
                            <option value="W/O" <?php if($customerRelationship=='W/O'){ echo "selected"; }?>>W/O</option>
                            <option value="D/O" <?php if($customerRelationship=='D/O'){ echo "selected"; }?>>D/O</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="dob">Date Of Birth <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm datepicker" value="<?php echo $dob;?>" name="dob" placeholder="Enter Date of Birth" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="mobileNo">Mobile No. <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="mobileNo" value="<?php echo $mobil_no;?>" placeholder="Enter Mobile No." maxlength="10">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="state">Date Of Joining <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" readonly="" name="dateOfJoining" value="<?php echo $date_of_joining;?>" placeholder="" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="district">District <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="district" value="<?php echo $district;?>" placeholder="Enter District" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="gender"> Select Gender <font style="color: #ff1e1e;">*</font></label>
                      <select name="gender" class="form-control col-lg-6 input-sm"  required="required">
                          <option value="">Select Gender</option>
                          <option value="Male" <?php if($gender=='Male'){ echo "selected"; }?>>Male</option>
                          <option value="Female" <?php if($gender=='Female'){ echo "selected"; }?>>Female</option>
                      </select>
                    </div>   
                    <div class="form-group col-lg-3">
                      <label for="countryName">Country Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="country" placeholder="Enter Country Name" value="India" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="post">Post Office Name. <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" maxlength="10" class="form-control input-sm" name="post" value="<?php echo $post;?>" placeholder="Enter Post Office Name" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="pinCode">Pin Code <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="pinCode" value="<?php echo $pin_code;?>" placeholder="Enter Pin Code" maxlength="6">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="address">Village <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="address" value="<?php echo $address;?>" placeholder="Enter Full Address">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="address">Customer Photo <font style="color: #ff1e1e;">*</font></label>
                      <input type="file" class="form-control input-sm" name="photo[]" value="<?php echo $customer_img;?>">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="adharCardNo">Aadhar Card no <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="adharCardNo" maxlength="15" placeholder="Enter Aadhar Card No" value="<?php echo $cuAdarCard;?>">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="panCardNo">Pan Card no <font style="color: #ff1e1e;"></font></label>
                      <input type="text" class="form-control input-sm" name="panCardNo" maxlength="16" placeholder="Enter Pan Card No" value="<?php echo $cuPanCard;?>">
                    </div>
                  </div><!-- /.box-body -->
                  
                  
                  <div class="box-body" style="margin-top: -20px;">  
                    <legend class="text-purple">Account Information</legend>
                    <div class="form-group col-lg-3">
                        <label for="bankName">Bank Name<font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" name="bankName" placeholder="Enter Bank Name"  required="" value="<?php echo $cuBankName;?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="branchName">Branch Name<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="bankBranchName" placeholder="Enter Branch Name"  required="" value="<?php echo $cuBankBranchName;?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="branchName">Account Holder Name<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="accHolderName" placeholder="Enter Account Holder Name"  required="" value="<?php echo $cuAccountHolderName;?>">
                    </div>
                    <div class="form-group" style="width: 120px; float: left;">
                        <label for="accountNo">Account No<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="accountNo" placeholder="Enter Account No"  required="" value="<?php echo $cuAccountNo;?>">
                    </div>
                    <div class="form-group" style="width: 120px; float: left; padding-left: 15px;">
                        <label for="ifscCode">IFSC Code<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="ifscCode" placeholder="Enter IFSC Code"  required="" value="<?php echo $cuIfscCode;?>">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-body" style="margin-top: -20px;">
                    <legend class="text-purple"> Nominee Information</legend>
                    <div class="form-group col-lg-3">
                        <label for="nomineeName">Nominee Name <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $nominee;?>" name="nomineeName" placeholder="Enter Nominee Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="relationship"> Relationship <font style="color: #ff1e1e;">*</font></label>
                      <select name="relationship" class="form-control col-lg-6 input-sm"  required="required">
                            <option value="">---Select---</option>
                            <option value="None" <?php if($realation=='None'){ echo "selected"; }?>>None</option>
                            <option value="Mother" <?php if($realation=='Mother'){ echo "selected"; }?>>Mother</option>
                            <option value="Father" <?php if($realation=='Father'){ echo "selected"; }?>>Father</option>
                            <option value="Brother" <?php if($realation=='Brother'){ echo "selected"; }?>>Brother</option>
                            <option value="Sister" <?php if($realation=='Sister'){ echo "selected"; }?>>Sister</option>
                            <option value="Wife" <?php if($realation=='Wife'){ echo "selected"; }?>>Wife</option>
                            <option value="Husband" <?php if($realation=='Husband'){ echo "selected"; }?>>Husband</option>
                            <option value="Son" <?php if($realation=='Son'){ echo "selected"; }?>>Son</option>
                            <option value="Daughter" <?php if($realation=='Daughter'){ echo "selected"; }?>>Daughter</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="nomineeDob">Nominee Date Of Birth <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm datepicker" name="nomineeDob" placeholder="Enter Date of Birth" required="" value="<?php echo $cuNomineeName;?>">
                    </div>
                  </div>
                   <div class="loader_gif" id="loader-gif" style="display:none;"></div>
                  <div class="box-body" style="margin-top: -20px;">
                    <legend class="text-purple"> Plan Information</legend>
                    <div class="form-group col-lg-3">
                      <label for="agentName"> Agent Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="agencyId" class="form-control col-lg-6 input-sm"  required="required" disabled="">
                          <option value=""> -- Select Agent Name/Agency Code -- </option>
                           <?php
                            $selectAgent="SELECT agency_code, agent_name FROM agent WHERE status=1";
                            $agentResult=$con->query($selectAgent);
                            while ($agentRow = mysqli_fetch_array($agentResult)) {
                              ?>
                            <option value="<?php echo $agentRow['agency_code'];?>"<?php if($agentRow['agency_code']==$agency_code){ ?> selected="selected" <?php } ?>><?php echo $agentRow['agent_name'].'-'.$agentRow['agency_code'];?></option> 
                           <?php

                            }
                           ?>
                      </select>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="installmentAmt">Installment Amount<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" id="installmentAmt" name="installmentAmt" placeholder="Enter Installment Amount"  required="" value="<?php echo $cuInstallmentAmt;?>" readonly="" >
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="planName"> Plan Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="planId" class="form-control col-lg-6 input-sm" disabled="" id="planId" required="required" onchange="planID()">
                          <option value=""> -- Select Plan Name -- </option>
                          <?php
                          $selectPlan="SELECT plan_name, plan_id, plan_type FROM plan WHERE status=1 ORDER BY plan_id";
                          $planResult=$con->query($selectPlan);
                          while ($planRow = mysqli_fetch_array($planResult)) {
                           ?>
                            <option value="<?php echo $planRow['plan_id']?>"<?php if($planRow['plan_id']==$plan_id){ ?> selected="selected" <?php } ?>><?php echo $planRow['plan_name'].'-'.$planRow['plan_type']?></option> 
                           <?php
                           }
                          ?>
                      </select>
                    </div>
                    <div class="payMode">
                    <?php    
                    if($plan_type == 'FD'){
                    ?>
                    <div class="form-group col-lg-3">
                      <label for="payMode"> Pay Mode <font style="color: #ff1e1e;">*</font></label>
                      <select name="payMode" class="form-control col-lg-6 input-sm"  id="payMode" disabled="" onchange="checkPlan()" required="">
                          <option value="fixdeposite" <?php if($pay_mode=='fixdeposite'){ echo "selected"; }?>> Fix Deposite </option>
                      </select>
                    </div> 
                     <?php
                    }else{
                     ?>   
                    <div class="form-group col-lg-3">
                      <label for="payMode"> Pay Mode <font style="color: #ff1e1e;">*</font></label>
                      <select name="payMode" class="form-control col-lg-6 input-sm"  id="payMode"  onchange="checkPlan()" disabled="disabled" required="">
                          <option value="daily" <?php if($pay_mode=='daily'){ echo "selected"; }?>> Daily </option>
                          <option value="weekly" <?php if($pay_mode=='weekly'){ echo "selected"; }?>> Weekly </option>
                          <option value="quarterly" <?php if($pay_mode=='quarterly'){ echo "selected"; }?>> Quarterly </option>
                          <option value="halfyearly" <?php if($pay_mode=='halfyearly'){ echo "selected"; }?>> Half Yearly </option>
                          <option value="yearly" <?php if($pay_mode=='yearly'){ echo "selected"; }?>> Yearly </option>
                          
                      </select>
                    </div>
                    <?php
                    }
                    ?>    
                    </div>
                  </div>
                   <div class="box-body planDetails" style="margin-top: -20px;">
                       
                   </div> 
                  <div class="box-footer">
                      <input type="hidden" name="action" value="editCustomer">
                      <input type="hidden" name="cutomerId" value="<?php echo $_REQUEST['id'];?>">
                      <input type="hidden" name="token" value="<?php echo $_REQUEST['token'];?>" id="token">
                      <button type="submit" class="btn btn-primary" id="submit">Update</button>
                  </div>
                </form>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <script>
  function checkPlan(){
            var planId=$("#planId").val();
            var payMode=$("#payMode").val();
            var token=$("#token").val();
            $("#loader-gif").show();
            $.ajax({
               url:"ajaxPlanDetail.php",
               type: 'POST',
               data:{planId:planId,token:token,payMode:payMode},
               beforeSend: function () {
                        $('.sidebar-mini').css("opacity", ".5");
                    },
               success:function(data){
                   $('.planDetails').html(data);
                   $("#loader-gif").hide();
                   $('.sidebar-mini').css("opacity", "");
                   //alert(data);
               }
            });
        }
  </script>
  <!--=============================Javacript able and disabled field start=================================================================-->
  <script type="text/javascript">
        function planID(){
            var planIID = document.getElementById('planId').value;
            var token=document.getElementById('token').value;
            //alert(planIID);
            if(planIID === ''){
             $('#payMode').attr("disabled", true);
             document.getElementById('submit').disabled = true;
               }else{
              $('#payMode').attr("disabled", false);
               document.getElementById('submit').disabled = false;
               //alert('else');
               $.ajax({
               url:"ajaxPayMode.php",
               type: 'POST',
               data:{planId:planIID,token:token},
               beforeSend: function () {
                        $('.sidebar-mini').css("opacity", ".5");
                    },
               success:function(data){
                   $('.payMode').html(data);
                   $('.sidebar-mini').css("opacity", "");
                  // alert(data);
               }
            });
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
