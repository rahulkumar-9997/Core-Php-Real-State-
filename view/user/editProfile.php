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
    <title><?php echo $_SESSION['title'].": Edit User Profile"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
    <script>
        function confirmPass(){
            var pass1 = document.getElementById('password').value;
            var pass2 = document.getElementById('passwordC').value;
            if(pass1!==pass2){
                alert("Password did'nt matched. Type same password in both input!");
                document.getElementById('passwordC').focus();
                return false;
            }
        }
        function disableField(){
            var role = document.getElementById("role").value;
            document.getElementById('region').disabled=false;
            document.getElementById('country').disabled=false;
            document.getElementById('plant').disabled=false;
            //alert(role);
            if(role=='ROL001'){
                document.getElementById('region').innerHTML='';
                document.getElementById('country').innerHTML='';
                document.getElementById('plant').innerHTML='';
                document.getElementById('region').disabled=true;
                document.getElementById('country').disabled=true;
                document.getElementById('plant').disabled=true;
            }
            else{
                var url = "ajax-get-region.php";
                //alert(url);
                $.ajax({
                    url: url,
                    cache: false,
                    success:function(response){
                        //alert(response);
                        $("#region").html(response);
                    }
                });
            }
        }
    </script>
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
            <li class="active">Users</li>
            <li class="active">Edit Profile</li>
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
              <h3 class="box-title"><i class="fa fa-user-plus"></i> Edit Profile</h3>
            <?php 
                include_once '../../controller/config/dbConnection.php';
                $query = "SELECT * FROM f_user_detail as ud, f_user_credential as uc WHERE uc.user_id=ud.user_id AND uc.user_id='{$_REQUEST['id']}'";
                $result = $con->query($query);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $userId = $row['user_id'];
                    $userName = $row['name'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $country = $row['country'];
                    $state = $row['state'];
                    $district = $row['district'];
                    $post = $row['post'];
                    $address = $row['address'];
                    $roleId = $row['role'];
                    $branchId=$row['branch_id'];
                    $designation = $row['designation'];
                    if($id=='ROL001'){
                        $disable = 'disabled="disabled"';
                    }
                    else{
                        $disable = '';
                    }
                }
            ?>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="../../controller/authentication/roleController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST">
                  <input type="hidden" name="action" id="action" value="updateUser"/>
                  <input type="hidden" name="uid" id="uid" value="<?php echo $userId; ?>"/>
                  <div class="box-body">
                    <div class="form-group col-lg-3">
                      <label for="name">User Id<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="username" disabled="disabled" id="username" value="<?php echo $userId; ?>" placeholder="Enter full name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="name">Name<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="name" id="name" value="<?php echo $userName;?>" placeholder="Enter full name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="email">Email<font style="color: #ff1e1e;">*</font></label>
                      <input type="email" class="form-control input-sm" name="email" id="email" value="<?php echo $email;?>" placeholder="Enter email" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="country">Country<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="country" value="<?php echo $country;?>" placeholder="Enter Country Name" required="">
                    </div>  
                    <div class="form-group col-lg-3">
                      <label for="state">State<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="state" value="<?php echo $state;?>" placeholder="Enter State Name" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="district">District<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="district" value="<?php echo $district;?>" placeholder="Enter District Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="postOffice">Post Office<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="postOffice" value="<?php echo $post;?>"  placeholder="Enter Post Office Name" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="contact">Contact No.<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="contact" id="contact" value="<?php echo $contact;?>" maxlength="10" required="" placeholder="Enter 10 digit mobile number">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="address">Address<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="address" value="<?php echo $address;?>" placeholder="Enter Post Office Name" required="">
                    </div>   
                    <div class="form-group col-lg-3">
                      <label for="designation">Designation <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="designation" value="<?php echo $designation;?>" id="designation" placeholder="Enter designation" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="role"> Assign Role <font style="color: #ff1e1e;">*</font></label>
                      <select name="role" class="form-control col-lg-6" id="role" required="required" onchange="disableField()">
                          <?php
                                include '../../model/authentication/roleClass.php';
                                $rObj = new roleClass();
                                $roles = $rObj->fetchRole();
                                foreach ($roles as $key => $val) {
                                    if($roleId==$val['id']){
                                    ?>
                                        <option selected="selected" value="<?php echo $val['id']; ?>"><?php echo $val['role']; ?></option>
                                    <?php
                                    }
                                    else{
                                        ?>
                                            <option value="<?php echo $val['id']; ?>"><?php echo $val['role']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                      </select>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="branch"> Branch <font style="color: #ff1e1e;">*</font></label>
                      <select name="branchId" class="form-control col-lg-6 input-sm"  required="required">
                          <option value="">Select Branch</option>
                          <?php
                            $queryB = "SELECT * FROM branch WHERE status=1";
                            $resultB = $con->query($queryB);
                            while ($rowB = mysqli_fetch_array($resultB)) {
                                ?>
                                <option <?php if($branchId==$rowB['branch_id']){?> selected <?php } ?> value="<?php echo $rowB['branch_id']; ?>"><?php echo $rowB['branch_name']; ?></option>
                            <?php
                            }
                          ?>
                      </select>
                    </div>  
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <a href="allUsers.php?token=<?php echo $_REQUEST['token'];?>" class="text-bold">Back</a>
                      <button type="submit" class="btn btn-primary pull-right" id="submit">Update</button>
                  </div>
                </form>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php require_once '../../includes/bottom.php'; ?>
      
    <?php require_once '../../includes/footer_includes.php'; ?>

      <script>
          function confirmPass(){
            var pass1 = document.getElementById('password').value;
            var pass2 = document.getElementById('passwordC').value;
            if(pass1!==pass2){
                document.getElementById('status').innerHTML="<i class='fa fa-close text-danger'></i>";
                document.getElementById('submit').disabled = true;
                return false;
            }
            if(pass1===pass2){
                document.getElementById('status').innerHTML="<i class='fa fa-check text-green'></i>";
                document.getElementById('submit').disabled = false;
                return true;
            }
        }
      </script>
      <script>
          $(document).ready(function(){
            //alert("hi");
            var role = document.getElementById("role").value;
            //alert(role);
            if(role=='ROL001'){
                document.getElementById('region').innerHTML='';
                document.getElementById('country').innerHTML='';
                document.getElementById('plant').innerHTML='';
                document.getElementById('region').disabled=true;
                document.getElementById('country').disabled=true;
                document.getElementById('plant').disabled=true;
            }
        })
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