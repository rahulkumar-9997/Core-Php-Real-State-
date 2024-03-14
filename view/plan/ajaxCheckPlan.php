<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$id = $_REQUEST['q'];
$queryC = "SELECT plan_name FROM plan WHERE plan_name='{$id}' AND status=1";
$log->info("Check Plan Name query excuted as :: $queryC");
$result = $con->query($queryC);
$retRow = mysqli_num_rows($result);
if($retRow==1){
    $one=1;
    //echo '<p style="color:red;">'."Username already taken!".'</p>';
}
else{
    $one=0;
   // echo '<p style="color:green;">'."Username '<b>".$id."</b>' is available.".'</p>';
}
echo json_encode($one);