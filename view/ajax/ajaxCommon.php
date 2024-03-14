
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
 include '../../model/institutebl/commoncls.php';
 include '../../logger/incLog.php';
 include '../../controller/config/dbConnection.php';
$actionId = $_REQUEST['actionId'];
$log->info("Action id : $actionId");
switch ($actionId) {
    //check email id case
    case 'payAgentCommission':
            $agencyId=$_POST['agencyId'];
            $commmissionPayAmt=$_POST['commissionPayAmt'];
            $date=date('Y-m-d');
            $insertAgentPayCo="INSERT INTO agent_pay_commission_history (
                                                            agency_code
                                                           ,pay_amount
                                                           ,pay_date
                                                           ,status
                                                           ,c_by
                                                         ) VALUES (
                                                            '{$agencyId}' -- agency_code - IN varchar(250)
                                                           ,'{$commmissionPayAmt}' -- pay_amount - IN double
                                                           ,'{$date}' -- pay_date - IN varchar(20)
                                                           ,1 -- status - IN int(5)
                                                           ,'{$_SESSION['uid']}'  -- c_by - IN varchar(50)
                                                         )";
             $log->info("Ajax Insert Agent Commission Amount : $insertAgentPayCo");      
             $result = $con->query($insertAgentPayCo);
             if($result){
               $res=1;
               echo json_encode($res);   
             }else{
               $error=0;
               echo json_encode($error);
             }    
            break;
            /*=====================================Search Customer Details start===============================*/
            case 'searchCustomer':
                $customerId=$_POST['customerId'];
                $selectCustomer="SELECT cu.name, cu.father, cu.dob, cu.date_of_joining, cu.bank_name, cu.account_no, cu.ifsc_code, cu.account_holder_name, cu.expairy_date, cu.country, cu.gender, cu.post, cu.district, "
                                    . "cu.pin_code, cu.address, cu.mobil_no, cu.gender, cu.nominee, cu.realation, cu.customer_img, "
                                    . "cpm.agency_code, cpm.interest_rate_in_per, cpm.plan_name, cpm.plan_duration, cpm.plan_type, cpm.pay_mode, cpm.total_installment_amount, cpm.plan_type, cpm.installment_amount, "
                                    . "cpm.no_of_installment, cpm.no_of_pay_installment, cih.customer_id, cih.reciept_no, cih.pay_amount, "
                                    . "cih.pay_date, cih.no_of_installment AS cihNoOfInstallment, cmis.no_of_mis, cmis.no_of_pay_mis, cmis.mis_paid_upto_date, p.calculation_rate FROM customer AS cu, customer_plan_mapping AS cpm, customer_installment_history AS cih, customer_mis_info AS cmis, plan AS p "
                                    . "WHERE cu.customer_id=cpm.customer_id AND cpm.customer_id = cih.customer_id AND cpm.customer_id = cmis.customer_id AND cu.customer_id='{$customerId}' AND cpm.customer_id='{$customerId}' AND cih.customer_id='{$customerId}' AND cmis.customer_id='{$customerId}' AND p.plan_id=cpm.plan_id";
                                $log->info("Select Customer Details From Mis Detail (ajaxCommon.php) : $selectCustomer");
                                $customerResult=$con->query($selectCustomer);
                                $countCu=mysqli_num_rows($customerResult);
                                if($countCu>0){
                                     while ($customerRow = mysqli_fetch_array($customerResult)) {
                                                $name=$customerRow['name'];
                                                $father=$customerRow['father'];
                                                $dob=$customerRow['dob'];
                                                $date_of_joining=$customerRow['date_of_joining'];
                                                $expairy_date=$customerRow['expairy_date'];
                                                $country=$customerRow['country'];
                                                $gender=$customerRow['gender'];
                                                $plan_type=$customerRow['plan_type'];
                                                $post=$customerRow['post'];
                                                $district=$customerRow['district'];
                                                $pin_code=$customerRow['pin_code'];
                                                $address=$customerRow['address'];
                                                $mobil_no=$customerRow['mobil_no'];
                                                $plan_name=$customerRow['plan_name'];
                                                $plan_duration=$customerRow['plan_duration'];
                                                $pay_mode=$customerRow['pay_mode'];
                                                $no_of_installment=$customerRow['no_of_installment'];
                                                $no_of_pay_installment=$customerRow['no_of_pay_installment'];
                                                $interest_rate_in_per=$customerRow['calculation_rate'];
                                                $mis_paid_upto_date=$customerRow['mis_paid_upto_date'];
                                                $no_of_mis=$customerRow['no_of_mis'];
                                                $no_of_pay_mis=$customerRow['no_of_pay_mis'];

                                                $totalInstallmentAmount=$customerRow['total_installment_amount'];
                                                $installment_amount=$customerRow['installment_amount'];
                                                $bank_name=$customerRow['bank_name'];
                                                $account_no=$customerRow['account_no'];
                                                $ifsc_code=$customerRow['ifsc_code'];
                                                $accountHolderName=$customerRow['account_holder_name'];
                                             }  
                                             $availableNoOfMis=$no_of_mis-$no_of_pay_mis;
                                             $customerPayAmount=$totalInstallmentAmount*$interest_rate_in_per/100;
                                             $newOneMonthAgoDate = strtotime("+1 months", strtotime($mis_paid_upto_date)); // returns timestamp
                                             $newOneMonthAgoDate1= date('Y-m-d',$newOneMonthAgoDate);
                                    ?>
                                     <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td colspan="8" class="bg-primary" style="text-align: center; padding: 0px;"> <b style="color: #ffffff; text-align: center;">Customer Detail</b></td>
                                                </tr>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <td><?php echo $name;?></td>
                                                    <th>Father Name</th>
                                                    <td><?php echo $father;?></td>
                                                    <th>Address</th>
                                                    <td style="width: 200px;"><?php echo $address. ','.$district. ','.$country. ','.$pin_code;?></td>
                                                    <th>Date Of Joining</th>
                                                    <td><?php echo date("d-m-Y", strtotime($date_of_joining));?></td>
                                                </tr>
                                                <tr>
                                                    <th>Date Of Expiry</th>
                                                    <td><span class="label label-danger"> <?php echo date("d-m-Y", strtotime($expairy_date));?></span></td>
                                                    <th>No.of MIS</th>
                                                    <td> <?php echo $no_of_mis;?></span></td>
                                                    <th>No.of Paid MIS</th>
                                                    <td> <?php echo $no_of_pay_mis; if($no_of_mis===$no_of_pay_mis){echo '<span class="label label-success">MIS duration has been Completed <i class="fa fa-check"></i></span>';}?> </td>
                                                    <th>Total Installment Amt</th>
                                                    <td><i class="fa fa-rupee"></i> <?php echo $totalInstallmentAmount;?></td>
                                                </tr>
                                                <tr>
                                                    <th>Plan Name</th>
                                                    <td><?php echo $plan_name;?></td>
                                                    <th>Plan Type</th>
                                                    <td><?php echo $plan_type;?></td>
                                                    <th>Plan Duration</th>
                                                    <td><?php echo $plan_duration;?> Month</td>
                                                    <th>Pay Mode</th>
                                                    <?php
                                                        if($plan_type=='RD'){
                                                        ?>
                                                        <td style="border: none;" class="bg-fuchsia"><?php echo "Regular";?></td>
                                                        <?php
                                                        }else if($plan_type=='MIS' OR $plan_type=='FD'){
                                                          ?>
                                                        <td class="bg-fuchsia" style="border: none;"><?php echo "Single";?></td>
                                                        <?php
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <td colspan="8" class="bg-primary" style="text-align: center; padding: 0px;"> <b style="color: #ffffff; text-align: center;">Account Information</b></td>
                                                </tr>
                                                <tr>
                                                    <th>Bank Name</th>
                                                    <td><?php echo $bank_name;?></td>
                                                    <th>Account No</th>
                                                    <td><?php echo $account_no;?></td>
                                                    <th>IFSC Code</th>
                                                    <td><?php echo $ifsc_code;?></td>
                                                    <th>Account Holder Name</th>
                                                    <td><?php echo $accountHolderName;?></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                      <?php
                                        if($no_of_mis===$no_of_pay_mis){
                                            ?>
                                                <br><div class="alert alert-alert alert-dismissable" style="background-color: #00733e;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <b style="color: white;"><i class="icon fa fa-warning"></i>MIS duration and payment has been completed!</b>
                                                </div>
                                            <?php
                                        }else{
                                        if(($newOneMonthAgoDate) < strtotime(date("Y-m-d")) ) {
                                            /*=============Do Not Change This ====================*/
                                            $date1 = $mis_paid_upto_date;
                                            $date2 = date('Y-m-d');

                                            $ts1 = strtotime($date1);
                                            $ts2 = strtotime($date2);

                                            $year1 = date('Y', $ts1);
                                            $year2 = date('Y', $ts2);

                                            $month1 = date('m', $ts1);
                                            $month2 = date('m', $ts2);

                                            $noOfMonth = (($year2 - $year1) * 12) + ($month2 - $month1);
                                            /*=============Do Not Change This ====================*/
                                      ?>
                                     <br><form action="#" method="post">
                                        <div class="form-group col-lg-2">
                                            <label for="MisAmount">MIS Amount <font style="color: #ff1e1e;">*</font></label>
                                            <input type="text" class="form-control input-sm" readonly="" value="<?php echo $customerPayAmount; ?>" name="MisAmount" id="MisAmount" placeholder="Enter Customer Name" required="">
                                        </div>
                                        <div class="form-group col-lg-2">
                                          <label for="noOfPayMis">No. Of Pay MIS <font style="color: #ff1e1e;">*</font></label>
                                          <select name="noOfPayMis" class="form-control" required="" id="noOfPayMis" onchange="manageMisAmount()">
                                               <?php for($i=1;$i<=$noOfMonth;$i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                                <?php } ?>
                                          </select>
                                        </div>
                                        <div class="form-group col-lg-2">
                                          <label for="payMisAmount">Pay Amount <font style="color: #ff1e1e;">*</font></label>
                                          <input type="text" class="form-control input-sm" readonly="" name="payMisAmount" id="payMisAmount" value="<?php echo $customerPayAmount; ?>" placeholder="" required="">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label for="transactionId">Transaction Id <font style="color: #ff1e1e;">*</font></label>
                                            <input type="text" class="form-control input-sm" id="transactionId" maxlength="12" name="transactionId" value="" id="transactionId" placeholder="Transaction Id" required>
                                        </div>
                                         <input type="hidden" name="availableNoOfMis" id="availableNoOfMis" value="<?php echo $availableNoOfMis;?>">  
                                        <div class="form-group col-lg-2">
                                            <input type="button" class="form-control btn-success payInstallment" id="payMisAmountButton" value="Pay Now" style="margin-top: 20px;" onclick="payCustomerMisAmount()">
                                        </div>
                                        
                                     </form>
                                     <?php
                                         }else{
                                              echo '<br><div class="alert alert-alert alert-dismissable" style="background-color: #e8ee39;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b style="color: black;"><i class="icon fa fa-warning"></i> You can not pay the MIS before the due date !</b>
                                                    </div>';
                                              }
                                         }
                                         $selectCustomerPayMis="SELECT pay_amount, on_of_pay_mis, pay_date, transaction_id FROM customer_pay_mis_history WHERE status=1 AND customer_id='{$customerId}'";
                                         $log->info("Select Customer pay MIS History (ajaxCommon.php) : $selectCustomerPayMis");
                                            $customerMisResult=$con->query($selectCustomerPayMis);
                                            $countCuMIS=mysqli_num_rows($customerMisResult);
                                            if($countCuMIS>0){
                                         ?>
                                     <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td colspan="5" class="bg-primary" style="text-align: center;"> <b style="color: #ffffff; text-align: center;">Customer Pay MIS Details</b></td>
                                                </tr>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Pay Date</th>
                                                    <th>No Of Pay MIS</th>
                                                    <th>Pay Amount</th>
                                                    <th>Transaction Id</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n=1;
                                                $totalPayMis=0;
                                                 while ($cuMisRow = mysqli_fetch_array($customerMisResult)) {
                                                   $totalPayMis+=$cuMisRow['pay_amount'];  
                                                ?>
                                                <tr>
                                                    <td style="border: none;"><?php echo $n;?></td>
                                                    <td style="border: none;"><?php echo "".date("l M,dS Y",strtotime($cuMisRow['pay_date']));?></span></td>
                                                    <td style="border: none;"><?php echo $cuMisRow['on_of_pay_mis'];?></td>
                                                    <td style="border: none;"><i class="fa fa-rupee"></i> <?php echo number_format($cuMisRow['pay_amount'], 2, '.', '') ;?></td>
                                                    <td style="border: none;"> <?php echo $cuMisRow['transaction_id'];?></td>
                                                </tr> 
                                                <?php
                                                 $n++;
                                                 }
                                                ?>
                                                <tr>
                                                    <td colspan="4" style="border-top: 1px solid black;"></td>
                                                    <td style="border-top: 1px solid black;"> <b>Total</b> <i class="fa fa-rupee"></i> <?php echo number_format($totalPayMis, 2, '.', '') ;?></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    <?php
                                   }
                                }
                break;
            /*=====================================Search Customer Details End===============================*/
            /*=====================================Pay Customer Mis Amount Start===============================*/
            case 'payCustomerMisAmount':
                $customerId=$_POST['customerId'];
                $totalPayMisAmount=$_POST['totalPayMisAmount'];
                $noOfPayMis=$_POST['noOfPayMis'];
                if(!empty($_POST['transactionId'])){
                    $transactionId=$_POST['transactionId'];
                }else{
                    $transactionId=0;
                }
                $selectCustomerMisInfo="SELECT customer_id, no_of_mis, no_of_pay_mis, mis_paid_upto_date FROM customer_mis_info WHERE customer_id='{$customerId}' AND status=1";
                $log->info("Select Customer Mis Info Details From ajaxCommon.php: $selectCustomerMisInfo");
                $misResult=$con->query($selectCustomerMisInfo);
                while ($misRow = mysqli_fetch_array($misResult)) {
                    $no_of_mis=$misRow['no_of_mis'];
                    $no_of_pay_mis=$misRow['no_of_pay_mis'];
                    $mis_paid_upto_date=$misRow['mis_paid_upto_date'];
                }
                /*========================New Mis Paid Date Create Start =====================================*/
                $date = strtotime(date("Y-m-d", strtotime($mis_paid_upto_date)) . " +$noOfPayMis month");
                $newMisPaidDate = date("Y-m-d",$date);
                $log->info("New Mis Paid Date From ajaxCommon.php: $newMisPaidDate");
                $currentDate=date('Y-m-d');
                /*========================New Mis Paid Date Create Start =====================================*/
                $insertCustomerPayMisHis="INSERT INTO customer_pay_mis_history (
                                                                                customer_id
                                                                               ,pay_amount
                                                                               ,on_of_pay_mis
                                                                               ,pay_date
                                                                               ,transaction_id
                                                                               ,c_by
                                                                               ,status
                                                                             ) VALUES (
                                                                                '{$customerId}' -- customer_id - IN varchar(50)
                                                                               ,'{$totalPayMisAmount}' -- pay_amount - IN double
                                                                               ,'{$noOfPayMis}' -- on_of_pay_mis - IN int(50)
                                                                               ,'{$currentDate}' -- pay_date - IN varchar(20)
                                                                               ,'{$transactionId}' -- transaction_id - IN varchar(30)
                                                                               ,'{$_SESSION['uid']}'  -- c_by - IN varchar(20)
                                                                               ,1 -- status - IN int(1)
                                                                             )";
                $log->info("Insert Customer Pay Mis History Detail from ajaxCommon.php: $insertCustomerPayMisHis");
                $resultCuPayHis=$con->query($insertCustomerPayMisHis);
                if($resultCuPayHis){
                    $totalPayMis=$no_of_pay_mis+$noOfPayMis;
                    $updateCustomerMis="UPDATE customer_mis_info SET no_of_pay_mis='{$totalPayMis}', mis_paid_upto_date='{$newMisPaidDate}' WHERE Customer_id='{$customerId}'";
                    $log->info("Update Customer Mis Info From ajaxCommon.php: $updateCustomerMis");
                    $resultUpdateMis=$con->query($updateCustomerMis);
                   if($resultUpdateMis){
                        $res=1;
                        echo json_encode($res);   
                      }else{
                        $error=0;
                        echo json_encode($error);
                      }    
                    }
                
                break;
               /*=====================================Pay Customer Mis Amount End===============================*/
               /*=====================================Search Installment For Deposite Start===============================*/
               case 'searchInstallment':
                        $customerID=$_POST['customerId'];
                        $planId=$_POST['planId'];
                        $token=$_POST['token'];
                        $selectCustomer="SELECT cu.name, cu.father, cu.dob, cu.date_of_joining, cu.expairy_date, cu.country, cu.gender, cu.post, cu.district, "
                                . "cu.pin_code, cu.address, cu.mobil_no, cu.gender, cu.nominee, cu.realation, cu.customer_img, "
                                . "cpm.agency_code, cpm.plan_name, cpm.plan_duration, cpm.plan_type, cpm.pay_mode, cpm.total_installment_amount, cpm.plan_type, cpm.installment_amount, "
                                . "cpm.no_of_installment, cpm.no_of_pay_installment, cih.customer_id, cih.reciept_no, cih.pay_amount, "
                                . "cih.pay_date, cih.no_of_installment AS cihNoOfInstallment FROM customer AS cu, customer_plan_mapping AS cpm, customer_installment_history AS cih "
                                . "WHERE cu.customer_id=cpm.customer_id AND cpm.customer_id = cih.customer_id AND cu.customer_id='{$customerID}' AND cpm.customer_id='{$customerID}' AND cih.customer_id='{$customerID}' AND cpm.plan_id='{$planId}'";
                            $log->info("Select customer from ajaxSearchDepositInstallment.php : $selectCustomer");
                            $customerResult=$con->query($selectCustomer);
                            $countCu=mysqli_num_rows($customerResult);
                            if($countCu>0){
                                while ($customerRow = mysqli_fetch_array($customerResult)) {
                                   $name=$customerRow['name'];
                                   $father=$customerRow['father'];
                                   $dob=$customerRow['dob'];
                                   $date_of_joining=$customerRow['date_of_joining'];
                                   $expairy_date=$customerRow['expairy_date'];
                                   $country=$customerRow['country'];
                                   $gender=$customerRow['gender'];
                                   $plan_type=$customerRow['plan_type'];
                                   $post=$customerRow['post'];
                                   $district=$customerRow['district'];
                                   $pin_code=$customerRow['pin_code'];
                                   $address=$customerRow['address'];
                                   $mobil_no=$customerRow['mobil_no'];
                                   $plan_name=$customerRow['plan_name'];
                                   $plan_duration=$customerRow['plan_duration'];
                                   $pay_mode=$customerRow['pay_mode'];
                                   $no_of_installment=$customerRow['no_of_installment'];
                                   $no_of_pay_installment=$customerRow['no_of_pay_installment'];
                                   $pay_amount[]=$customerRow['pay_amount'];
                                   $pay_date[]=$customerRow['pay_date'];
                                   $customer_id[]=$customerRow['customer_id'];
                                   $reciept_no[]=$customerRow['reciept_no'];
                                   $cihNoOfInstallment[]=$customerRow['cihNoOfInstallment'];

                                   $planAmount=$customerRow['total_installment_amount'];
                                   $installment_amount=$customerRow['installment_amount'];


                                }  
                                $availableInstallment=$no_of_installment-$no_of_pay_installment;
                            ?>

                                 <a href="#" class="btn btn-primary btn-block" style="padding-top: 1px; padding-bottom: 1px;"><b>Customer Detail</b></a>
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Father Name</th>
                                                <th>Address</th>
                                                <th>Date Of Joining</th>
                                                <th>Date Of Expiry</th>
                                                <th>Installment Amt</th>
                                                <th>Total Installment Amt</th>
                                                <th>Pay Mode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="border: none;"><?php echo $name;?></td>
                                                <td style="border: none;"><?php echo $father;?></td>
                                                <td style="border: none;"><?php echo $address. ','.$district. ','.$country. ','.$pin_code;?></td>
                                                <td style="border: none;"><?php echo $date_of_joining;?></td>
                                                <td style="border: none;"><span class="label label-danger"> <?php echo $expairy_date;?></span></td>
                                                <td style="border: none;"><i class="fa fa-rupee"></i> <?php echo $installment_amount; ?></td>
                                                <td style="border: none;"><i class="fa fa-rupee"></i> <?php echo $planAmount;?></td>

                                                <?php
                                                    if($plan_type=='RD'){
                                                    ?>
                                                    <td style="border: none;" class="bg-fuchsia"><?php echo "Regular";?></td>
                                                    <?php
                                                    }else if($plan_type=='MIS' OR $plan_type=='FD'){
                                                      ?>
                                                    <td class="bg-fuchsia" style="border: none;"><?php echo "Single";?></td>
                                                    <?php
                                                    }
                                                ?>
                                            </tr> 
                                        </tbody>
                                </table>
                                <a href="#" class="btn btn-primary btn-block" style="padding-top: 1px; padding-bottom: 1px; margin-top: 3px; margin-bottom: 3px;"><b>Installment Detail</b></a>
                                <?php
                                if($no_of_installment===$no_of_pay_installment){
                                 ?>
                                <div class="alert alert-alert alert-dismissable" style="background-color: #00733e;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b style="color: white;"><i class="icon fa fa-warning"></i>Total installment has been submitted to you (<?php echo $name;?>)!</b>
                                </div>
                                <?php
                                }else{
                                ?>
                                <form action="#" method="post">
                                <div class="form-group col-lg-2">
                                    <label for="name">Installment Amount <font style="color: #ff1e1e;">*</font></label>
                                    <input type="text" class="form-control input-sm" readonly="" value="<?php echo $installment_amount; ?>" name="instaAmount" id="instaAmount" placeholder="Enter Customer Name" required="">
                                </div>
                                <div class="form-group col-lg-2">
                                  <label for="fatherName">No. Of Installment <font style="color: #ff1e1e;">*</font></label>
                                  <input type="text" class="form-control input-sm" name="noOfInsta"  id="noOfInsta" placeholder="Enter No. Of Installment" onkeyup="manageAmount()" required="">
                                </div>
                                <div class="form-group col-lg-2">
                                  <label for="fatherName">Deposit Amount <font style="color: #ff1e1e;">*</font></label>
                                  <input type="text" class="form-control input-sm" readonly="" name="depositeAmount" id="depositeAmount"  placeholder="" required="">
                                </div>
                                <!--<div class="form-group col-lg-2">
                                  <label for="fatherName">Available Amount <font style="color: #ff1e1e;">*</font></label>
                                  <input type="text" class="form-control input-sm" readonly="" id="pAvailableAMT" name="pAvailableAMT" placeholder="">
                                </div> -->   
                                <div class="form-group col-lg-2">
                                    <input type="button" class="form-control btn-success payInstallment" disabled="" id="payInstallment" value="Pay Now" style="margin-top: 20px;">
                                </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="customerMobileNo" id="customerMobileNo"  value="<?php echo $mobil_no;?>">
                                <input type="hidden" name="no_of_pay_installment" id="no_of_pay_installment"  value="<?php echo $no_of_pay_installment;?>">
                                <input type="hidden" name="no_of_installment" id="no_of_installment"  value="<?php echo $no_of_installment;?>">
                                <input type="hidden" name="cuId" id="cuId"  value="<?php echo $_POST['customerId'];?>">
                                <input type="hidden" name="availableInstallment" id="availableInstallment"  value="<?php echo $availableInstallment;?>">
                                </form>
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #f80">
                                            <th>Receipt No</th>
                                            <th>Amount</th>
                                            <th>Pay Date</th>
                                            <th>No Of Installment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $paidAmount=0; 
                                        $selectCustomerIns="SELECT reciept_no, pay_amount, no_of_installment, pay_date FROM customer_installment_history WHERE status=1 AND customer_id='{$customerID}'";
                                        $log->info("$selectCustomerIns"); 
                                        $resultCuIns=$con->query($selectCustomerIns);
                                        while ($cuInsRow = mysqli_fetch_array($resultCuIns)) {
                                         $paidAmount+=$cuInsRow['pay_amount'];    
                                        ?>
                                        <tr>
                                            <td><?php echo $cuInsRow['reciept_no'];?></td>
                                            <td><?php echo $cuInsRow['pay_amount'];?></td>
                                            <td><?php echo $cuInsRow['pay_date'];?></td>
                                            <td><?php echo $cuInsRow['no_of_installment'];?></td>
                                            <td><a target="_blank" href="printSingleInstallment.php?token=<?php echo $token;?>&receiptNo=<?php echo $cuInsRow['reciept_no'];?>&cuId=<?php echo $customerID;?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Detail</a></td>
                                        </tr>
                                        <?php
                                        }
                                        /*echo $availableAmount= $planAmount-$paidAmount;*/
                                        ?>
                                        <tr>
                                           <!-- <input type="hidden" value="<?php echo $availableAmount; ?>" id="availableAmt">-->
                                            <td><b>Total</b> </td>
                                            <td colspan="3"><i class="fa fa-rupee"></i> <?php echo number_format($paidAmount, 2, '.', '') ;?></td>
                                            <td colspan=""><a target="_blank" href="printTotalInstallment.php?token=<?php echo $token;?>&cuId=<?php echo $customerID;?>" class="btn btn-foursquare btn-xs"><i class="fa fa-print"></i> Print Receipt</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php
                            }else{
                                echo '<div class="alert alert-alert alert-dismissable" style="background-color: #b01a1a;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b style="color: white;"><i class="icon fa fa-warning"></i>Data not match !</b>
                                    </div>';
                            }
                   
                   break;
               /*=====================================Search Installment For Deposite End===============================*/
               /*=====================================Search searchCustomerPlanName For installment start===============================*/
               case 'searchCustomerPlanName':
                   $customerID=$_POST['customerId'];
                   ?>
                            <div class="form-group col-lg-3">
                                <label for="planName"> Plan Name <font style="color: #ff1e1e;">*</font></label>
                                <select name="planId" class="form-control col-lg-6 input-sm"  id="planId" required>
                                    <option value=""> -- Select Plan Name -- </option>
                                    <?php
                                    $selectPlan="SELECT plan_name, plan_id, plan_type FROM customer_plan_mapping WHERE status=1 AND customer_id='{$customerID}'";
                                    $planResult=$con->query($selectPlan);
                                    while ($planRow = mysqli_fetch_array($planResult)) {
                                     ?>
                                      <option value="<?php echo $planRow['plan_id']?>"><?php echo $planRow['plan_name'].'-'.$planRow['plan_type']?></option>
                                    <?php
                                     }
                                    ?>
                                </select>
                            </div>  
                            <!-- /.box-body -->
                            <div class="form-group col-lg-3" style="margin-top: 20px;">
                                <button type="button" class="btn btn-primary" onclick="searchInstallment()">Search</button>
                            </div> 
            <?php
            break;
               /*=====================================Search searchCustomerPlanName For installment end===============================*/
}





















