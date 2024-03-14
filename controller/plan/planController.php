<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
include '../../logger/incLog.php';
include '../../model/institutebl/commoncls.php';
$token = md5(rand(1000, 9999));
$_SESSION['token'] = $token;
$log->info('Arrived at Plan Controller');
if($_REQUEST['action']){
  $act = $_REQUEST['action'];  
}else{
$act = $_POST['action'];
}
switch ($act) {
    case'addPlan':
        $planName=$_POST['planName'];
        $planDuration=$_POST['planDuration'];
        $interestRate=$_POST['interestRate'];
        $comission=$_POST['comission'];
        $planType=$_POST['planType'];
        $date=date('Y-m-d');
        $objc = new commoncls();
        $insertPlan="INSERT INTO plan (
                                        plan_name
                                       ,duration_month
                                       ,commission_in_per
                                       ,plan_type
                                       ,interest_rate_in_per
                                       ,branch_id
                                       ,c_date
                                       ,c_by
                                       ,status
                                     ) VALUES (
                                        '{$planName}' -- plan_name - IN varchar(20)
                                       ,'{$planDuration}' -- duration_month - IN varchar(200)
                                       ,'{$comission}' -- commission_in_per - IN varchar(250)
                                       ,'{$planType}' -- plan_type - IN varchar(200)
                                       ,'{$interestRate}' -- interest_rate_in_per - IN varchar(20)
                                       ,'{$_SESSION['branch_id']}' -- branch_id - IN varchar(100)
                                       ,'{$date}' -- c_date - IN varchar(20)
                                       ,'{$_SESSION['uid']}' -- c_by - IN varchar(250)
                                       ,1 -- status - IN int(10)
                                     )";
        $log->info("Add Plan : $insertPlan");
        $callMethod = $objc->create($insertPlan);
        if($callMethod){
            $msg = "Plan $planName created successfully";
            $setUrl = "../../view/plan/addPlan.php?info=$msg&token=$token";
            }else{
            $msg = "Plan $planName not created try again !";
            $setUrl = "../../view/plan/addPlan.php?info=$msg&token=$token";
        }                               
        break;
    case 'editPlan':
        $planName=$_POST['planName'];
        $planDuration=$_POST['planDuration'];
        $interestRate=$_POST['interestRate'];
        $comission=$_POST['comission'];
        $planType=$_POST['planType'];
        $planId=$_POST['planId'];
        $date=date('Y-m-d');
        $objc = new commoncls();
        $editPlan="UPDATE plan SET
                                plan_name = '{$planName}' -- varchar(20)
                               ,duration_month = '{$planDuration}' -- varchar(200)
                               ,commission_in_per = '{$comission}' -- varchar(250)
                               ,plan_type = '{$planType}' -- varchar(200)
                               ,interest_rate_in_per = '{$interestRate}' -- varchar(20)
                             WHERE plan_id = '{$planId}' -- int(11)";
        $log->info("Edit Plan : $editPlan");
        $callMethod = $objc->create($editPlan);
        if($callMethod){
            $msg = "Plan $planName updated successfully";
            $setUrl = "../../view/plan/editPlan.php?info=$msg&token=$token&id=$planId";
            }else{
            $msg = "Plan $planName not updated try again !";
            $setUrl = "../../view/plan/editPlan.php?info=$msg&token=$token&id=$planId";
        }                             
        
        break;
    
    default:
        $msg = "Something went wrong !";
        $setUrl = "../../view/dashboard/dashboard.php?info=$msg&token=$token";
        break;
}
if ($_REQUEST['a'] == 'logout') {
    $msg = "logout successfully.";
    $setUrl = "../../index.php?info=$msg";
}
$log->debug("URL set as : $setUrl");
header("Location:$setUrl");
ob_end_flush();

