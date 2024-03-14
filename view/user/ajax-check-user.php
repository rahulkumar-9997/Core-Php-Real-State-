<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$id = $_REQUEST['q'];
$queryC = "SELECT * FROM f_user_credential WHERE user_id='{$id}'";
$log->info("Delete query excuted as :: $queryC");
$result = $con->query($queryC);
$retRow = mysqli_num_rows($result);
if($retRow){
    echo '<p style="color:red;">'."Username already taken!".'</p>';
}
else{
    echo '<p style="color:green;">'."Username '<b>".$id."</b>' is available.".'</p>';
}