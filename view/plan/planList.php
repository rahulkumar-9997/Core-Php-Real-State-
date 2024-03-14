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
    <title><?php echo $_SESSION['title'].": All Plan List"; ?></title>
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
            <li class="active">Manage Plan</li>
            <li class="active">Plan List</li>
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
              <h3 class="box-title"><i class="fa fa-user-list"></i> List Of All Plan</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Create Date</th>
                        <th>Plan Name.</th>
                        <th>Plan Duration In Month</th>
                        <th>Interest Rate</th>
                        <th>Plan Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "SELECT plan_name, plan_id, duration_month, commission_in_per, plan_type, interest_rate_in_per, branch_id, c_date FROM plan WHERE status=1";
                            $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td><?php echo "".date("l M,dS Y",strtotime($row['c_date']))?></td>
                                        <td><?php echo strtoupper($row['plan_name']); ?></td>
                                        <td><?php echo $row['duration_month']; ?> Month</td>
                                        <td><?php echo $row['interest_rate_in_per']; ?> %</td>
                                        <td><?php echo $row['plan_type']; ?></td>
                                        <?php
                                            if($_SESSION['role']=='ROL001'){
                                           ?>
                                        <td>
                                            <a href="editPlan.php?token=<?php echo $_REQUEST['token']; ?>&id=<?php echo $row['plan_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                            <a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['plan_id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                        <?php
                                            }else {
                                             ?>
                                            <td>
                                                <a href="editPlan.php?token=<?php echo $_REQUEST['token']; ?>&id=<?php echo $row['plan_id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['plan_id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>
                                            </td>
                                            <?php
                                            }
                                        ?>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
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
                        var c = confirm("Do you want to delete this Plan?");
                        if(c==true){
                            var url = "ajaxDeletePlan.php?id=";
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



