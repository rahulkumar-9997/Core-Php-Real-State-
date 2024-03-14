<?php
    session_start();
    if($_SESSION['token']==$_REQUEST['token']){
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['title'].": Change Password"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
    <script>
         function checkUserPass(){
             //alert("hi");
             var uId ='<?php echo  $_SESSION['uid'];?>';
            var uPass = document.getElementById('cPass').value;
            var url = "ajax-check-current-pass.php?" + "q="+ uPass + "&r=" + uId;
            //alert(url);
            $.ajax({
                url: url,
                cache: false,
                success:function(response){
                    //alert(response);
                    if(response==1){
                        //var pass=uPass.fontcolor("blue");
                       //var msg="Current Password " + pass.bold() + " matched";
                       //var result = msg.fontcolor("green");  
                       //document.getElementById('error').innerHTML=result;
                       $('#success').removeClass('hidden');
                       $('#error').addClass('hidden');
                       document.getElementById('submit').disabled = false;
                     //$("#error").html(response);
                 }
                 else{
                      //var pass=uPass.fontcolor("black");
                    //var msg="Current Password " + pass.bold() + " not matched";
          //var result = msg.fontcolor("red");  
          //document.getElementById('error').innerHTML=result; 
          $('#error').removeClass('hidden');
          $('#success').addClass('hidden');
          document.getElementById('submit').disabled = true;
        }
                    /* var sentence=.html(response);
if (sentence.indexOf("successfully")!=-1)
alert("Sam is in there!")*/
                   
                }
            });
        }
        </script>
        
        
        
    <script>
        function checkForm() {
            // Fetching values from all input fields and storing them in variables.
            var cpass = document.getElementById("cPass").value;
            var nPass = document.getElementById("newPass").value;
            var nPassA = document.getElementById("newPassA").value;
            //alert("hi");
            //Check input Fields Should not be blanks.
            if(cpass === ''){
                //alert("Enter the current password !");
                 document.getElementById('submit').disabled = true;
                document.getElementById('cPass').focus();
                return false;
            }
           /* else if(cpass !== ''){
                if(nPass !== nPassA){
                    alert("Password not matched !");
                    document.getElementById('newPassA').focus();
                    return false;
                }
            }*/
            else{
                return true;
            }

        }
    </script>
    <script>
     function disa(){
    //alert("hi");
        var newPass = $("#newPass").val();
        var newPassA = $("#newPassA").val();
       // var $statusMessage = $("#validate-status"),
        // var $submitButton = $('#submit');
         if(newPass == newPassA && newPassA !=='') {
            document.getElementById('submit').disabled = false;
          var msg="Password Matched";
          var result = msg.fontcolor("green");
          document.getElementById('validate-status').innerHTML=result;

        }
        else {
          document.getElementById('submit').disabled = true;
          var msg="Password Not Matched";
          var result = msg.fontcolor("red");
          document.getElementById('validate-status').innerHTML=result;
       }
     }
     </script>
    <script>
     
/*function validate(){
   
    alert("hi");
    return ($("#password1").val() === $("#password2").val());

  }*/
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
            <h1 class="text-blue"><i class="fa fa-user-plus"></i> Change Password</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change Password</li>
          </ol>
        </section>
        

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
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
          
          
          <div class="box">
            <div class="box-header">
                <?php //echo $_SESSION['uid'];?>
                
                <form autocomplete="off" role="form" id="form" class="form-horizontal" onsubmit="checkForm()" action="../../controller/authentication/roleController.php?token=<?php echo $_REQUEST['token']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="col-lg-12 center-block">
                        
                        <div class="form-group col-lg-7">
                            <label><i class="fa fa-hand-o-down"></i> Current Password &nbsp;</label>
                            <input type="password" class="form-control" maxlength="15" required="required" name="cPass" id="cPass" placeholder="Enter Current Password" onkeyup="checkUserPass()">
                        </div>&nbsp;
                        
                        <div class="col-lg-4 ">
                          <label for="username">&nbsp;</label>
                          <span class="help-block hidden" id="success"><i style="color: #1adcac" class="fa fa-check "></i></span>
                          <span class="help-block hidden" id="error"><i style="color: red" class="fa fa-remove"></i></span>
                      </div>
                         <div class="col-lg-4">
                          <label for="username">&nbsp;</label>
                          <span class="help-block hidden" id="error1"><i class="fa fa-remove"></i></span>
                      </div>
                        
                        <div class="form-group col-lg-7">
                            <label><i class="fa fa-hand-o-down"></i> New Password &nbsp;</label>
                            <input type="password" class="form-control" name="newPass" required="required" maxlength="15" id="newPass"  placeholder="Enter New Password should not greater than 15 characters" onkeyup="disa()">
                        </div>
                        
                            <div class="form-group col-lg-7">
                            <label><i class="fa fa-hand-o-down"></i>New Password Again &nbsp;</label>
                            <input type="password" class="form-control" name="newPassA" required="required" maxlength="15" id="newPassA" placeholder="Enter New Password Again should not greater than 15 characters" onkeyup="disa()">
                       </div>
                        <div class="col-lg-3">
                          <label for="username">&nbsp;</label>
                          <span class="help-block" id="validate-status"></span>
                      </div>
                            
                        
                         
                    </div>
                        <div class="form-group col-lg-12">
                            <div style="margin-top:24px;"></div>
                            <input type="hidden" name="action" value="changePass"/>
                            <button type="submit" id="submit" name="submit" class="btn btn-success col-lg-offset-5" ><span class="glyphicon glyphicon-flash"></span> Update </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-erase"></span> Reset</button>
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
      <script src="../../assets/customJS/autoGenRowSell.js"></script>
        <script>
            $('#form').submit(function() {
                if ($.trim($("#cPass").val()) === "" || $.trim($("#newPass").val()) === "" || $.trim($("#newPassA").val()) === "") {
                    alert('you did not fill out one of the fields');
                    return false;
                }
            });
            
            
            
            /* Remove Special characters*/
            $("#newPass").keypress(function(e) {
               $("#error_sp_msg").remove();
               var k 			= e.keyCode,
                               $return = ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32  || (k >= 48 && k <= 57));
             if(!$return) {
               $("<span/>",{
                       "id" : "error_sp_msg",
                 "html" 	: "Special characters not allowed !!!!!"
               }).insertAfter($(this));
               return false;
             }

           })
           
           $("#newPassA").keypress(function(e) {
               $("#error_sp_msg_again").remove();
               var k 			= e.keyCode,
                               $return = ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32  || (k >= 48 && k <= 57));
             if(!$return) {
               $("<span/>",{
                       "id" : "error_sp_msg_again",
                 "html" 	: "Special characters not allowed !!!!!"
               }).insertAfter($(this));
               return false;
             }

           })
        </script>
        
  </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

