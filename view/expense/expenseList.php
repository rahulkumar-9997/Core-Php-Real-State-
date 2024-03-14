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
    <title><?php echo $_SESSION['title'].": Expense List"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
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
          /*echo $_SESSION['role'];*/
          if($_SESSION['role']=='ROL001'){
          ?>
          <!--================================IF user admin than show ===================================-->
          <div class="box box-info SeaechAgentList">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Expense Date</th>
                        <th>Expense Name</th>
                        <th>Expense Description</th>
                        <th>Expense Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "SELECT id, expense_id, expense_name, description, expense_amount, expense_date FROM expense WHERE status=1 ORDER BY id DESC";
                            $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['expense_date'])); ?></td>
                                        <td><?php echo strtoupper($row['expense_name']); ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row['expense_amount']; ?></td>
                                        <td>
                                            <a href="editExpense.php?token=<?php echo $_REQUEST['token']; ?>&expId=<?php echo $row['expense_id']; ?>&id=<?php echo $row['id']?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                            <a href="../../controller/expense/expenseController.php?token=<?php echo $_REQUEST['token'];?>&action=deleteExp&expId=<?php echo $row['expense_id'];?>&id=<?php echo $row['id']?>" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="return confirm('Do you want to remove this item ?');"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--================================IF user admin than show end ===================================-->
              <?php
               }else{
                ?>
              <!--================================IF user other than admin than show ===================================-->
                <div class="box box-info SeaechAgentList">
                 <div class="box-body">
                     <table id="example1" class="table table-bordered table-striped">
                         <thead>
                           <tr>
                                <th>S No</th>
                                <th>Expense Date</th>
                                <th>Expense Name</th>
                                <th>Expense Description</th>
                                <th>Expense Amount</th>
                                <th>Action</th>
                           </tr>
                         </thead>
                         <tbody>
                             <?php
                                 $s=1;
                                 include '../../controller/config/dbConnection.php';
                                 $query = "SELECT id, expense_id, expense_name, description, expense_amount, expense_date FROM expense WHERE status=1 AND branch_id='{$_SESSION['branch_id']}' ORDER BY id DESC";
                                 $result = $con->query($query);
                                 while ($row = mysqli_fetch_array($result)) {
                                     ?>
                                        <tr>
                                            <td><?php echo $s; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row['expense_date'])); ?></td>
                                            <td><?php echo strtoupper($row['expense_name']); ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><i class="fa fa-rupee"></i> <?php echo $row['expense_amount']; ?></td>
                                            <td>
                                                <a href="editExpense.php?token=<?php echo $_REQUEST['token']; ?>&expId=<?php echo $row['expense_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="../../controller/expense/expenseController.php?token=<?php echo $_REQUEST['token'];?>&action=deleteExp&expId=<?php echo $row['expense_id'];?>&id=<?php echo $row['id']?>" class="btn btn-danger btn-xs deldp" onclick="return confirm('Are you sure you want to Remove?');" data-toggle="tooltip" title="Delete"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                     <?php
                                     $s++;
                                 }
                             ?>
                         </tbody>
                       </table>
                     </div>
                   </div>
                  <!--================================IF user other than admin than show end===================================-->
                
                <?php
               }
              ?>
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->

        <?php require_once '../../includes/bottom.php'; ?>
        <?php require_once '../../includes/footer_includes.php'; ?>
        <script>
            $(document).on('click', '.deldp', function(){
                var tr = $(this).closest('tr'),
                    del_id = $(this).attr('id');
                    idArr = del_id.split('-');
                    if(idArr[1]=='dl'){
                        var c = confirm("Do you want to delete this agent?");
                        if(c==true){
                            var url = "ajaxDeleteAgent.php?id=";
                            stts=0;
                        }else{
                             url = "";
                        }
                    }
                $.ajax({
                    url: url+idArr[0]+"&sts="+stts,
                    cache: false,
                    success:function(result){
                        tr.fadeOut(300, function(){
                            $(this).remove();
                        });
                    }
                });
            });
            /*search*/
              /*Search */
      $(document).on('change', '.branch', function(){
            var branchId=$("#branchId").val();
            var token=$("#token").val();
            $("#loader-gif").show();
            $.ajax({
               url:"ajaxSearchAgent.php",
               type: 'POST',
               data:{branchId:branchId,token:token},
               beforeSend: function () {
                        $('.sidebar-mini').css("opacity", ".5");
                    },
               success:function(data){
                   $('.SeaechAgentList').html(data);
                   $("#loader-gif").hide();
                   $('.sidebar-mini').css("opacity", "");
                   //alert(data);
               }
            });
       });
       /*Search */
            /*search*/
        </script>
    </body>
</html>
    <?php
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
?>



