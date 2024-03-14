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
$queryDeldrp = "UPDATE customer SET status='{$status}' WHERE customer_id='{$id}'";
$log->info("Deldrp query excuted as :: $queryDeldrp");
$result = $con->query($queryDeldrp);

$updateCuPlanMap="UPDATE customer_plan_mapping SET status='{$status}' WHERE customer_id='{$id}'";
$log->info("Deldrp query excuted as :: $updateCuPlanMap");
$result1 = $con->query($updateCuPlanMap);

$updateCuInsHis="UPDATE customer_installment_history SET status='{$status}' WHERE customer_id='{$id}'";
$log->info("Deldrp query excuted as :: $updateCuInsHis");
$result2 = $con->query($updateCuInsHis);

$updateAgentCoHis="UPDATE agent_commission_history SET status='{$status}' WHERE customer_id='{$id}'";
$log->info("Deldrp query excuted as :: $updateAgentCoHis");
$result3 = $con->query($updateAgentCoHis);
