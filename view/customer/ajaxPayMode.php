<?php
include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$planId=$_POST['planId'];
$selectPlan="SELECT plan_name, duration_month, commission_in_per, plan_type, interest_rate_in_per FROM plan WHERE plan_id='{$planId}'";
$log->info("Select Plan from ajaxPlanDetails.php: $selectPlan");
$rePlan=$con->query($selectPlan);
while ($planRow = mysqli_fetch_array($rePlan)) {
      $planName=$planRow['plan_name'];
      $planDuration=$planRow['duration_month'];
      $planType=$planRow['plan_type'];
}
if($planType == 'FD' OR $planType=='MIS'){
?>
<div class="form-group col-lg-3">
  <label for="payMode"> Pay Mode <font style="color: #ff1e1e;">*</font></label>
  <select name="payMode" class="form-control col-lg-6 input-sm"  id="payMode"  onchange="checkPlan()" required="">
      <option value=""> -- Select Pay Mode -- </option>
      <option value="fixdeposite"> Fix Deposite </option>
  </select>
</div>
<?php
}else{
?>
<div class="form-group col-lg-3">
  <label for="payMode"> Pay Mode <font style="color: #ff1e1e;">*</font></label>
  <select name="payMode" class="form-control col-lg-6 input-sm"  id="payMode"  onchange="checkPlan()" required="">
      <option value=""> -- Select Pay Mode -- </option>
      <option value="daily"> Daily </option>
      <option value="monthly"> Monthly </option>
      <option value="quarterly"> Quarterly </option>
      <option value="halfyearly"> Half Yearly </option>
      <option value="yearly"> Yearly </option>

  </select>
</div>
<?php    
}
?>