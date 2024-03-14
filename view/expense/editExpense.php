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
    <title><?php echo $_SESSION['title'].": Add Expense"; ?></title>
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
            <li class="active">Expense</li>
            <li class="active">Expense List</li>
            <li class="active">Edit Expense</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Edit Expense</h3><span style="color: #ff1e1e;"> * Field Required</span> <a href="expenseList.php?token=<?php echo $_REQUEST['token'];?>" title="Expense List">Expense List</a>
            </div><!-- /.box-header -->
            <div class="box-body" style="margin-top: 0px;">
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
                $selectExpense="SELECT expense_id, expense_name, description, expense_amount, expense_date FROM expense WHERE expense_id='{$_REQUEST['expId']}' AND id='{$_REQUEST['id']}'";
                $resultExp=$con->query($selectExpense);
                while ($expRow = mysqli_fetch_array($resultExp)) {
                       $expName=$expRow['expense_name'];
                       $description=$expRow['description'];
                       $expenseAmount=$expRow['expense_amount'];
                       $expenseDate=$expRow['expense_date'];
                }
                ?>
                <form role="form" action="../../controller/expense/expenseController.php?token=<?php echo $_REQUEST['token']; ?>" method="post" enctype="multupart/form-data">
                    <div class="form-group row">
                      <label for="expenseName" class="col-sm-2 form-control-label">Expense Name</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" required="true" value="<?php echo $expName;?>" name="expenseName" placeholder="Enter Expense Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="expDesc" class="col-sm-2 form-control-label">Expense Description</label>
                      <div class="col-sm-6">
                          <textarea type="text" class="form-control" required="true"  name="expDesc" placeholder="Enter Expense Description"><?php echo $description;?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="expDate" class="col-sm-2 form-control-label">Expense Date</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control datepicker" required="true" value="<?php echo $expenseDate;?>" name="expDate" placeholder="Enter Expense Date">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="expAmt" class="col-sm-2 form-control-label">Expense Amount <i class="fa fa-rupee"></i></label>
                      <div class="col-sm-4">
                          <input type="number" class="form-control" required="true" value="<?php echo $expenseAmount;?>"  name="expAmt" placeholder="Enter Expense Amount">
                      </div>
                    </div>
                    <div class="col-sm-6 center-block">
                        <input type="hidden" name="expId" value="<?php echo $_REQUEST['expId'];?>"/>
                        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>"/>
                        <input type="hidden" name="action" value="UpdateExpense"/>
                        <button type="submit" class="btn btn-success col-sm-offset-3">Update</button>
                        <button type="reset" class="btn btn-danger"> Reset</button>
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
