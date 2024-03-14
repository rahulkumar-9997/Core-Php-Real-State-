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
$queryDeldrp = "UPDATE plan SET status='{$status}' WHERE plan_id='{$id}'";
$log->info("Deldrp query excuted as :: $queryDeldrp");
$result = $con->query($queryDeldrp);