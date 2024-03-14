<?php
include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$planId=$_POST['planId'];
$payMode=$_POST['payMode'];
$installmentAmt=$_POST['installmentAmt'];
$dateOfJoining=$_POST['dateOfJoining'];
$selectPlan="SELECT plan_name, duration_month, commission_in_per, plan_type, interest_rate_in_per FROM plan WHERE plan_id='{$planId}'";
$log->info("Select Plan from ajaxPlanDetails.php: $selectPlan");
$rePlan=$con->query($selectPlan);
while ($planRow = mysqli_fetch_array($rePlan)) {
      $planName=$planRow['plan_name'];
      $planDuration=$planRow['duration_month'];
      $planType=$planRow['plan_type'];
      $interest_rate_in_per=$planRow['interest_rate_in_per'];
}
//echo $dateOfJoining;
/*$expairyDate = date('Y-m-d', strtotime("+$planDuration month"));*/
$date = strtotime(date("Y-m-d", strtotime($dateOfJoining)) . " +$planDuration month");
$expDate = date("Y-m-d",$date);
$currentDate=date('Y-m-d');
/*$days = (strtotime($expairyDate) - strtotime($currentDate)) / (60 * 60 * 24)-1;*/
$dateOfJoiningCreateDate = date_create("$dateOfJoining");
$expDateCreateDate = date_create("$expDate");
$dayDiff= date_diff($dateOfJoiningCreateDate, $expDateCreateDate);
/*echo 'Days Count - '.$dayDiff->format("%a");*/
$days=$dayDiff->format("%a");
//$maturity=$installmentAmt*$interest_rate_in_per/100;
//$matirityReturn=$installmentAmt+$maturity;
?>
<?php
/*=======================================If Pay mode daily start=======================================================*/
if($payMode==='daily'){
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #3dd5a7;">
            <th style="padding-top: 1px; margin: 1px;">Terms Of Plan</th>
            <th style="padding-top: 1px; margin: 1px;">Installment Amt</th>
            <th style="padding-top: 1px; margin: 1px;">Plan Type</th>
            <!--<th style="padding-top: 1px; margin: 1px;">Joining Date</th>-->
            <th style="padding-top: 1px; margin: 1px;">Expiry Date of Agreement</th>
            <th style="padding-top: 1px; margin: 1px;">Maturity Return</th>
            <th style="padding-top: 1px; margin: 1px;">Total Installment </th>
          </tr>
    </thead>
    <tbody>
        <?php
        $totalInstallment=$installmentAmt*$days;
        $maturity=$totalInstallment*$interest_rate_in_per/100;
        $matirityReturn=$totalInstallment+$maturity; 
        
        //$A=$installmentAmt(1+$interest_rate_in_per)
        ?>
        <tr>
            <input type="hidden" name="no_of_installment" value="<?php echo $days;?>">
            <input type="hidden" name="expDate" value="<?php echo $expDate;?>">
            <input type="hidden" name="installmentAmount" value="<?php echo $installmentAmt;?>">
            <input type="hidden" name="totalInstallmentAmount" value="<?php echo round($totalInstallment) ;?>">
            <td><?php echo $planDuration;?> Month</td>
            <td><?php echo $installmentAmt;?></td>
            <td><?php echo $planType;?></td>
            <!--<td><?php echo $currentDate;?></td>-->
            <!--<td><span class="label label-danger"><?php echo $expairyDate;?></span></td>-->
            <td><span class="label label-danger"><?php echo $expDate;?></span></td>
            <td><input type="text" name="maturityReturn" required=""></td>
            <td><i class="fa fa-rupee"></i> <?php echo round($totalInstallment) ;?> </td>
        </tr>
    </tbody>
</table>
<?php
}
/*===================================If Pay Mode daily end ===========================================================*/
/*===================================If Pay Mode Weekly Start ===========================================================*/
if($payMode==='monthly'){
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #3dd5a7;">
            <th style="padding-top: 1px; margin: 1px;">Terms Of Plan</th>
            <th style="padding-top: 1px; margin: 1px;">Installment Amt</th>
            <th style="padding-top: 1px; margin: 1px;">Plan Type</th>
            <!--<th style="padding-top: 1px; margin: 1px;">Joining Date</th>-->
            <th style="padding-top: 1px; margin: 1px;">Expiry Date of Agreement</th>
            <th style="padding-top: 1px; margin: 1px;">Maturity Return</th>
            <th style="padding-top: 1px; margin: 1px;">Total Installment </th>
          </tr>
    </thead>
    <tbody>
        <?php
        $totalInstallment=$installmentAmt*$planDuration;
        $maturity=$totalInstallment*$interest_rate_in_per/100;
        $matirityReturn=$totalInstallment+$maturity;   
        ?>
        <tr>
            <input type="hidden" name="no_of_installment" value="<?php echo $planDuration;?>">
            <input type="hidden" name="expDate" value="<?php echo $expDate;?>">
            <input type="hidden" name="installmentAmount" value="<?php echo $installmentAmt;?>">
            <input type="hidden" name="totalInstallmentAmount" value="<?php echo number_format($totalInstallment, 2, '.', '') ;?>">
            <td><?php echo $planDuration;?> Month</td>
            <td><?php echo $installmentAmt;?></td>
            <td><?php echo $planType;?></td>
            <!--<td><?php echo $currentDate;?></td>-->
            <!--<td><span class="label label-danger"><?php echo $expairyDate;?></span></td>-->
            <td><span class="label label-danger"><?php echo $expDate;?></span></td>
            <td><input type="text" name="maturityReturn" required=""></td>
            <td><i class="fa fa-rupee"></i> <?php echo number_format($totalInstallment, 2, '.', '') ;?> </td>
        </tr>
    </tbody>
</table>
<?php
}
/*===================================If Pay Mode Weekly end ===========================================================*/
if($payMode==='quarterly'){
/*===================================If Pay Mode quarterly Start ===========================================================*/
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #3dd5a7;">
            <th style="padding-top: 1px; margin: 1px;">Terms Of Plan</th>
            <th style="padding-top: 1px; margin: 1px;">Installment Amt</th>
            <th style="padding-top: 1px; margin: 1px;">Plan Type</th>
            <!--<th style="padding-top: 1px; margin: 1px;">Joining Date</th>-->
            <th style="padding-top: 1px; margin: 1px;">Expiry Date of Agreement</th>
            <th style="padding-top: 1px; margin: 1px;">Maturity Return</th>
            <th style="padding-top: 1px; margin: 1px;">Total Installment </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $quarter=$planDuration/3;
        $totalInstallment=$installmentAmt*$quarter;
        $maturity=$totalInstallment*$interest_rate_in_per/100;
        $matirityReturn=$totalInstallment+$maturity;  
        ?>
        <tr>
            <input type="hidden" name="no_of_installment" value="<?php echo $quarter;?>">
            <input type="hidden" name="expDate" value="<?php echo $expDate;?>">
            <input type="hidden" name="installmentAmount" value="<?php echo $installmentAmt;?>">
            <input type="hidden" name="totalInstallmentAmount" value="<?php echo number_format($totalInstallment, 2, '.', '') ;?>">
            <td><?php echo $planDuration;?> Month</td>
            <td><?php echo $installmentAmt;?></td>
            <td><?php echo $planType;?></td>
            <!--<td><?php echo $currentDate;?></td>-->
            <!--<td><span class="label label-danger"><?php echo $expairyDate;?></span></td>-->
            <td><span class="label label-danger"><?php echo $expDate;?></span></td>
            <td><input type="text" name="maturityReturn" required=""></td>
            <td><i class="fa fa-rupee"></i> <?php echo number_format($totalInstallment, 2, '.', '') ;?> <span class="label label-success">  Quarterly</span></td>
        </tr>
    </tbody>
</table>
<?php
/*===================================If Pay Mode quarterly end ===========================================================*/
}
/*===================================If Pay Mode halfyearly start ===========================================================*/
if($payMode==='halfyearly'){
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #3dd5a7;">
            <th style="padding-top: 1px; margin: 1px;">Terms Of Plan</th>
            <th style="padding-top: 1px; margin: 1px;">Installment Amt</th>
            <th style="padding-top: 1px; margin: 1px;">Plan Type</th>
            <!--<th style="padding-top: 1px; margin: 1px;">Joining Date</th>-->
            <th style="padding-top: 1px; margin: 1px;">Expiry Date of Agreement</th>
            <th style="padding-top: 1px; margin: 1px;">Maturity Return</th>
            <th style="padding-top: 1px; margin: 1px;">Total Installment </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $halfYear=$planDuration/6;
        $totalInstallment=$installmentAmt*$halfYear;
        $maturity=$totalInstallment*$interest_rate_in_per/100;
        $matirityReturn=$totalInstallment+$maturity;  
        ?>
        <tr>
            <input type="hidden" name="no_of_installment" value="<?php echo $halfYear;?>">
            <input type="hidden" name="expDate" value="<?php echo $expDate;?>">
            <input type="hidden" name="installmentAmount" value="<?php echo $installmentAmt;?>">
            <input type="hidden" name="totalInstallmentAmount" value="<?php echo number_format($totalInstallment, 2, '.', '') ;?>">
            <td><?php echo $planDuration;?> Month</td>
            <td><?php echo $installmentAmt;?></td>
            <td><?php echo $planType;?></td>
            <!--<td><?php echo $currentDate;?></td>-->
            <!--<td><span class="label label-danger"><?php echo $expairyDate;?></span></td>-->
            <td><span class="label label-danger"><?php echo $expDate;?></span></td>
            <td><input type="text" name="maturityReturn" required=""></td>
            <td><i class="fa fa-rupee"></i> <?php echo number_format($totalInstallment, 2, '.', '') ;?> </td>
        </tr>
    </tbody>
</table>
<?php    
}
/*===================================If Pay Mode halfyearly end ===========================================================*/
/*===================================If Pay Mode Yearly start ===========================================================*/
if($payMode==='yearly'){
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #3dd5a7;">
            <th style="padding-top: 1px; margin: 1px;">Terms Of Plan</th>
            <th style="padding-top: 1px; margin: 1px;">Installment Amt</th>
            <th style="padding-top: 1px; margin: 1px;">Plan Type</th>
            <!--<th style="padding-top: 1px; margin: 1px;">Joining Date</th>-->
            <th style="padding-top: 1px; margin: 1px;">Expiry Date of Agreement</th>
            <th style="padding-top: 1px; margin: 1px;">Maturity Return</th>
            <th style="padding-top: 1px; margin: 1px;">Total Installment </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $year=$planDuration/12;
        $totalInstallment=$installmentAmt*$year;
        $maturity=$totalInstallment*$interest_rate_in_per/100;
        $matirityReturn=$totalInstallment+$maturity;  
        ?>
        <tr>
            <input type="hidden" name="no_of_installment" value="<?php echo $year;?>">
            <input type="hidden" name="expDate" value="<?php echo $expDate;?>">
            <input type="hidden" name="installmentAmount" value="<?php echo $installmentAmt;?>">
            <input type="hidden" name="totalInstallmentAmount" value="<?php echo number_format($totalInstallment, 2, '.', '') ;?>">
            <td><?php echo $planDuration;?> Month</td>
            <td><?php echo $installmentAmt;?></td>
            <td><?php echo $planType;?></td>
            <!--<td><?php echo $currentDate;?></td>-->
            <!--<td><span class="label label-danger"><?php echo $expairyDate;?></span></td>-->
            <td><span class="label label-danger"><?php echo $expDate;?></span></td>
            <td><input type="text" name="maturityReturn" required=""></td>
            <td><?php echo number_format($totalInstallment, 2, '.', '') ;?>  <i class="fa fa-rupee"></i></td>
        </tr>
    </tbody>
</table>
    
<?php    
}
/*===================================If Pay Mode Yearly end ===========================================================*/
/*===================================If Pay Mode Fix Deposite start ===========================================================*/
if($payMode==='fixdeposite'){
    $totalInstallment=$installmentAmt;
    $maturity=$totalInstallment*$interest_rate_in_per/100;
    $matirityReturn=$totalInstallment+$maturity;    
?> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #3dd5a7;">
            <th style="padding-top: 1px; margin: 1px;">Terms Of Plan</th>
            <th style="padding-top: 1px; margin: 1px;">Installment Amt</th>
            <th style="padding-top: 1px; margin: 1px;">Plan Type</th>
            <!--<th style="padding-top: 1px; margin: 1px;">Joining Date</th>-->
            <th style="padding-top: 1px; margin: 1px;">Expiry Date of Agreement</th>
            <th style="padding-top: 1px; margin: 1px;">Maturity Return</th>
            <th style="padding-top: 1px; margin: 1px;">Total Installment </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <input type="hidden" name="no_of_installment" value="1">
            <input type="hidden" name="expDate" value="<?php echo $expDate;?>">
            <input type="hidden" name="installmentAmount" value="<?php echo $installmentAmt;?>">
            <input type="hidden" name="totalInstallmentAmount" value="<?php echo number_format($totalInstallment, 2, '.', '') ;?>">
            <td><?php echo $planDuration;?> Month</td>
            <td><?php echo $installmentAmt;?></td>
            <td><?php echo $planType;?></td>
            <!--<td><?php echo $currentDate;?></td>-->
            <!--<td><span class="label label-danger"><?php echo $expairyDate;?></span></td>-->
            <td><span class="label label-danger"><?php echo $expDate;?></span></td>
            <td><input type="text" name="maturityReturn" required=""></td>
            <td><i class="fa fa-rupee"></i> <?php echo number_format($totalInstallment, 2, '.', '') ;?> <span class="label label-success">  Fix Deposit</span></td>
        </tr>
    </tbody>
</table>
<?php    
}
/*===================================If Pay Mode Fix Deposite end ===========================================================*/