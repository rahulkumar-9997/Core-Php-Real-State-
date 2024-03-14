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
$log->info('Arrived at Agent Controller');
if($_REQUEST['action']){
  $act = $_REQUEST['action'];  
}else{
$act = $_POST['action'];
}
switch ($act) {
    case'addAgent':
        $agencyCode=$_POST['agencyCode'];
        $agentName=$_POST['agentName'];
        $country=$_POST['country'];
        $state=$_POST['state'];
        $district=$_POST['district'];
        $postOffice=$_POST['postOffice'];
        $pinCode=$_POST['pinCode'];
        $contactNo=$_POST['contactNo'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $panCardNo=$_POST['panCardNo'];
        $aadharCardNo=$_POST['aadharCardNo'];
        $bankName=$_POST['bankName'];
        $accountNo=$_POST['accountNo'];
        $ifscNo=$_POST['ifscNo'];
        $bankBranchName=$_POST['bankBranchName'];
        $accHolderName=$_POST['accHolderName'];
        $date=date('Y-m-d');
        $objc = new commoncls();
        $insertAgent="INSERT INTO agent (
                                        agency_code
                                       ,branch_id
                                       ,agent_name
                                       ,country
                                       ,state
                                       ,district
                                       ,post
                                       ,pin_code
                                       ,address
                                       ,mobile_no
                                       ,email
                                       ,bank_name
                                       ,c_date
                                       ,c_by
                                       ,status
                                       ,bank_account_no
                                       ,bank_ifsc_code
                                       ,bank_branch_name
                                       ,account_holder_name
                                       ,aadhar_card_no
                                       ,pan_card_no
                                     ) VALUES (
                                        '{$agencyCode}' -- agency_code - IN varchar(250)
                                       ,'{$_SESSION['branch_id']}' -- branch_id - IN varchar(200)
                                       ,'{$agentName}' -- agent_name - IN varchar(250)
                                       ,'{$country}' -- country - IN varchar(20)
                                       ,'{$state}' -- state - IN varchar(100)
                                       ,'{$district}' -- district - IN varchar(100)
                                       ,'{$postOffice}' -- post - IN varchar(100)
                                       ,'{$pinCode}' -- pin_code - IN varchar(10)
                                       ,'{$address}' -- address - IN varchar(250)
                                       ,'{$contactNo}' -- mobile_no - IN varchar(15)
                                       ,'{$email}'  -- email - IN varchar(50)
                                       ,'{$bankName}'  -- bank_name - IN varchar(250)
                                       ,'{$date}' -- c_date - IN varchar(20)
                                       ,'{$_SESSION['uid']}'  -- c_by - IN varchar(100)
                                       ,1 -- status - IN int(5)
                                       ,'{$accountNo}'   -- bank_account_no - IN int(20)
                                       ,'{$ifscNo}'  -- bank_ifsc_code - IN varchar(20)
                                       ,'{$bankBranchName}'  -- bank_ifsc_code - IN varchar(20)
                                       ,'{$accHolderName}'  -- bank_ifsc_code - IN varchar(20)
                                       ,'{$aadharCardNo}'   -- aadhar_card_no - IN int(20)
                                       ,'{$panCardNo}'  -- pan_card_no - IN varchar(20)
                                     )";
        $log->info("Add Agent : $insertAgent");
        $callMethod = $objc->create($insertAgent);
        if($callMethod){
            /*============================================ SMS Coading Start For Agent Register =========================================================*/
            $sms = urlencode("Welcome! $agentName.Your Agency Code is $agencyCode. Regards Kashi India Developers Pvt Ltd.");
            $surl = "http://sms.futureonfinger.com/pushsms.php?username=kidl2019&api_password=06e69cgepymx7szmh&sender=KSHIND&to=$contactNo&message=$sms&priority=11";
            $log->info("AGENT CONTROLLER): $surl");
            $c = curl_init();
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_URL, $surl);         
            $content = curl_exec($c);
            curl_close($c);
           /*============================================SMS Coading End For Agent Register =========================================================*/
            $msg = "Agent $agentName added successfully";
            $setUrl = "../../view/agent/addAgent.php?info=$msg&token=$token";
            }else{
            $msg = "Agent $agentName not added try again !";
            $setUrl = "../../view/agent/addAgent.php?info=$msg&token=$token";
        }                               
        break;
    case 'editAgent':
         $agentName=$_POST['agentName'];
        $country=$_POST['country'];
        $state=$_POST['state'];
        $district=$_POST['district'];
        $postOffice=$_POST['postOffice'];
        $pinCode=$_POST['pinCode'];
        $contactNo=$_POST['contactNo'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $panCardNo=$_POST['panCardNo'];
        $aadharCardNo=$_POST['aadharCardNo'];
        $bankName=$_POST['bankName'];
        $accountNo=$_POST['accountNo'];
        $ifscNo=$_POST['ifscNo'];
        $bankBranchName=$_POST['bankBranchName'];
        $accHolderName=$_POST['accHolderName'];
        $id=$_POST['id'];
        $objc = new commoncls();
        $editAgent="UPDATE agent SET
                                agent_name = '{$agentName}' -- varchar(250)
                               ,country = '{$country}' -- varchar(20)
                               ,state = '{$state}' -- varchar(100)
                               ,district = '{$district}' -- varchar(100)
                               ,post = '{$postOffice}' -- varchar(100)
                               ,pin_code = '{$pinCode}' -- varchar(10)
                               ,address = '{$address}' -- varchar(250)
                               ,mobile_no = '{$contactNo}' -- varchar(15)
                               ,email = '{$email}' -- varchar(50)
                               ,bank_name = '{$bankName}' -- varchar(250)
                               ,bank_account_no = '{$accountNo}' -- varchar(20)
                               ,bank_ifsc_code = '{$ifscNo}' -- varchar(20)
                               ,aadhar_card_no = '{$aadharCardNo}' -- varchar(20)
                               ,pan_card_no = '{$panCardNo}' -- varchar(20)
                               ,bank_branch_name = '{$bankBranchName}' -- varchar(20)
                               ,account_holder_name = '{$accHolderName}' -- varchar(20)
                             WHERE id = '{$id}' -- int(11)";
        $log->info("Edit Agent : $editAgent");
        $callMethod = $objc->create($editAgent);
        if($callMethod){
            $msg = "Agent $agentName updated successfully";
            $setUrl = "../../view/agent/editAgent.php?info=$msg&token=$token&id=$id";
            }else{
            $msg = "Agent $agentName not updated try again !";
            $setUrl = "../../view/agent/editAgent.php?info=$msg&token=$token&id=$id";
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

