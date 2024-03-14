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
$log->info('Arrived at Branch Controller');
if($_REQUEST['action']){
  $act = $_REQUEST['action'];  
}else{
$act = $_POST['action'];
}
switch ($act) {
    case'addBranch':
        $branchId=$_POST['branchId'];
        $branchCode=strtoupper($_POST['branchCode']);
        $branchName=$_POST['branchName'];
        $country=$_POST['country'];
        $state=$_POST['state'];
        $district=$_POST['district'];
        $pinCode=$_POST['pinCode'];
        $contactNo=$_POST['contactNo'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $date=date('Y-m-d');
        $objc = new commoncls();
        $insertBranch="INSERT INTO branch (
                                            branch_id
                                           ,branch_code
                                           ,branch_name
                                           ,country
                                           ,state
                                           ,district
                                           ,pin_code
                                           ,mobile_no
                                           ,email
                                           ,address
                                           ,date
                                           ,c_by
                                         ) VALUES (
                                            '{$branchId}' -- branch_id - IN varchar(200)
                                           ,'{$branchCode}' -- branch_id - IN varchar(200)
                                           ,'{$branchName}' -- branch_name - IN varchar(200)
                                           ,'{$country}' -- country - IN varchar(200)
                                           ,'{$state}' -- state - IN varchar(100)
                                           ,'{$district}' -- district - IN varchar(100)
                                           ,'{$pinCode}' -- pin_code - IN varchar(10)
                                           ,'{$contactNo}' -- mobile_no - IN varchar(20)
                                           ,'{$email}'  -- email - IN varchar(50)
                                           ,'{$address}' -- address - IN text
                                           ,'{$date}'  -- date   
                                           ,'{$_SESSION['uid']}'  -- c_by   
                                         )";
        $log->info("Add Branch : $insertBranch");
        $callMethod = $objc->create($insertBranch);
        if($callMethod){
            $msg = "Branch $branchName created successfully";
            $setUrl = "../../view/branch/addBranch.php?info=$msg&token=$token";
            }else{
            $msg = "Branch $branchName not created try again !";
            $setUrl = "../../view/branch/addBranch.php?info=$msg&token=$token";
        }                               
        break;
    case 'editBranch':
        $branchCode=$_POST['branchCode'];
        $branchName=$_POST['branchName'];
        $country=$_POST['country'];
        $state=$_POST['state'];
        $district=$_POST['district'];
        $pinCode=$_POST['pinCode'];
        $contactNo=$_POST['contactNo'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $id=$_POST['id'];
        $objc = new commoncls();
        $editBranch="UPDATE branch SET
                                    branch_name = '{$branchName}' -- varchar(200)
                                   ,branch_code = '{$branchCode}' -- varchar(200)
                                   ,country = '{$country}' -- varchar(200)
                                   ,state = '{$state}' -- varchar(100)
                                   ,district = '{$district}' -- varchar(100)
                                   ,pin_code = '{$pinCode}' -- varchar(10)
                                   ,mobile_no = '{$contactNo}' -- varchar(20)
                                   ,email = '{$email}' -- varchar(50)
                                   ,address = '{$address}' -- text
                                 WHERE id = '{$id}' -- int(100)";
        $log->info("Edit Branch : $editBranch");
        $callMethod = $objc->create($editBranch);
        if($callMethod){
            $msg = "Branch $branchName updated successfully";
            $setUrl = "../../view/branch/editBranch.php?info=$msg&token=$token&id=$id";
            }else{
            $msg = "Branch $branchName not updated try again !";
            $setUrl = "../../view/branch/editBranch.php?info=$msg&token=$token&id=$id";
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

