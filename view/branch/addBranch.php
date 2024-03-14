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
            <li class="active">Users</li>
            <li class="active">Add Branch</li>
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
            $selectLastId = "select branch_id from branch ORDER BY id DESC limit 1";
            $result = $con->query($selectLastId);
            $id="";
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['branch_id'];
            }
            if(empty($id)){
                $id = "BRC000";
            }
            $newAr = explode(" ", $id);
            //print_r($newAr);
            $pad_length = 3;
            $pad_lengthi = 3;
            $fId = substr($newAr[0], 3);
           // echo $fId;
            $iId = $fId+1;
            //$iId = $newAr[2]+1;
            //print_r($newAr[0]);
            //echo $iId;
            //$log->info("Id fetched : $fId");
            $nId = $fId;
            //$log->info("New id generated : $nId");
            $id = 'BRC'.str_pad($iId, $pad_lengthi, "0", STR_PAD_LEFT);
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Add Branch </h3><span style="color: #ff1e1e;"> * Field Required</span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="../../controller/branch/branchController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST">
                  <input type="hidden" name="action" id="action" value="addUser"/>
                  <input type="hidden" name="branchId" value="<?php echo $id;?>"/>
                  <div class="box-body">
                    <div class="form-group col-lg-3">
                      <label for="branchName">Branch Name <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="branchName"  placeholder="Enter Branch Name" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="branchCode">Branch Code (Short Key)<font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="branchCode" maxlength="3" placeholder="Enter Branch Code" required="">
                    </div>  
                    <div class="form-group col-lg-3">
                      <label for="country">Country <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" value="India" name="country" placeholder="Enter Country" required="">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="state">State <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" value="Uttar Pradesh" name="state" placeholder="Enter State" required="">
                    </div> 
                    <div class="form-group col-lg-3">
                      <label for="district">District <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="district" placeholder="Enter District" required="">
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
                      <label for="address">Address <font style="color: #ff1e1e;">*</font></label>
                      <input type="text" class="form-control input-sm" name="address" placeholder="Enter Full Address" required="">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <input type="hidden" name="action" value="addBranch">
                      <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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
