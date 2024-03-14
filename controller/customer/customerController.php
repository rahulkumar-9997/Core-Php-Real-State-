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
include '../../controller/config/dbConnection.php';
$_SESSION['token'] = $token;
$log->info('Arrived at Branch Controller');
if($_REQUEST['action']){
  $act = $_REQUEST['action'];  
}else{
$act = $_POST['action'];
}
switch ($act) {
    case'addCustomer':
        $cuName=$_POST['name'];
        $cuFatherName=$_POST['fatherName'];
        $cuDob=$_POST['dob'];
        $cuMobileNo=$_POST['mobileNo'];
        $cuDateOfJoining=$_POST['dateOfJoining'];
        $cuDistrict=$_POST['district'];
        $cuGender=$_POST['gender'];
        $cuCountry=$_POST['country'];
        $cuPost=$_POST['post'];
        $cuPinCode=$_POST['pinCode'];
        $cuAddress=$_POST['address'];
        $cuPhoto=$_POST['photo'];
        $cuNomineeName=$_POST['nomineeName'];
        $cuRelationship=$_POST['relationship'];
        $agencyId=$_POST['agencyId'];
        $planId=$_POST['planId'];
        $cuRegistrationNo=$_POST['registrationNo'];
        $customerRelationship=$_POST['customerRelationship'];
        $cuCutomerId=$_POST['cutomerId'];
        $cuSrNo=$_POST['srNo'];
        $cuPayMode=$_POST['payMode'];
        $cuAadharCard=$_POST['adharCardNo'];
        $cuPanCardNo=$_POST['panCardNo'];
        $cuBankName=$_POST['bankName'];
        $cuAccountNo=$_POST['accountNo'];
        $cuIfscCode=$_POST['ifscCode'];
        $nomineeDob=$_POST['nomineeDob'];
        $maturityReturn=$_POST['maturityReturn'];
        $no_of_installment=$_POST['no_of_installment'];
        $totalInstallmentAmount=$_POST['totalInstallmentAmount'];
        $bankBranchName=$_POST['bankBranchName'];
        $accHolderName=$_POST['accHolderName'];
        $no_of_pay_installment=1;
        $payAmount=$_POST['installmentAmount'];
        $date=date('Y-m-d');
        $plotConsideration=$totalInstallmentAmount/1000;
        //$recieptNo='KID'.time();
        $objc = new commoncls();
        include '../../controller/config/dbConnection.php';
        /*=======================================Generate Reciept No Start=====================================================*/
        $selectRecieptNo = "SELECT reciept_no FROM customer_installment_history ORDER BY reciept_no DESC limit 1";
        $log->info("Generate Reciept No From CustomerController.php : $selectRecieptNo");
        $result = $con->query($selectRecieptNo);
        $recieptNo="";
        while ($row = mysqli_fetch_array($result)) {
            $recieptNo = $row['reciept_no'];
        }
        if(empty($recieptNo)){
            $recieptNo = "00000001";
        }

        $newAr = explode(" ", $recieptNo);
        $pad_length = 0;
        $pad_lengthi = 8;
        $fId = substr($newAr[0], 2);
       // echo $fId;
        $iId = $fId+1;
        $nId = $fId;
        $recieptNo = str_pad($iId, $pad_lengthi, "0", STR_PAD_LEFT);
        
        /*=======================================Generate Reciept No End=====================================================*/
        /*=========================== Select Plan Details Start ===================================*/
        $selectPlan="SELECT plan_id, plan_name, duration_month, commission_in_per, plan_type, interest_rate_in_per FROM plan WHERE plan_id='{$planId}' ";
        $log->info("Select Plan Details (Customer controller.php): $selectPlan");
        $resultPlan = $con->query($selectPlan);
        while ($planRow = mysqli_fetch_array($resultPlan)) {
                        $planName=$planRow['plan_name'];
                        $planDuration=$planRow['duration_month'];
                        $commission_in_per=$planRow['commission_in_per'];
                        $interest_rate_in_per=$planRow['interest_rate_in_per'];
                        $planType=$planRow['plan_type'];
        }
        /*$expairyDate = date('Y-m-d', strtotime("+$planDuration month"));*/
        $expairyDate=$_POST['expDate'];
        /*=========================== Select Plan Details End ===================================*/
        /*=================================Select Agent Mobile No Start======================================*/
        $selectAgent="SELECT mobile_no FROM agent WHERE agency_code='{$agencyId}'";
        $log->info("Select Agent From CustomerController.php: $selectAgent");
        $agentResult=$con->query($selectAgent);
        while ($agentRow = mysqli_fetch_array($agentResult)) {
            $agentMobileNo=$agentRow['mobile_no'];
        }
        /*=================================Select Agent Mobile No End======================================*/
        /*=========================== Insert into Customer table start ===================================*/
         $insertCustomer="INSERT INTO customer (
                                                customer_id
                                               ,registration_no
                                               ,sr_no
                                               ,agency_code
                                               ,branch_id
                                               ,name
                                               ,father
                                               ,customer_relationship
                                               ,dob
                                               ,date_of_joining
                                               ,expairy_date
                                               ,country
                                               ,post
                                               ,district
                                               ,pin_code
                                               ,address
                                               ,mobil_no
                                               ,gender
                                               ,aadhar_card_no
                                               ,nominee
                                               ,realation
                                               ,nominee_date_of_birth
                                               ,c_by
                                               ,c_date
                                               ,status
                                               ,pan_card_no
                                               ,bank_name
                                               ,account_no
                                               ,ifsc_code
                                               ,bank_branch_name
                                               ,account_holder_name
                                             ) VALUES (
                                                '{$cuCutomerId}' -- customer_id - IN varchar(11)
                                               ,'{$cuRegistrationNo}' -- registration_no - IN varchar(100)
                                               ,'{$cuSrNo}' -- sr_no - IN varchar(100)
                                               ,'{$agencyId}' -- agency_code - IN varchar(100)
                                               ,'{$_SESSION['branch_id']}' -- branch_id - IN varchar(100)
                                               ,'{$cuName}' -- name - IN varchar(200)
                                               ,'{$cuFatherName}' -- father - IN varchar(200)
                                               ,'{$customerRelationship}' -- customer_relashionship - IN varchar(20)
                                               ,'{$cuDob}' -- dob - IN varchar(50)
                                               ,'{$cuDateOfJoining}' -- date_of_joining - IN varchar(50)
                                               ,'{$expairyDate}' -- expairy_date - IN varchar(20)
                                               ,'{$cuCountry}' -- country - IN varchar(100)
                                               ,'{$cuPost}' -- post - IN varchar(200)
                                               ,'{$cuDistrict}' -- district - IN varchar(200)
                                               ,'{$cuPinCode}' -- pin_code - IN varchar(15)
                                               ,'{$cuAddress}'  -- address - IN varchar(250)
                                               ,'{$cuMobileNo}' -- mobil_no - IN varchar(15)
                                               ,'{$cuGender}' -- gender - IN varchar(20)
                                               ,'{$cuAadharCard}'  -- aadhar_card_no - IN varchar(20)
                                               ,'{$cuNomineeName}'  -- nominee - IN varchar(150)
                                               ,'{$cuRelationship}'  -- realation - IN varchar(150)
                                               ,'{$nomineeDob}'   -- nominee_date_of_birth - IN int(11)
                                               ,'{$_SESSION['uid']}'  -- c_by - IN varchar(100)
                                               ,'{$date}'  -- c_date - IN varchar(100)
                                               ,1 -- status - IN int(5)
                                               ,'{$cuPanCardNo}'  -- pan_card_no - IN varchar(20)
                                               ,'{$cuBankName}'  -- bank_name - IN varchar(250)
                                               ,'{$cuAccountNo}'   -- account_no - IN int(20)
                                               ,'{$cuIfscCode}'  -- ifsc_code - IN varchar(20)
                                               ,'{$bankBranchName}'  -- ifsc_code - IN varchar(20)
                                               ,'{$accHolderName}'  -- ifsc_code - IN varchar(20)
                                             )";                                  
        $log->info("Query Insert Customer : $insertCustomer");
        $customer=$con->query($insertCustomer);
        /*=========================== Insert into Customer table end ===================================*/
        /*=========================== Insert into Customer plan Mapping table Start ===================================*/
       
        $queryCustomerPlanMapping="INSERT INTO customer_plan_mapping (
                                                                    customer_id
                                                                   ,agency_code
                                                                   ,branch_id
                                                                   ,plan_id
                                                                   ,plan_name
                                                                   ,plan_duration
                                                                   ,commision_in_per
                                                                   ,interest_rate_in_per
                                                                   ,plan_type
                                                                   ,pay_mode
                                                                   ,total_installment_amount
                                                                   ,installment_amount
                                                                   ,no_of_installment
                                                                   ,no_of_pay_installment
                                                                   ,maturity_return
                                                                   ,plot_consideration
                                                                   ,c_date
                                                                   ,c_by
                                                                   ,status
                                                                 ) VALUES (
                                                                    '{$cuCutomerId}' -- customer_id - IN varchar(100)
                                                                   ,'{$agencyId}'  -- agency_code - IN varchar(100)
                                                                   ,'{$_SESSION['branch_id']}'-- branch_id - IN varchar(100)
                                                                   ,'{$planId}' -- plan_id - IN int(11)
                                                                   ,'{$planName}' -- plan_name - IN varchar(200)
                                                                   ,'{$planDuration}' -- plan_duration - IN varchar(100)
                                                                   ,'{$commission_in_per}' -- commision_in_per - IN double
                                                                   ,'{$interest_rate_in_per}' -- interest_rate_in_per - IN varchar(250)
                                                                   ,'{$planType}' -- plan_type - IN varchar(50)
                                                                   ,'{$cuPayMode}' -- pay_mode - IN varchar(150)
                                                                   ,'{$totalInstallmentAmount}' -- pay_mode - IN varchar(150)
                                                                   ,'{$payAmount}' -- installment_amount - IN double
                                                                   ,'{$no_of_installment}' -- no_of_installment - IN varchar(20)
                                                                   ,'{$no_of_pay_installment}' -- no_of_pay_installment - IN varchar(20)
                                                                   ,'{$maturityReturn}'   -- maturity_return - IN double
                                                                   ,'{$plotConsideration}'   -- maturity_return - IN double
                                                                   ,'{$cuDateOfJoining}' -- c_date - IN varchar(20)
                                                                   ,'{$_SESSION['uid']}' -- c_by - IN varchar(100)
                                                                   ,1 -- status - IN int(5)
                                                                 )";                                                       
            $log->info("Insert Customer plan Mapping : $queryCustomerPlanMapping");
            $customerPlanMapping=$con->query($queryCustomerPlanMapping);  
             /*=========================== Insert into Customer plan Mapping table end ===================================*/
             /*=========================== Insert into customer_installment_history table Start ===================================*/
            $insertCuInHistory="INSERT INTO customer_installment_history (
                                                                        customer_id
                                                                       ,reciept_no
                                                                       ,pay_amount
                                                                       ,pay_date
                                                                       ,status
                                                                     ) VALUES (
                                                                        '{$cuCutomerId}' -- customer_id - IN varchar(200)
                                                                       ,'{$recieptNo}' -- pay_amount - IN double
                                                                       ,'{$payAmount}' -- pay_amount - IN double
                                                                       ,'{$cuDateOfJoining}' -- pay_date - IN varchar(20)
                                                                       ,1   -- status - IN int(5)
                                                                     )";
            $log->info("Insert customer_installment_history :$insertCuInHistory");
            $resultCuHistory=$con->query($insertCuInHistory); 
           /*=========================== Insert into customer_installment_history table end ===================================*/ 
           /*================================+++++++++++++++++++++++++++++++++==================================================*/
           /*================================++++++++++++++++ If Plan Type Mis Than Insert Query Start  +++++++++++++++++==================================================*/
            if($planType=='MIS'){
                   $insertCustomerMisInfo="INSERT INTO customer_mis_info (
                                                                        customer_id
                                                                       ,no_of_mis
                                                                       ,no_of_pay_mis
                                                                       ,mis_paid_upto_date
                                                                       ,c_by
                                                                       ,status
                                                                     ) VALUES (
                                                                        '{$cuCutomerId}' -- customer_id - IN varchar(20)
                                                                       ,'{$planDuration}' -- no_of_mis - IN varchar(20)
                                                                       ,0 -- no_of_pay_mis - IN varchar(20)
                                                                       ,'{$cuDateOfJoining}' -- mis_paid_upto_date - IN varchar(20)
                                                                       ,'{$_SESSION['uid']}'  -- c_by - IN varchar(20)
                                                                       ,1 -- status - IN int(5)
                                                                     )";
            $log->info("Insert customer_mis_info Table If Plan Type MIS: $insertCustomerMisInfo");     
            $resultMis=$con->query($insertCustomerMisInfo);
            }
           /*================================+++++++++++++++++ If Plan Type Mis Than Insert Query End  ++++++++++++++++==================================================*/
           /*================================+++++++++++++++++++++++++++++++++==================================================*/
            
            
            /*======================================Insert Agent Commision Table start========================================*/
            $agentCommssion=$payAmount*$commission_in_per/100;
            $insertAgentCommission="INSERT INTO agent_commission_history (
                                                                        agency_code
                                                                       ,customer_id
                                                                       ,commission_amount
                                                                       ,pay_date
                                                                     ) VALUES (
                                                                        '{$agencyId}' -- agency_code - IN varchar(20)
                                                                       ,'{$cuCutomerId}' -- customer_id - IN varchar(20)
                                                                       ,'{$agentCommssion}' -- no_of_pay_installment - IN int(11)
                                                                       ,'{$cuDateOfJoining}' -- pay_date - IN varchar(20)
                                                                     )";
            $log->info("Insert agent Commission table : $insertAgentCommission");                                                           
            $callMethod = $objc->create($insertAgentCommission);  
          /*======================================Insert Agent Commision Table end========================================*/
          /*============================================ SMS Coading Start  For Customer =========================================================*/
            $sms = urlencode("Welcome! $cuName. Your Registration No is $cuRegistrationNo Plan Name is $planName Amount $payAmount Terms $expairyDate. Regards Kashi India Developers Pvt Ltd.");
            $surl = "http://sms.futureonfinger.com/pushsms.php?username=kidl2019&api_password=06e69cgepymx7szmh&sender=KSHIND&to=$cuMobileNo&message=$sms&priority=11";
            $log->info("Customer controller): $surl");
            $c = curl_init();
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_URL, $surl);         
            $content = curl_exec($c);
            curl_close($c);
           /*============================================SMS Coading End For Customer=========================================================*/
           /*============================================ SMS Coading Start  For Agent Commission =========================================================*/
            /*$sms = urlencode("You Have Registered Successfully From Kashi India Developers LTD Yor First Receipt No $recieptNo And You Pay Installment Amount $payAmount");
            $surl = "http://sms.futureonfinger.com/pushsms.php?username=jptest&api_password=06e695vl956ssen6h&sender=JBDSPR&to=$cuMobileNo&message=$sms&priority=11";
            $log->info("Customer controller): $surl");
            $c = curl_init();
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_URL, $surl);         
            $content = curl_exec($c);
            curl_close($c);*/
           /*============================================SMS Coading End Agent Commission=========================================================*/
        if($callMethod){
            include '../../view/customer/upload.php';
            $msg = "Customer $name added successfully";
            $setUrl = "../../view/customer/addCustomer.php?info=$msg&token=$token";
            }else{
            $msg = "Customer $name not added try again !";
            $setUrl = "../../view/customer/addCustomer.php?info=$msg&token=$token";
        }                               
        break;
    case 'editCustomer':
        $cuName=$_POST['name'];
        $cuFatherName=$_POST['fatherName'];
        $cuDob=$_POST['dob'];
        $cuMobileNo=$_POST['mobileNo'];
        $cuDateOfJoining=$_POST['dateOfJoining'];
        $cuDistrict=$_POST['district'];
        $cuGender=$_POST['gender'];
        $cuCountry=$_POST['country'];
        $cuPost=$_POST['post'];
        $cuPinCode=$_POST['pinCode'];
        $cuAddress=$_POST['address'];
        $photoOld=$_POST['photo'];
        $cuNomineeName=$_POST['nomineeName'];
        $cuRelationship=$_POST['relationship'];
        $cuCutomerId=$_POST['cutomerId'];
        $cuAadharCard=$_POST['adharCardNo'];
        $cuPanCardNo=$_POST['panCardNo'];
        $cuBankName=$_POST['bankName'];
        $cuAccountNo=$_POST['accountNo'];
        $cuIfscCode=$_POST['ifscCode'];
        $bankBranchName=$_POST['bankBranchName'];
        $accHolderName=$_POST['accHolderName'];
        $nomineeDob=$_POST['nomineeDob'];
        $customerRelationship=$_POST['customerRelationship'];
        $objc = new commoncls();
        $updateCustomer="UPDATE customer SET
                                    name = '{$cuName}' -- varchar(200)
                                   ,father = '{$cuFatherName}' -- varchar(200)
                                   ,customer_relationship = '{$customerRelationship}' -- varchar(200)
                                   ,dob = '{$cuDob}' -- varchar(50)
                                   ,country = '{$cuCountry}' -- varchar(100)
                                   ,post = '{$cuPost}' -- varchar(200)
                                   ,district = '{$cuDistrict}' -- varchar(200)
                                   ,pin_code = '{$cuPinCode}' -- varchar(15)
                                   ,address = '{$cuAddress}' -- varchar(250)
                                   ,mobil_no = '{$cuMobileNo}' -- varchar(15)
                                   ,gender = '{$cuGender}' -- varchar(20)
                                   ,aadhar_card_no = '{$cuAadharCard}' -- varchar(20)
                                   ,pan_card_no = '{$cuPanCardNo}' -- varchar(20)
                                   ,bank_name = '{$cuBankName}' -- varchar(20)
                                   ,account_no = '{$cuAccountNo}' -- varchar(20)
                                   ,ifsc_code = '{$cuIfscCode}' -- varchar(20)
                                   ,nominee_date_of_birth = '{$nomineeDob}' -- varchar(20)
                                   ,nominee = '{$cuNomineeName}' -- varchar(150)
                                   ,realation = '{$cuRelationship}' -- varchar(150)
                                   ,bank_branch_name = '{$bankBranchName}' -- varchar(150)
                                   ,account_holder_name = '{$accHolderName}' -- varchar(150)
                                 WHERE customer_id = '{$cuCutomerId}' -- int(100)";
        $log->info("Update customer : $updateCustomer");
        $callMethod = $objc->create($updateCustomer);
        if($callMethod){
            include '../../view/customer/upload.php';
            $msg = "Customer $cuName updated successfully";
            $setUrl = "../../view/customer/editCustomer.php?info=$msg&token=$token&id=$cuCutomerId";
            }else{
            $msg = "Customer $cuName not updated try again !";
            $setUrl = "../../view/customer/editCustomer.php?info=$msg&token=$token&id=$cuCutomerId";
        }                             
        
        break;
        case 'payCustomerMaturityAmount':
            $cuName=$_REQUEST['name'];
            $maturityReturnAmount=$_POST['maturity_return_amount'];
            $payDate=$_POST['date'];
            $customerId=$_POST['customerId'];
             if(!empty($_POST['transaction_id'])){
                $transaction_id=$_POST['transaction_id'];
            }else{
                $transaction_id=0;
            }
            date_default_timezone_set('Asia/Calcutta'); 
            $objc = new commoncls();
            $maturityReturnQuery="INSERT INTO customer_maturity_return_history (
                                                                            customer_id
                                                                           ,maturity_return_amount
                                                                           ,return_date
                                                                           ,`transaction_ id`
                                                                           ,c_by
                                                                           ,status
                                                                           ,branch_id
                                                                         ) VALUES (
                                                                            '{$customerId}' -- customer_id - IN varchar(20)
                                                                           ,'{$maturityReturnAmount}' -- maturity_return_amount - IN double
                                                                           ,'{$payDate}' -- return_date - IN varchar(20)
                                                                           ,'{$transaction_id}' -- transaction_id - IN varchar(20)
                                                                           ,'{$_SESSION['uid']}' -- c_by - IN varchar(20)
                                                                           ,1 -- status - IN int(10)
                                                                           ,'{$_SESSION['branch_id']}' -- branch_id - IN varchar(20)
                                                                         )";
           
            $callMethod = $objc->create($maturityReturnQuery);
            if($callMethod){
                $updateCustomMaturity="UPDATE customer SET claimed_maturity_payment_status=1, maturity_return_paid_date='{$payDate}' WHERE id ='{$_REQUEST['id']}' AND customer_id='{$customerId}'";
                $log->info("Update customer table : $updateCustomMaturity");
                $resultUpdate = $con->query($updateCustomMaturity);
                $msg = "You have successfully paid maturity return amount to $cuName .";
                $setUrl = "../../view/customer/claimedMaturityPaidList.php?info=$msg&token=$token";
                }else{
                $msg = "You have not paid  maturity return amount to $cuName !";
                $setUrl = "../../view/customer/claimedMaturityPendingList.php?info=$msg&token=$token";
            } 
            break;
        case 'inactiveCustomer':
            $customerId=$_REQUEST['cuId'];
            $cuName=$_REQUEST['cuName'];
            /*==========================Update Customer table ==================================*/
            $updateCustomer="UPDATE customer SET status='0' WHERE customer_id='{$customerId}'";
            $log->info("Update customer table status: $updateCustomer");
            $resultUpdateCusomer = $con->query($updateCustomer);
            
            /*===========================Update Customer plan mapping table =====================================*/
            $updateCusPlanMapping="UPDATE customer_plan_mapping SET status='0' WHERE customer_id='{$customerId}'";
            $log->info("Update customer_plan_mapping table status: $updateCusPlanMapping");
            $resultUpdateCusPlanMapping = $con->query($updateCusPlanMapping);
            
            /*============================Update customer installment history table================================*/
            $updateCusInsHistory="UPDATE customer_installment_history SET status='0' WHERE customer_id='{$customerId}'";
            $log->info("Update customer_plan_mappingcustomer_installment_history table status: $updateCusInsHistory");
            $resultUpdateCih = $con->query($updateCusInsHistory);
            
            /*=============================Update customer pay mis history=======================================*/
            /*$updateCusPayMis="UPDATE customer_pay_mis_history SET status='0' WHERE customer_id='{$customerId}'";
            $log->info("Update customer_pay_mis_history table status: $updateCusPayMis");
            $resultUpdatePayMis = $con->query($updateCusPayMis);*/
            
            /*===========================Update customer mis info==============================*/
            if($_REQUEST['plan_type']=='MIS'){
            $updateCusMisInfo="UPDATE customer_mis_info SET status='0' WHERE customer_id='{$customerId}'";
            $log->info("Update customer_pay_mis_history table status: $updateCusMisInfo");
            $resultUpdateMisInfo = $con->query($updateCusMisInfo);
            }
            
            $updateAch="UPDATE agent_commission_history SET status='0' WHERE customer_id='{$customerId}'";
            $log->info("Update agent_commission_history table status: $updateAch");
            $resultUpdateAch = $con->query($updateAch);
            
            if($resultUpdateCusomer && $resultUpdateCusPlanMapping && $resultUpdateCih && $resultUpdateAch){
                $msg = "Customer deleted successfully .";
                $setUrl = "../../view/customer/customerList.php?info=$msg&token=$token";
                }else{
                $msg = "Customer not deleted try again !";
                $setUrl = "../../view/customer/customerList.php?info=$msg&token=$token";
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

