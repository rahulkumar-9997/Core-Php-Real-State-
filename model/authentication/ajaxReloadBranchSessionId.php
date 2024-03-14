<?php
session_start();
include '../../logger/incLog.php';
include '../../controller/config/dbConnection.php';
$branch = $_REQUEST['branchId'];
//echo $branch;
$selectBranch="Select * FROM branch WHERE branch_id='{$branch}'";
$log->info("select branch id where reload branch id : $selectBranch");
$branchResult=$con->query($selectBranch);
while ($branchRow = mysqli_fetch_array($branchResult)) {
    $_SESSION['branch_id'] = $branchRow['branch_id'];
    $_SESSION['branch_code'] = $branchRow['branch_code']; 
    $_SESSION['district'] = $branchRow['district']; 
    $_SESSION['branch_name'] = $branchRow['branch_name']; 
}

/*include 'userAuthentication.php';
$objRel = new userAuthentication();
$callMethod = $objRel->userVerification($_SESSION['uid'], 'Dummy', 0, $branch);
 */