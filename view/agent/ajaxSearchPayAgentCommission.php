<?php
include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$token=$_POST['token'];
$agencyId=$_POST['agencyId'];
$selectAgent="SELECT a.id, a.agency_code, a.branch_id, a.agent_name, a.country, a.state, a.district, a.post, a.pin_code, "
        . "a.address, a.mobile_no, a.email, a.bank_name, a.email, a.bank_account_no, a.bank_ifsc_code,"
        . " a.account_holder_name, a.bank_branch_name, ach.no_of_installment, ach.commission_amount, ach.pay_date, ach.agency_code,"
        . "a.aadhar_card_no, a.pan_card_no, a.c_date, cu.id, cu.customer_id, cu.agency_code "
        . "FROM agent AS a, customer AS cu, agent_commission_history AS ach "
        . "WHERE a.agency_code = cu.agency_code AND a.agency_code = ach.agency_code AND a.agency_code='{$agencyId}' AND cu.agency_code='{$agencyId}' AND ach.agency_code='{$agencyId}' AND cu.status=1 AND a.status=1";
$log->info("Select agent and customer from ajaxSearchPayAgentCommission.php : $selectAgent");
$agentResult=$con->query($selectAgent);
    $countCu=mysqli_num_rows($agentResult);
    if($countCu>0){
        while ($agentRow = mysqli_fetch_array($agentResult)) {
            $agent_name=$agentRow['agent_name'];
            $country=$agentRow['country'];
            $state=$agentRow['state'];
            $district=$agentRow['district'];
            $post=$agentRow['post'];
            $pin_code=$agentRow['pin_code'];
            $address=$agentRow['address'];
            $mobile_no=$agentRow['mobile_no'];
            $bank_name=$agentRow['bank_name'];
            $bank_account_no=$agentRow['bank_account_no'];
            $account_holder_name=$agentRow['account_holder_name'];
            $bank_branch_name=$agentRow['bank_branch_name'];
            $bank_ifsc_code=$agentRow['bank_ifsc_code'];
            $aadhar_card_no=$agentRow['aadhar_card_no'];
            $pan_card_no=$agentRow['pan_card_no'];
            $registerDate=$agentRow['c_date'];
            $email=$agentRow['email'];
        }
        ?>
          <?php
          $totalCommissionAmount=0;
          $selectAgentCommission="SELECT commission_amount, pay_date, agency_code FROM agent_commission_history WHERE status=1 AND agency_code='{$agencyId}'";
          $log->info("Select agent commission history from ajaxSearchPayAgentCommission.php: $selectAgentCommission");
          $agentResult1=$con->query($selectAgentCommission);
          while ($agentRow1 = mysqli_fetch_array($agentResult1)) {
              $totalCommissionAmount+=$agentRow1['commission_amount'];
              $agencyIdAchArray[]=$agentRow1['agency_code'];
              $commission_amountAchArray[]=$agentRow1['commission_amount'];
              $pay_dateAchArray[]=$agentRow1['pay_date'];
              
          }
          $totalPayCommissionAmount=0;
          $selectTotalPayCommission="SELECT agency_code, pay_amount, pay_date FROM agent_pay_commission_history WHERE status=1 AND agency_code='{$agencyId}'";
          $log->info("Select Total Pay Commission: $selectTotalPayCommission");
          $agentResult2=$con->query($selectTotalPayCommission);
          while ($agentRow2 = mysqli_fetch_array($agentResult2)) {
              $totalPayCommissionAmount+=$agentRow2['pay_amount'];
              $totalPayCommissionAr[]=$agentRow2['pay_amount'];
              $payDateAr[]=$agentRow2['pay_date'];
              $agencyCodeAr[]=$agentRow2['agency_code'];
          } 
          $availableAmount=$totalCommissionAmount-$totalPayCommissionAmount;
          ?>
           <a href="#" class="btn btn-primary btn-block" style="padding-top: 1px; padding-bottom: 1px; margin-top: -20px;"><b>Agent Detail</b></a>
           <table id="example1" class="table table-bordered" style="margin-top: 0px;">
               <tr style="padding: 0px; margin: 0px;">
                    <th style="padding: 2px; margin: 2px;">Agent Name/Id</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $agent_name.' /'.$agencyId;?></td>
                    <th style="padding: 2px; margin: 2px;">Address</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $address. ','.$district. ','.$country. ','.$pin_code;?></td>
                    <th style="padding: 2px; margin: 2px;">Mobile No</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $mobile_no;?></td>
                </tr>
                <tr style="padding: 0px; margin: 0px;">
                    <th style="padding: 2px; margin: 2px;">E-mail</th>
                    <td style="padding: 2px; margin: 2px;"><?php if(!empty($email)){ echo $email;}else{ echo "Not available";}?></td>
                    <th style="padding: 2px; margin: 2px;">Register Date</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo "".date("l M,dS Y",strtotime($registerDate));?></td>
                    <th style="padding: 2px; margin: 2px;">Bank Name</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $bank_name;?></td>
                </tr>
                <tr style="padding: 0px; margin: 0px;">
                    <th style="padding: 2px; margin: 2px;">Branch Name</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $bank_branch_name;?></td>
                    <th style="padding: 2px; margin: 2px;">IFSC Code</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $bank_ifsc_code;?></td>
                    <th style="padding: 2px; margin: 2px;">Account Holder Name</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $account_holder_name;?></td>
                </tr>
                <tr style="padding: 0px; margin: 0px;">
                    <th style="padding: 2px; margin: 2px;">Aadhar Card No</th>
                    <td style="padding: 2px; margin: 2px;"><?php echo $aadhar_card_no;?></td>
                    <th style="padding: 2px; margin: 2px;">Pan Card No.</th>
                    <td style="padding: 2px; margin: 2px;"><?php if(!empty($pan_card_no)){echo $pan_card_no;}else{echo "Not available";}?></td>
                    <td style="background-color: #13c6a4; color: white; padding: 2px; margin: 2px;">Your Total Commission Amount</td>
                    <td style="padding: 2px; margin: 2px;"><i class="fa fa-rupee"></i> <?php echo number_format($totalCommissionAmount, 2, '.', '') ;?></td>
                </tr>
        </table>
           <table style="margin-top: 10px;">
            <tr>
                <th>Pending Amount <i class="fa fa-rupee"></i></th>
                <th style="padding-left: 30px;">Pay Amount <i class="fa fa-rupee"></i></th>
                <th style="padding-left: 30px;"></th>
            </tr>
            <tr>
                <td><input type="text" class="form-control input-sm" readonly="" value="<?php echo $availableAmount;?>" id="availableAmount" required=""></td>
                <td style="padding-left: 30px;"><input type="text" class="form-control input-sm" min="0" pattern="[0-9]" onkeyup="manageCommissionAmount()"  name="commissionPayAmt" id="commissionPayAmt" placeholder="Enter Amount" required=""></td>
                <td style="padding-left: 30px;"><input type="button" id="payCommissionAmountButton" class="form-control btn-success payInstallment" onclick="payAgentCommission()" disabled="" value="Pay Now"></td>
            </tr>
        </table>
           <!--======================Agent payment detail start=================================-->
           <div style="width: 100%;">
           <table class="table table-bordered" style="margin-top: 20px; width: 50%; float: left;">
               <tr style="background-color: #13c6a4;">
                   <td colspan="3" style="padding: 4px; margin: 4px; text-align: center"><b>Agent Payment Detail</b></td>
               </tr>
               <tr style="background-color: #13c6a4;">
                   <th style="padding: 4px; margin: 4px;">Sr No.</th>
                   <th style="padding: 4px; margin: 4px;">Amount </th>
                   <th style="padding: 4px; margin: 4px;">Date</th>
               </tr>
               <?php
                $sr=1;
                for($i=0; $i<count($agencyCodeAr); $i++){
               ?>
               <tr>
                   <td style="padding: 4px; margin: 4px;"><?php echo $sr;?></td>
                   <td style="padding: 4px; margin: 4px;"><i class="fa fa-rupee"></i> <?php echo $totalPayCommissionAr[$i]; ?></td>
                   <td style="padding: 4px; margin: 4px;"><?php echo "".date("l M,dS Y",strtotime($payDateAr[$i]));?></td>
               </tr>
               <?php
               $sr++;
                }
               ?>
           </table>
            <!--======================Agent payment detail End=================================-->
            <!--======================Agent Commission detail Start=================================-->
            <table class="table table-bordered" style="margin-top: 20px; width: 47%; display: inline-block; margin-left: 3%;">
               <tr style="background-color: #13c6a4;">
                   <td colspan="3" style="padding: 4px; margin: 4px; text-align: center"><b>Agent Commission Detail</b></td>
               </tr>
               <tr style="background-color: #13c6a4;">
                   <th style="padding: 4px; margin: 4px; width: 200px;">Sr No.</th>
                   <th style="padding: 4px; margin: 4px; width: 150px;">Amount </th>
                   <th style="padding: 4px; margin: 4px;width: 150px;">Date</th>
               </tr>
               <?php
                $srNo=1;
                for($j=0; $j<count($agencyIdAchArray); $j++){
               ?>
               <tr>
                   <td style="padding: 4px; margin: 4px;"><?php echo $srNo;?></td>
                   <td style="padding: 4px; margin: 4px;"><i class="fa fa-rupee"></i> <?php echo $commission_amountAchArray[$j]; ?></td>
                   <td style="padding: 4px; margin: 4px;"><?php echo "".date("l M,dS Y",strtotime($pay_dateAchArray[$j]));?></td>
               </tr>
               <?php
               $srNo++;
                }
               ?>
           </table>
            
            <!--======================Agent Commission detail End=================================-->
           </div>
        <?php
    }else{
         echo '<div class="alert alert-alert alert-dismissable" style="background-color: #b01a1a;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b style="color: white;"><i class="icon fa fa-warning"></i>This agent is not add any customer !</b>
            </div>';
    }
    ?>
    
               
               