<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kashi India Developers LTD. | Password Recovery</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../assets/plugins/iCheck/square/blue.css">
    <link rel="icon" href="../../images/logo/logo.jpg" class="img-circle" type="image/png">
    <script>
        function check(){
            var pass = document.getElementById('pass').value;
            var cpass = document.getElementById('cpass').value;
            if(pass!==cpass){
                alert('Password not matched! Try again.');
                document.getElementById('btn').disabled=true;
            }
            else{
                document.getElementById('btn').disabled=false;
            }
        }
    </script>
  </head>
  <body class="hold-transition login-page bg">
    <div class="login-box">
        <div class="login-logo" style="font-size: 22px;">
            <a href="./"><img src="../../images/logo/logo.png" /></a>
      </div><!-- /.login-logo -->
      <div class="box box-danger direct-chat direct-chat-warning">
      <div class="box-header with-border">
            <h3 class="box-title text-danger">Enter New Password</h3>
            <div class="box-tools pull-right"> 
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-lock text-bold text-danger"></i></button>
            </div>
      </div><!-- /.box-header -->
      <div class="login-box-body" style="margin-top: -30px;">
        <p class="login-box-msg">
            <?php 
                if(!empty($_REQUEST['info'])){
                    if(strpos($_REQUEST['info'], 'success') !== FALSE){
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
        </p>
        <form action="recoveryController.php" method="post">
          <div class="form-group has-feedback">
              <input type="password" name="pass" id="pass" required="required" class="form-control" placeholder="Enter new password">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" name="cpass" id="cpass" required="required" class="form-control" placeholder="Confirm password" onblur="check()">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
                <button type="submit" name="submit" id="btn" disabled class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
      <div class="box box-danger direct-chat direct-chat-warning"></div>
      </div>
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      $('#refresh').click(function(){
            $("#captchaImg").attr("src", "captcha.php?"+(new Date()).getTime());
        });
    </script>
  </body>
</html>
