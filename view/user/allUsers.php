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
    <title><?php echo $_SESSION['title'].": All Users"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
    <script>
        function confirmation(){
            $('.delete').click(function(){
                var tr = $(this).closest('tr'),
                    del_id = $(this).attr('id');
                    //alert(del_id);
                    var ids = del_id.split("-");
                    //alert(ids[0]+"-"+ids[1]);
                    var c = confirm("Do you want to delete ?");
                    //alert(c);
                    if(c==true){
                        var url = "ajax-delete-user.php?id=";
                    }
                    else{
                         url = "";
                    }
                $.ajax({
                    url: url+ids[0]+"&sts="+ids[1],
                    cache: false,
                    success:function(result){
                        tr.fadeOut(500, function(){
                            $(this).remove();
                        });
                    }
                });
            });
    }
    </script>
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
            <li class="active">Users</li>
            <li class="active">All Users</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-list"></i> List Of All Users</h3>
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>User Id</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Added date</th>
                        <th>Added by</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "../../model/authentication/roleClass.php";
                            $roleObj = new roleClass();
                            $users = $roleObj->fetchUser($_SESSION['role'], '');
                            $i=0;
                            foreach ($users as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $value['id']; ?></td>
                                    <td>
                                        <?php
                                            $queryRole = "SELECT * FROM f_user_role WHERE role_id='{$value['role']}'";
                                            $resultRole = $con->query($queryRole);
                                            while ($row = mysqli_fetch_array($resultRole)) {
                                                echo $row['role_name'];
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['date']; ?></td>
                                    <td><?php echo $value['by']; ?></td>
                                    <td>
                                        <?php
                                            if($value['id']=='admin'){
                                                ?>
                                                    <a href="#"><button class="btn btn-info btnEdit btn-xs disabled" data-toggle="modal"><i class="glyphicon glyphicon-pencil"></i></button></a>
                                                    <a href="#"><button class="btn btn-danger btnDelete btn-xs disabled" data-toggle="modal"><i class="glyphicon glyphicon-trash"></i></button></a>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <a href="../../view/user/editProfile.php?id=<?php echo $value['id']; ?>&token=<?php echo $_REQUEST['token']; ?>"><button class="btn btn-info btnEdit btn-xs" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button></a>
                                                    <a href="#" class="delete" id="<?php echo $value['id']."-0";?>"><button data-toggle="tooltip" title="Delete" class="btn btn-danger btnDelete btn-xs" onclick="confirmation()"><i class="glyphicon glyphicon-trash"></i></button></a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
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
    </body>
</html>
    <?php
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
?>



