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
$objc = new commoncls();
//unset($_SESSION['token']);
$token = md5(rand(1000, 9999));
$_SESSION['token'] = $token;
//$_SESSION['token']= $token;
$log->info('Arrived at loginController');
if($_REQUEST['action']){
  $act = $_REQUEST['action'];  
}else{
$act = $_POST['action'];
}
switch ($act) {
    
    
        
    case 'depositFee':
        $studentId = $_POST['studentId'];
        $month = $_POST['month'];
        $batch = $_POST['batch'];
        $rollNo = $_POST['rollNumber'];
        $feeName = $_POST['feeName'];
        $feeAmount = $_POST['feeAmount'];
        for($c=0; $c<count($feeName); $c++){
        $query = "INSERT INTO fee_deposit_history (
                        student_id
                       ,fee_id
                       ,fee_amount
                       ,month
                       ,c_by
                     ) VALUES (
                        '{$studentId}' -- student_id - IN varchar(20)
                       ,'{$feeName[$c]}' -- fee_id - IN varchar(20)
                       ,'{$feeAmount[$c]}' -- fee_amount - IN float
                       ,'{$month}' -- month - IN varchar(20)
                       ,'{$_SESSION['uid']}' -- c_by - IN varchar(20)
                     )";
        $callMethod = $objc->create($query);
        }
        if ($callMethod == 1) {
            $msg = "Fee for $month deposited successfully!";
            $setUrl = "../../view/fee/feeDeposit.php?info=$msg&token=$token&batch=$batch&enrollNo=$rollNo";
        } else {
            $msg = "Fee for $month not deposited, try again!";
            $setUrl = "../../view/fee/feeDeposit.php?info=$msg&token=$token&batch=$batch&enrollNo=$rollNo";
        }
        break;
        
    case 'update':
        $id = $_POST['id'];
        $role = $_POST['role'];
        $description = $_POST['description'];
        $authObj = new roleClass();
        $callMethod = $authObj->editRole($id, $role, $description, $_SESSION['uid']);
        $log->info("call method variable $callMethod, $id, $role, $description,");
        if ($callMethod == 1) {
            $msg = "Role $role updated successfully!";
            $setUrl = "../../view/user/editRole.php?id=$id&info=$msg&token=$token";
        } else {
            $msg = "Role $role not updated, try again!";
            $setUrl = "../../view/user/editRole.php?id=$id&info=$msg&token=$token";
        }
        break;
    case 'assign':
        $Obj = new roleClass();
        $menu = $_POST['assign'];
        $role = $_POST['role_id'];
        $method = $Obj->assignMenu($role, $menu);
        if ($method) {
            $msg = "Menu assigned successfully!";
            $setUrl = "../../view/user/assignMenu.php?info=$msg&token=$token";
        } else {
            $msg = "Menu assignment failed, try again!";
            $setUrl = "../../view/user/assignMenu.php?info=$msg&token=$token";
        }
        break;
    case 'addUser':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $designation = $_POST['designation'];
        $role = $_POST['role'];
        $region = $_POST['region'];
        $country = $_POST['country'];
        $branchId = $_POST['branchId'];
        $plant = $_POST['plant'];
        include '../config/dbConnection.php';
        $query = "SELECT * FROM h_sites WHERE id='{$plant}'";
        $result = $con->query($query);
        if ($row = mysqli_fetch_array($result)) {
            $zone = $row['zone_id'];
            //$siteT = $row['site_title'];
        }
        $authObj = new roleClass();
        $callMethod = $authObj->addUser($username, $password, $name, $email, $contact, $designation, $country, $role, $region, $country, $plant, $_SESSION['uid']);
        $log->info("call method variable $callMethod" . $_SESSION['uid']);
        if ($callMethod == 1) {
            $msg = "User $name created successfully!";
            $setUrl = "../../view/user/addUser.php?info=$msg&token=$token";
        } else {
            $msg = "User $name not created, try again!";
            $setUrl = "../../view/user/addUser.php?info=$msg&token=$token";
        }
        break;
    case 'updateUser':
        $id = $_POST['uid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $designation = $_POST['designation'];
        $role = $_POST['role'];
        $region = $_POST['region'];
        $country = $_POST['country'];
        $plant = $_POST['plant'];
        include '../config/dbConnection.php';
        $query = "SELECT * FROM h_sites WHERE id='{$plant}'";
        $result = $con->query($query);
        if ($row = mysqli_fetch_array($result)) {
            $zone = $row['zone_id'];
            //$siteT = $row['site_title'];
        }
        $obj = new roleClass();
        $method = $obj->updateUser($id, $name, $email, $contact, $designation, $role, $region, $country, $plant, $_SESSION['uid']);
        if ($method) {
            $msg = "User $name updated successfully!";
            $setUrl = "../../view/user/allUsers.php?id=$id&info=$msg&token=$token";
        } else {
            $msg = "User $name update failed. Try again!";
            $setUrl = "../../view/user/allUsers.php?id=$id&info=$msg&token=$token";
        }
        break;
    ///////////////////////Delete User Case//////////////////////////////////////
    case 'du':
        $id = $_REQUEST['id'];
        $obj = new roleClass();
        $method = $obj->deleteUser($id);
        break;
		
	case 'changePass':
        include '../../controller/config/dbConnection.php';
        $password = sha1($_REQUEST['newPass']);
        $query = "UPDATE f_user_credential SET password='{$password}' WHERE user_id='{$_SESSION['uid']}'";
        $log->debug("Password update excuted : $query");
        $result = $con->query($query);
        if($result){
            $info = "Password Updated successfully";
            $setUrl = "../../view/user/changePassword.php?info=$info&token=$token";
        }
        else{
            $info = "Password not updated !";
            $setUrl = "../../view/user/changePassword.php?info=$info&token=$token";
        }
        break;
        /*Update Fee*/
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

