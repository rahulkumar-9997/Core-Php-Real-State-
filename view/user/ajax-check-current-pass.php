<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$userId = ($_REQUEST['r']);
$password = sha1($_REQUEST['q']);
$queryC = "SELECT * FROM f_user_credential WHERE user_id='{$userId}' AND password='{$password}'";
//echo $queryC;
$log->info("Delete query excuted as :: $queryC");
$result = $con->query($queryC);
$retRow = mysqli_num_rows($result);
if($retRow){
    $one=1;
    //echo "'Current Password '".$_REQUEST['q']."' is matched successfully"."";
}
else{
    $one=0;
    //echo "Current Password '".$_REQUEST['q']."' is not matched.".'';
}
echo json_encode($one);