<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$depNoOfIns=$_POST['depNoOfIns'];
$deposit_amount=$_POST['deposit_amount'];
$custoId=$_POST['cuId'];
$token=$_POST['token'];
$customerMobileNo=$_POST['customerMobileNo'];
if(!empty($_POST['transactionId'])){
    $transactionId=$_POST['transactionId'];
}else{
    $transactionId=0;
}
$date=date('Y-m-d');
 /*=======================================Generate Reciept No Start=====================================================*/
        $selectRecieptNo = "SELECT reciept_no FROM customer_installment_history ORDER BY reciept_no DESC limit 1";
        $log->info("Generate Reciept No From CustomerController.php : $selectRecieptNo");
        $resultRe = $con->query($selectRecieptNo);
        $recieptNo="";
        while ($rowRe = mysqli_fetch_array($resultRe)) {
            $recieptNo = $rowRe['reciept_no'];
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
        $selectCustomerA="SELECT no_of_pay_installment, no_of_installment, agency_code, commision_in_per FROM customer_plan_mapping WHERE status=1 AND customer_id='{$custoId}'";
                            $log->info("Select Customer: $selectCustomerA");
                            $customerResultA=$con->query($selectCustomerA);
                            while ($customerRowA = mysqli_fetch_array($customerResultA)) {
                                  $no_of_pay_installment=$customerRowA['no_of_pay_installment'];     
                                  $agencyId=$customerRowA['agency_code'];     
                                  $commission_in_per=$customerRowA['commision_in_per'];     

                            }
        $deposit_no_of_installment=$depNoOfIns+$no_of_pay_installment;
/*===========================================Update Customer Plan Mapping Start===================================================*/
        $updateCustomerA="UPDATE customer_plan_mapping SET no_of_pay_installment ='{$deposit_no_of_installment}' WHERE customer_id='{$custoId}'";
        $log->info("Update Customer ajaxDepositInstallment: $updateCustomerA");
        $updateResultA=$con->query("$updateCustomerA");
/*================================================Update Customer Plan Mapping End========================================================================*/
/*======================================= Insert Agent Commission History Start ============================================================*/
        $agentCommssion=$deposit_amount*$commission_in_per/100;
        $insertAgentCommission="INSERT INTO agent_commission_history (
                                                                    agency_code
                                                                   ,customer_id
                                                                   ,no_of_installment
                                                                   ,commission_amount
                                                                   ,pay_date
                                                                 ) VALUES (
                                                                    '{$agencyId}' -- agency_code - IN varchar(20)
                                                                   ,'{$custoId}' -- customer_id - IN varchar(20)
                                                                   ,'{$depNoOfIns}' -- customer_id - IN varchar(20)
                                                                   ,'{$agentCommssion}' -- no_of_pay_installment - IN int(11)
                                                                   ,'{$date}' -- pay_date - IN varchar(20)
                                                                 )";
        $log->info("Insert agent Commission table : $insertAgentCommission");  
        $agentResult=$con->query("$insertAgentCommission");
/*===========================================================Insert Agent Commission History End=============================================================*/        
/*============================================ SMS Coading Start For Customer Pay Installment Amount =========================================================*/
        /*$sms = urlencode("Successfully Pay Your Amount From Kashi India Developers LTD.");
        $surl = "http://sms.futureonfinger.com/pushsms.php?username=jptest&api_password=06e695vl956ssen6h&sender=JBDSPR&to=$customerMobileNo&message=$sms&priority=11";
        $log->info("Customer controller): $surl");
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $surl);         
        $content = curl_exec($c);
        curl_close($c);*/
/*============================================SMS Coading End For Customer Pay Installment Amount =========================================================*/
 /*========================================================Insert Customer Installment History Start=================================================*/ 
        $insertPay="INSERT INTO customer_installment_history (
                                                    customer_id
                                                   ,reciept_no
                                                   ,pay_amount
                                                   ,no_of_installment
                                                   ,pay_date
                                                   ,transaction_id
                                                   ,status
                                                 ) VALUES (
                                                    '{$custoId}' -- customer_id - IN varchar(200)
                                                   ,'{$recieptNo}' -- reciept_no - IN varchar(20)
                                                   ,'{$deposit_amount}' -- pay_amount - IN double
                                                   ,'{$depNoOfIns}'   -- no_of_installment - IN int(11)
                                                   ,'{$date}' -- pay_date - IN varchar(20)
                                                   ,'{$transactionId}' -- transaction_id- IN varchar(20)
                                                   ,1  -- status - IN int(5)
                                                 )";
                                    $log->info("Insert Customer Installment History: $insertPay");     
                                    $result = $con->query($insertPay);  
                                    if($result && $agentResult){
                                      $success=1;
                                    }else{
                                      $success=0;
                                    }
                                    echo json_encode($success);         
mysqli_close($con);