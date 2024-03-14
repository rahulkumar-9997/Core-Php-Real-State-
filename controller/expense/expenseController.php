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
$log->info('Arrived at expense Controller');
if($_REQUEST['action']){
  $act = $_REQUEST['action'];  
}else{
$act = $_POST['action'];
}
switch ($act) {
    case'addExpense':
        $expenseName=$_POST['expenseName'];
        $expDesc=$_POST['expDesc'];
        $expDate=$_POST['expDate'];
        $expAmt=$_POST['expAmt'];
        $newExpDate = date("Y-m-d", strtotime($dob));
        $expId=time();
        $objc = new commoncls();
        for($i=0; $i<count($expenseName); $i++){
        $insertExpense="INSERT INTO expense (
                                             expense_id
                                            ,user_id
                                            ,branch_id
                                            ,expense_name
                                            ,description
                                            ,expense_amount
                                            ,expense_date
                                            ,status
                                          ) VALUES (
                                             '{$expId}' -- expense_id - IN varchar(50)
                                            ,'{$_SESSION['uid']}' -- user_id - IN varchar(40)
                                            ,'{$_SESSION['branch_id']}' -- branch_id - IN varchar(50)
                                            ,'{$expenseName[$i]}' -- expense_name - IN varchar(250)
                                            ,'{$expDesc[$i]}'  -- description - IN text
                                            ,'{$expAmt[$i]}' -- expense_amount - IN float
                                            ,'{$expDate[$i]}' -- expense_date - IN varchar(20)
                                            ,1 -- status - IN int(5)
                                          )";
        $log->info("Add Expense : $insertExpense");
        $callMethod = $objc->create($insertExpense);
        }
        if($callMethod){
            $msg = "Expenses added successfully.";
            $setUrl = "../../view/expense/addExpense.php?info=$msg&token=$token";
            }else{
            $msg = "Expenses not added try again !";
            $setUrl = "../../view/expense/addExpense.php?info=$msg&token=$token";
        }                               
        break;
        case'UpdateExpense':
            $expenseName=$_POST['expenseName'];
            $expDesc=$_POST['expDesc'];
            $expDate=$_POST['expDate'];
            $expAmt=$_POST['expAmt'];
            $expId=$_POST['expId'];
            $id=$_POST['id'];
            $objc = new commoncls();
            $updateExp="UPDATE expense SET
                                    expense_name = '{$expenseName}' -- varchar(250)
                                   ,description = '{$expDesc}' -- text
                                   ,expense_amount = '{$expAmt}' -- float
                                   ,expense_date = '{$expDate}' -- varchar(20)
                                 WHERE expense_id = '{$expId}' AND id= '{$id}'-- int(11)";
                                 $log->info("Add Expense : $updateExp");
        $callMethod = $objc->create($updateExp);
        if($callMethod){
            $msg = "Expenses successfully updated.";
            $setUrl = "../../view/expense/editExpense.php?info=$msg&token=$token&expId=$expId&id=$id";
            }else{
            $msg = "Expenses not updated try again !";
            $setUrl = "../../view/expense/editExpense.php?info=$msg&token=$token&expId=$expId&id=$id";
        }     
        break;
        case'deleteExp':
           $id=$_REQUEST['id'];
           $expId=$_REQUEST['expId'];
           $objc = new commoncls();
           $deleteExp="UPDATE  expense SET status=0 WHERE id = '{$id}' AND expense_id='{$expId}' -- int(11)";
           $log->info("UPDATE EXPENSE STATUS: $deleteExp");
           $callMethod = $objc->create($deleteExp);
                if($callMethod){
                    $msg = "Expense deleted successfully .";
                    $setUrl = "../../view/expense/expenseList.php?info=$msg&token=$token";
                    }else{
                    $msg = "Expense not deleted try again !";
                    $setUrl = "../../view/expense/expenseList.php?info=$msg&token=$token";
                }  
           
            
            break;
    default:
        $msg = "Something went wrong !";
        $setUrl = "../../view/dashboard/dashboard.php?info=$msg&token=$token";
        break;
}
$log->debug("URL set as : $setUrl");
header("Location:$setUrl");
ob_end_flush();

