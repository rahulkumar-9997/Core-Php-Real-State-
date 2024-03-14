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
    <title><?php echo $_SESSION['title'].": Edit Role"; ?></title>
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

                    //var ids = del_id.split("-");

                    //alert(ids[0]+"-"+ids[1]);

                    var c = confirm("Do you want to delete ?");

                    //alert(c);

                    if(c==true){

                        var url = "ajax-delete-role.php?id=";

                    }

                    else{

                         url = "";

                    }

                $.ajax({

                    url: url+del_id,

                    cache: false,

                    success:function(result){

                        tr.fadeOut(1000, function(){

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
            <li class="active">Role</li>
            <li class="active">Edit Role</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-plus"></i> Edit Role</h3>
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
         
                <form role="form" method="POST" action="../../controller/authentication/roleController.php?token=<?php echo $_REQUEST['token']; ?>">
                  <?php
                        include_once '../../controller/config/dbConnection.php'; 
                        $role = "SELECT * FROM f_user_role WHERE role_id='{$_REQUEST['id']}'";
                        $result = $con->query($role);
                        while ($row = mysqli_fetch_array($result)) {
                            $name = $row['role_name'];
                            $desc = $row['role_description'];
                        }
                  ?>
                  <input type="hidden" name="id" id="roleid" value="<?php echo $_REQUEST['id']; ?>"/>
                  <input type="hidden" name="action" id="action" value="update"/>
                  <div class="box-body">
                    <div class="form-group col-lg-6">
                      <label for="role">Role Title</label>
                      <input type="text" class="form-control" name="role" id="role" value="<?php echo "$name"; ?>" placeholder="Enter Role Title">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="description">Description</label>
                      <input type="text" class="form-control" name="description" id="description" value="<?php echo "$desc"; ?>" placeholder="Enter Role Description">
                    </div>
                      <div class="box-footer col-lg-12 center-block">
                        <button type="submit" class="btn btn-primary btn-sm center-block">Update</button>
                      </div>
                  </div><!-- /.box-body -->
                </form>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Role</th>
                        <th>Description</th>
                        <th>Added date</th>
                        <th>Added by</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            //include '../../logger/incLog.php';
                            include '../../model/authentication/roleClass.php';
                            $roleObj = new roleClass();
                            $role = $roleObj->fetchRole();
                            //print_r($role);
                            $i=0;
                            foreach ($role as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $value['role']; ?></td>
                                    <td><?php echo $value['desc']; ?></td>
                                    <td><?php echo $value['date']; ?></td>
                                    <td><?php echo $value['by']; ?></td>
                                    <td>
                                        <a href="../../view/user/editRole.php?id=<?php echo $value['id']; ?>&token=<?php echo $_REQUEST['token']; ?>"><button class="btn btn-info btnEdit btn-xs" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button></a>
                                        <a href="#" class="delete" id="<?php echo $value['id'];?>"><button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="confirmation()"><i class="glyphicon glyphicon-trash"></i></button></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    
                  </table>
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
