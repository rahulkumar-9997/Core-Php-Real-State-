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
            <li class="active">Manage Customer</li>
            <li class="active">Register Customer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <?php
            $selectLastId = "select customer_id, registration_no, `sr_no` from customer ORDER BY id DESC limit 1";
            $result = $con->query($selectLastId);
            $registrationNo="";
            $srNo="";
            $custId="";
            while ($row = mysqli_fetch_array($result)) {
                $registrationNo = $row['registration_no'];
                $srNo=$row['sr_no'];
                $custId=$row['customer_id'];
            }
            if(empty($registrationNo)){
                $registrationNo = "UP0000000";
            }
            
            $newAr = explode(" ", $registrationNo);
            $pad_length = 5;
            $pad_lengthi = 7;
            $fId = substr($newAr[0], 5);
             //echo $fId;
            $iId = $fId+1;
            $nId = $fId;
            $branchCode=$_SESSION['branch_code'];
            $registrationNo = 'UP'.$branchCode.str_pad($iId, $pad_lengthi, "0", STR_PAD_LEFT);
            
            /* ============== Customer  no ====================*/
            if(empty($custId)){
                $custId = "CU0000000";
            }
            
            $newCuAr = explode(" ", $custId);
            $pad_lengthCu = 2;
            $pad_lengthiCu = 7;
            $fIdCu = substr($newCuAr[0], 2);
           // echo $fId;
            $iIdCu = $fIdCu+1;
            $nIdCu = $fIdCu;
            $branchCodeCu=$_SESSION['branch_code'];
             $custId = 'CU'.str_pad($iIdCu, $pad_lengthiCu, "0", STR_PAD_LEFT);
            /* ============== sr no ====================*/
             
             /* ============== Sr Start no ====================*/
            if(empty($srNo)){
                $srNo = "UP0000000";
            }
            
            $newSrAr = explode(" ", $srNo);
            $pad_lengthSr = 2;
            $pad_lengthiSr = 7;
            $fIdSr = substr($newSrAr[0], 2);
           // echo $fId;
            $iIdSr = $fIdSr+1;
            $nIdSr = $fIdSr;
            $branchCodeSr=$_SESSION['branch_code'];
            $srNo = 'UP'.str_pad($iIdSr, $pad_lengthiSr, "0", STR_PAD_LEFT);
            /* ============== Sr no End====================*/
            
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Customer Registration</h3><span style="color: #ff1e1e;"> * Field Required</span>
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
            <form role="form" action="../../controller/customer/customerController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return checkForm(this);">
                  <div class="box-body">
                    <legend class="text-purple"> Personal Information</legend>
                    <div class="form-group col-lg-3">
                        <label for="name">Name <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" value="" name="name" placeholder="Enter Customer Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="fatherName">Father/Husband Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="fatherName"  placeholder="Enter Father Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="relationship"> Relationship <font style="color: #ff1e1e;">*</font></label>
                      <select name="customerRelationship" class="form-control col-lg-6 input-sm"  required="required">
                            <option value="S/O">S/O</option>
                            <option value="W/O">W/O</option>
                            <option value="D/O">D/O</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="dob">Date Of Birth <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm datepicker" name="dob" placeholder="Enter Date of Birth" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="mobileNo">Mobile No. <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="mobileNo" placeholder="Enter Mobile No." maxlength="10" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="state">Date Of Joining <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm datepicker" name="dateOfJoining" placeholder="dateOfJoining"  id="dateOfJoining" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="district">District <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="district" placeholder="Enter District" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="gender"> Select Gender <font style="color: #ff1e1e;">*</font></label>
                      <select name="gender" class="form-control col-lg-6 input-sm"  required="required">
                          <option value="">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                      </select>
                    </div>   
                    <div class="form-group col-lg-3">
                      <label for="countryName">Country Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="country" placeholder="Enter Country Name" value="India" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="post">Post Office Name. <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="post" placeholder="Enter Post Office Name" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="pinCode">Pin Code <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="pinCode" placeholder="Enter Pin Code" maxlength="6" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="address">Village<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="address" placeholder="Enter Village Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="address">Customer Photo <font style="color: #ff1e1e;"></font></label>
                      <input type="file" class="form-control input-sm" name="photo[]">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="adharCardNo">Aadhar Card no <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="adharCardNo" maxlength="15" placeholder="Enter Aadhar Card No"  required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="panCardNo">Pan Card no <font style="color: #ff1e1e;"></font></label>
                      <input type="text" class="form-control input-sm" name="panCardNo" maxlength="16" placeholder="Enter Pan Card No">
                    </div>
                  </div>
                    <div class="box-body" style="margin-top: -20px;">  
                    <legend class="text-purple">Account Information</legend>
                    <div class="form-group col-lg-3">
                        <label for="bankName">Bank Name<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="bankName" placeholder="Enter Bank Name"  required="">
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
                      <input type="text" class="form-control input-sm" name="ifscCode" placeholder="Enter IFSC Code"  required="">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-body" style="margin-top: -20px;">
                    <legend class="text-purple"> Nominee Detail</legend>
                    <div class="form-group col-lg-3">
                        <label for="nomineeName">Nominee Name <font style="color: #ff1e1e;">*</font></label>
                        <input type="text" class="form-control input-sm" value="" name="nomineeName" placeholder="Enter Nominee Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="relationship"> Relationship <font style="color: #ff1e1e;">*</font></label>
                      <select name="relationship" class="form-control col-lg-6 input-sm"  required="required">
                            <option value="">---Select---</option>
                            <option value="None">None</option>
                            <option value="Mother">Mother</option>
                            <option value="Father">Father</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Wife">Wife</option>
                            <option value="Husband">Husband</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="nomineeDob">Nominee Date Of Birth <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm datepicker" name="nomineeDob" placeholder="Enter Date of Birth" required="">
                    </div>
                  </div>
                   <div class="loader_gif" id="loader-gif" style="display:none;"></div>
                  <div class="box-body" style="margin-top: -20px;">
                    <legend class="text-purple"> Plan Detail</legend>
                    <div class="form-group col-lg-3">
                      <label for="agentName"> Agent Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="agencyId" class="form-control col-lg-6 input-sm"  required="required">
                          <option value=""> -- Select Agent Name/Agency Code -- </option>
                           <?php
                            if($_SESSION['role']=='ROL001'){
                            $selectAgent="SELECT agency_code, agent_name FROM agent WHERE status=1";
                            $agentResult=$con->query($selectAgent);
                            while ($agentRow = mysqli_fetch_array($agentResult)) {
                              ?>
                            <option value="<?php echo $agentRow['agency_code'];?>"><?php echo $agentRow['agent_name'].'-'.$agentRow['agency_code'];?></option>
                            <?php
                            }
                            }else{
                            $selectAgent="SELECT agency_code, agent_name FROM agent WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'";
                            $agentResult=$con->query($selectAgent);
                            while ($agentRow = mysqli_fetch_array($agentResult)) {
                              ?>
                            <option value="<?php echo $agentRow['agency_code'];?>"><?php echo $agentRow['agent_name'].'-'.$agentRow['agency_code'];?></option>
                            <?php
                            }  
                            }
                           ?>
                      </select>
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="planName"> Plan Name <font style="color: #ff1e1e;">*</font></label>
                      <select name="planId" class="form-control col-lg-6 input-sm" id="planId" required="required" onchange="planID()">
                          <option value=""> -- Select Plan Name -- </option>
                          <?php
                          $selectPlan="SELECT plan_name, plan_id, plan_type FROM plan WHERE status=1 ORDER BY plan_id";
                          $planResult=$con->query($selectPlan);
                          while ($planRow = mysqli_fetch_array($planResult)) {
                           ?>
                            <option value="<?php echo $planRow['plan_id']?>"><?php echo $planRow['plan_name'].'-'.$planRow['plan_type']?></option>
                          <?php
                           }
                          ?>
                      </select>
                    </div>
                    <div class="payMode">
                    <div class="form-group col-lg-3">
                      <label for="payMode"> Pay Mode <font style="color: #ff1e1e;">*</font></label>
                      <select name="payMode" class="form-control col-lg-6 input-sm"  id="payMode"  onchange="checkPlan()" disabled="disabled" required="">
                          <option value=""> -- Select Pay Mode -- </option>
                          <option value="daily"> Daily </option>
                          <option value="monthly"> Monthly </option>
                          <option value="quarterly"> Quarterly </option>
                          <option value="halfyearly"> Half Yearly </option>
                          <option value="yearly"> Yearly </option>
                          
                      </select>
                    </div>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="installmentAmt">Installment Amount<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" id="installmentAmt" name="installmentAmt" onblur="checkPlan();" value="100" placeholder="Enter Installment Amount"  required="" onkeyup="installmentAmount()" >
                    </div>
                  </div>
                   <!--========Ajax come plan details start=========-->
                   <div class="box-body planDetails" style="margin-top: -20px;">
                       
                   </div> 
                   <!--========Ajax come plan details end=========-->
                  <div class="box-footer">
                      <input type="hidden" name="action" value="addCustomer">
                      <input type="hidden" name="registrationNo" value="<?php echo $registrationNo?>">
                      <input type="hidden" name="cutomerId" value="<?php echo $custId;?>">
                      <input type="hidden" name="srNo" value="<?php echo $srNo;?>">
                      <input type="hidden" name="token" value="<?php echo $_REQUEST['token'];?>" id="token">
                      <button type="submit" class="btn btn-primary submitBtn" name="submitButton" id="submit" disabled="">Submit</button>
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
  function installmentAmount(){
        var installmentAmount=document.getElementById('installmentAmt').value;
        if(parseInt(installmentAmount)>0 && installmentAmount!==''){
        document.getElementById('submit').disabled = false;
        document.getElementById('planId').disabled = false;
    }else{
        document.getElementById('submit').disabled = true;
        document.getElementById('planId').disabled = true;
       }
    }
 /*===============================Ajax Check Installment Ammount End===============================================*/          
  function checkPlan(){
            var planId=$("#planId").val();
            var payMode=$("#payMode").val();
            var token=$("#token").val();
            var installmentAmt=$("#installmentAmt").val();
            var dateOfJoining=$("#dateOfJoining").val();
            if(dateOfJoining===''){
                 alert("Please enter date of joining");
                 document.getElementById('submit').disabled = true;
            }else{
            $("#loader-gif").show();
            $.ajax({
               url:"ajaxPlanDetail.php",
               type: 'POST',
               data:{planId:planId,token:token,payMode:payMode,installmentAmt:installmentAmt,dateOfJoining:dateOfJoining},
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
        }
  </script>
  <!--=============================Javacript able and disabled field start=================================================================-->
  <script type="text/javascript">
        function planID(){
            var planIID = document.getElementById('planId').value;
            var token=document.getElementById('token').value;
            $("#loader-gif").show();
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
                   $("#loader-gif").hide();
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
