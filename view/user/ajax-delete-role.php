<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$id = $_REQUEST['id'];
//$status = $_REQUEST['sts'];
$queryDel = "DELETE FROM f_user_role WHERE role_id='{$id}'";
$log->info("Delete query excuted as :: $queryDel");
$result = $con->query($queryDel);