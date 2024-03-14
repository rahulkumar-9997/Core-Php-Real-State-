<?php
    session_start();
    if($_SESSION['token']===$_REQUEST['token'] && $_SESSION['uid']===$_SESSION['euid']){
        include'../../includes/timeout.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['title']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
    <script>
        function getMenu(id){
            //var pin = document.getElementById('region').value;
            //alert(id);
            var url = "ajax-get-menu.php?q="+id;
            //alert(url);
            $('#loading-image').show();
            $.ajax({
                url: url,
                cache: false,
                success:function(response){
                    //alert(response);
                    $("#assign").html(response);
                },
                complete: function(){
                    $('#loading-image').hide();
                  }
            });
        }
    </script>
    
    <style>
        .overlay {
            position: fixed; /* Sit on top of the page content */
            display: none; /* Hidden by default */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:rgba(255,255,0,.5) center center no-repeat; /* Black background with opacity */
            //opacity: 0.5;
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer; /* Add a pointer on hover */
        }
        .center {
            position: absolute;
            padding: 10px 0;
            top:38%;
            left: 50%;
            border: 0px solid green;
            text-align: center;
            z-index: 9999;
        }
    </style>
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
            <li class="active">Assign Menu</li>
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
              <h3 class="box-title"><i class="fa fa-user-plus"></i> Assign Menu</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="col-lg-4">
                    <h4 class="box-title"><i class="fa fa-user-plus"></i> Choose Role To Assign</h4>
                    <ul style="list-style: none;" class="list-link">
                        <?php 
                            include '../../model/authentication/roleClass.php';
                            $obj = new roleClass();
                            $method = $obj->fetchRole();

                            foreach ($method as $value) {
                               ?>
                                    <li><input type="radio" name="id" value="<?php echo $value['id']; ?>" onclick="getMenu(this.value)" /> <?php echo $value['role']; ?></li>
                               <?php
                            }       
                        ?>
                    </ul>
            </div>
                <div id="loading-image" class="col-lg-12 overlay"><div class="center"><img src="../../images/img/hanon-systems.gif" height="200"/></div></div>
                <div class="col-lg-8" id="assign" style="border-left: 1px solid #001f3f;">
                    
                </div>
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
