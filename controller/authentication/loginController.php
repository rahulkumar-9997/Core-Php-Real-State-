<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
include '../../logger/incLog.php';
include '../../model/authentication/userAuthentication.php';
//unset($_SESSION['token']);
$token = md5(rand(1000, 9999));
$_SESSION['token']= $token;
//$_SESSION['token']= $token;
$log->info('Arrived at loginController');
$userName = $_POST['userId'];
$captcha = $_POST['captcha'];
$password = sha1($_POST['password']);
if($_REQUEST['captcha']==123456){
$authObj = new userAuthentication();
$callMethod = $authObj->userVerification($userName, $password);
$log->info("call method variable $callMethod");
    
    if($callMethod == 1){
        $log->info("$setUrl");
        $setUrl = "../../view/dashboard/dashboard.php?token=$token";
    }
    else{
        $msg = "Authentication Failed";
        $log->info("$setUrl");
        $setUrl = "../../index.php?info=$msg";
    }
   
}
else{
    $msg = "Captcha did not matched !";
    $setUrl = "../../index.php?info=$msg";
}

if($_REQUEST['a']=='logout'){
       $msg = "logout successfully.";
       $setUrl = "../../index.php?info=$msg";
   }
$log->debug("URL set as : $setUrl");
header("Location:$setUrl");
ob_end_flush();
