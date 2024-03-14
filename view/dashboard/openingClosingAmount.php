<?php
$_SESSION['branch_id'];
include '../../model/institutebl/commoncls.php';
include '../../controller/config/dbConnection.php';
    $date=date("Y-m-d");
    /*=================================Select Opening and closing amount start ======================================================*/
     $selectOpeClose="SELECT opening_total_amount, closing_total_amount FROM opening_closing_amount ORDER BY id DESC LIMIT 1";
     $log->info("select opening and closing table : $selectOpeClose");
     $resutOpeClo=$con->query($selectOpeClose); 
     $rowCount=mysqli_num_rows($resutOpeClo);
     if($rowCount>0){
     while ($openCloseRow = mysqli_fetch_array($resutOpeClo)) {
         $openAmt= $openCloseRow['opening_total_amount'];
         $closeAmt= $openCloseRow['closing_total_amount'];
     }
     $log->info("close: $closeAmt");
     }else{
       $closeAmt=0;  
     }
    /*=================================Select Opening and closing amount end======================================================*/
    /*=================================Select Maturity Return Amount START==========================================================*/
     /*$selectMaturityAmt="SELECT SUM(maturity_return_amount) AS maturityReturnAmount FROM customer_maturity_return_history WHERE return_date='{$date}' AND status=1";
     $log->info("Select Maturity Return Amount from maturity_return_amount table (openingClosingAmount.php): $selectMaturityAmt");
     $resMaturity=$con->query($selectMaturityAmt);
     while ($maturityRow = mysqli_fetch_array($resMaturity)) {
      $maturityReturnAmount=$maturityRow['maturityReturnAmount'];
    
         
     }*/
     /*=================================Select Maturity Return Amount END==========================================================*/
    /*======================================Select expense========================================================================*/
    /*
        ALTER TABLE real_state.opening_closing_amount
        ADD expense FLOAT NOT NULL AFTER maturity_return_amount;
     */
    $selectExpense="SELECT SUM(expense_amount) AS exp FROM expense WHERE expense_date='{$date}' AND status=1";
    $log->info("select expense: $selectExpense");
    $resultExp=$con->query($selectExpense);
    while ($expRow = mysqli_fetch_array($resultExp)) {
        $expenseAmount=$expRow['exp'];
     }
     if($expenseAmount==''){
         $expenseAmt=0;
     }else{
         $expenseAmt=$expenseAmount;
     }
     /*======================================Select expense========================================================================*/
     /*=================================Manage opening and closing amiunt==================================*/
     $selectOpeningAmount="SELECT SUM(pay_amount) AS opening_amount FROM customer_installment_history WHERE pay_date='{$date}' AND status=1";
     $log->info("selectOpeningAmount: $selectOpeningAmount");
     $resultOpeningAmt=$con->query($selectOpeningAmount); 
     while ($openingAmountRow = mysqli_fetch_array($resultOpeningAmt)) {
         $totalOpeningAmt = $openingAmountRow['opening_amount'];
     }
     if($totalOpeningAmt==''){
         $openingAmount=0+$closeAmt;
         $log->info("Total Open IF");
     }else{
         $openingAmount=$closeAmt;
         $log->info("open Total else: $openingAmount");
     }
     
     $agntPayCommission="SELECT SUM(pay_amount) AS agentCommission FROM agent_pay_commission_history WHERE pay_date='{$date}' AND status=1";
     $log->info("agntPayCommission: $agntPayCommission");
     $agentResult=$con->query($agntPayCommission);
     while ($agentCommissionRow = mysqli_fetch_array($agentResult)) {
           $agntCommission=$agentCommissionRow['agentCommission'];
    }
    if($agntCommission==''){
         $agntCommissionAmt='0';
     }else{
         $agntCommissionAmt=$agntCommission;
     }
    $customerReturnAmt="SELECT SUM(maturity_return_amount) AS maturityReturnAmount FROM customer_maturity_return_history WHERE status=1 AND return_date='{$date}'";
    $log->info("customerReturnAmt: $customerReturnAmt");
    $returnResult=$con->query($customerReturnAmt);
      while ($maturityReturnRow = mysqli_fetch_array($returnResult)) {
           $maturityReturnAmount=$maturityReturnRow['maturityReturnAmount'];
    } 
    if($maturityReturnAmount==''){
         $maturityAmt='0';
     }else{
         $maturityAmt=$maturityReturnAmount;
     }
       
    $payMis="SELECT SUM(pay_amount) AS customerpPayMis FROM customer_pay_mis_history WHERE status=1 AND pay_date='{$date}'";
     $log->info("payMis: $payMis");
    $misResult=$con->query($payMis);
      while ($misRow = mysqli_fetch_array($misResult)) {
           $customerPayMis=$misRow['customerpPayMis'];
    }   
    if($customerPayMis==''){
        $outMis='0';
    }else{
        $outMis=$customerPayMis;
    }
       
    $selectRd="SELECT cu.customer_id, cpm.customer_id, SUM(cih.pay_amount) AS rdAmount FROM customer AS cu, customer_plan_mapping AS cpm, customer_installment_history AS cih WHERE cpm.customer_id = cih.customer_id AND cu.customer_id = cpm.customer_id AND cu.status=1 AND cih.pay_date='{$date}' AND cpm.plan_type='RD'";
    $log->info("selectRd: $selectRd"); 
    $resultRd=$con->query($selectRd);
     while ($rdRow = mysqli_fetch_array($resultRd)) {
    $rdAmount=$rdRow['rdAmount'];
    }
    if($rdAmount==''){
        $rdAmt='0';
    }else{
         $rdAmt=$rdAmount;
    }
    
    $selectFD="SELECT cu.customer_id, cpm.customer_id, SUM(cih.pay_amount) AS fdAmount FROM customer AS cu, customer_plan_mapping AS cpm, customer_installment_history AS cih WHERE cpm.customer_id = cih.customer_id AND cu.customer_id = cpm.customer_id AND cu.status=1 AND cih.pay_date='{$date}' AND cpm.plan_type='FD'";
    $log->info("selectFD: $selectFD"); 
    $resultFd=$con->query($selectFD);
     while ($fdRow = mysqli_fetch_array($resultFd)) {
    $fdAmount=$fdRow['fdAmount'];
    }
    if($fdAmount==''){
        $fdAmt='0';
    }else{
        $fd=$fdAmount;
    }
    $selectMis="SELECT cu.customer_id, cpm.customer_id, SUM(cih.pay_amount) AS misAmount FROM customer AS cu, customer_plan_mapping AS cpm, customer_installment_history AS cih WHERE cpm.customer_id = cih.customer_id AND cu.customer_id = cpm.customer_id AND cu.status=1 AND cih.pay_date='{$date}' AND cpm.plan_type='MIS'";
    $log->info("selectMIs: $selectMis"); 
    $resultMis=$con->query($selectMis);
     while ($misRow = mysqli_fetch_array($resultMis)) {
    $misAmount=$misRow['misAmount'];
    }
    if($misAmount==''){
        $inMis='0';
    }else{
        $inMis=$misAmount;
    }
    
    $outAmount=$agntCommissionAmt+$maturityAmt+$outMis+$expenseAmt;
    if($outAmount==''){
        $outAmount=0;
    }
    $commingAmount=$rdAmt+$fdAmt+$inMis;
    if($commingAmount==''){
        $commingAmount=0;
    }
    $totalclosingAmt=$commingAmount-$outAmount;
    $insertOpnClsngAmt="INSERT INTO opening_closing_amount (
                                                    opening_total_amount
                                                   ,closing_total_amount
                                                   ,branch_id
                                                   ,c_by
                                                   ,`date`
                                                   ,rd_amount
                                                   ,fd_amount
                                                   ,in_mis
                                                   ,out_mis
                                                   ,maturity_return_amount
                                                   ,expense
                                                 ) VALUES (
                                                    '{$closeAmt}' -- opening_total_amount - IN double
                                                    ,'{$totalclosingAmt}' -- closing_total_amount - IN double
                                                   ,'{$_SESSION['branch_id']}' -- branch_id - IN varchar(20)
                                                   ,'{$_SESSION['uid']}'  -- c_by - IN varchar(100)
                                                   ,'{$date}' -- date - IN varchar(20)
                                                   ,'{$rdAmt}'   -- rd_amount - IN double
                                                   ,'{$fdAmt}'   -- fd_amount - IN double
                                                   ,'{$inMis}'   -- in_mis - IN double
                                                   ,'{$outMis}'   -- out_mis - IN double
                                                   ,'{$maturityAmt}'   -- out_mis - IN double
                                                   ,'{$expenseAmt}'   -- expense - IN double
                                                 )";
      $log->info("Insert Opening and closing amount : $insertOpnClsngAmt");                                            
      $resultOpnClo=$con->query($insertOpnClsngAmt);
      if($resultOpnClo){
          //echo "success";
      }else{
          //echo "try again";
      }
      
    /*=================================Manage opening and closing amiunt==================================*/
     ?>