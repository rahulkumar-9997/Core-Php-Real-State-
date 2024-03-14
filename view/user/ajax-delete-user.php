<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$id = $_REQUEST['id'];
$status = $_REQUEST['sts'];
$queryDel = "DELETE FROM f_user_credential WHERE user_id='{$id}'";
$queryDel1 = "DELETE FROM f_user_detail WHERE user_id='{$id}'";
$log->info("Delete query excuted as :: $queryDel");
$result = $con->query($queryDel);
$result1 = $con->query($queryDel1);