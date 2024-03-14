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
<style>
    tr.spaceUnder>td {
     padding-bottom: 1em;
   }
</style>
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
            <li class="active">Add Expense</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-plus"></i> Add Expense</h3><span style="color: #ff1e1e;"> * Field Required</span> <a href="expenseList.php?token=<?php echo $_REQUEST['token'];?>" title="Expense List">Expense List</a>
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
                <form role="form" action="../../controller/expense/expenseController.php?token=<?php echo $_REQUEST['token']; ?>" method="post" enctype="multupart/form-data">
                    <table class="expenseTable">
                        <tr>
                            <th><input id="check_all" type="checkbox"/></th>
                            <th>Expense Name <font style="color: #ff1e1e;">*</font></th>
                            <th>Expense Date <font style="color: #ff1e1e;">*</font></th>
                            <th>Expense Amount  <font style="color: #ff1e1e;">*</font></th>
                            <th>Expense Description <font style="color: #ff1e1e;">*</font></th>
                        </tr>
                        <tr class="spaceUnder">
                            <td style="width: 1%;"><!--<input class="case" type="checkbox"/>--></td>
                            <td style="width: 15%; padding-right: 10px;"><input type="text" class="form-control" required="true" id="expName_1" name="expenseName[]" placeholder="Enter Expense Name"></td>
                            <td style="width: 15%; padding-right: 10px;"><input type="text" class="form-control datepicker" required="true" id="expDate_1" name="expDate[]" placeholder="Enter Expense Date"></td>
                            <td style="width: 15%; padding-right: 10px;"><input type="number" class="form-control" required="true" id="expAmt_1"  name="expAmt[]" placeholder="Enter Expense Amount"></td>
                            <td style="width: 20%;"><textarea type="text" class="form-control" required="true" id="expDesc_1" name="expDesc[]" placeholder="Enter Expense Description"></textarea></td>
                        </tr>
                    </table>
                   <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <button class="btn btn-danger delCF btn-xs" type="button">- Remove Item</button>
                        <button class="btn btn-success addCF btn-xs" type="button">+ More Item</button>
                   </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <input type="hidden" name="action" value="addExpense"/>
                        <button type="submit" class="btn btn-success"> Submit</button>
                        <button type="reset" class="btn btn-danger"> Reset</button>
                    </div>
                    
                </form>
            </div>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php require_once '../../includes/bottom.php'; ?>
    <?php require_once '../../includes/footer_includes.php'; ?>
      <script src="../../assets/autoGenRow/autoGenRowExpense.js"></script> 
    <?php 
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
    ?>
  </body>
</html>
