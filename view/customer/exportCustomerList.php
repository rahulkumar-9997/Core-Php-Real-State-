<?php
include '../../controller/config/dbConfigExcel.php';
include '../../PHPExcel/Classes/PHPExcel.php';
include '../../PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A1', "Registration No.");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Customer Name");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Father Name");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "DOB");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "Joining Date");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "Expiry Date");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "Aadhar Card No.");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "Pan Card No.");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "Gender");
$objPHPExcel->getActiveSheet()->setCellValue('J1', "Mobile No.");
$objPHPExcel->getActiveSheet()->setCellValue('K1', "Bank Name");
$objPHPExcel->getActiveSheet()->setCellValue('L1', "Account No.");
$objPHPExcel->getActiveSheet()->setCellValue('M1', "Account Holder Name");
$objPHPExcel->getActiveSheet()->setCellValue('N1', "Plan Name");
$objPHPExcel->getActiveSheet()->setCellValue('O1', "Plan Type");
$objPHPExcel->getActiveSheet()->setCellValue('P1', "Plan Duration (Month)");
$objPHPExcel->getActiveSheet()->setCellValue('Q1', "Pay Mode");
$objPHPExcel->getActiveSheet()->setCellValue('R1', "Total Installment Amt.");
$objPHPExcel->getActiveSheet()->setCellValue('S1', "Installment Amt.");
$objPHPExcel->getActiveSheet()->setCellValue('T1', "Maturity Return Amt.");
//formate at 2 decimal places
$objPHPExcel->getActiveSheet()->getStyle('D:G')->getNumberFormat()->setFormatCode('0.00');
$query = "SELECT cu.id, cu.customer_id, cu.registration_no, cu.sr_no, cu.agency_code, cu.branch_id, cu.name,"
        . " cu.father, cu.customer_relationship, cu.dob, cu.date_of_joining, cu.expairy_date, cu.country, "
        . "cu.post, cu.district, cu.pin_code, cu.address, cu.mobil_no, cu.gender, cu.aadhar_card_no, cu.pan_card_no,"
        . " cu.bank_name, cu.account_no, cu.ifsc_code, cu.bank_branch_name, cu.account_holder_name, cu.nominee, cu.realation,"
        . " cu.nominee_date_of_birth,  cu.status, cu.claimed_maturity_payment_status, cu.maturity_return_paid_date, "
        . "cpm.customer_id, cpm.agency_code, cpm.branch_id, cpm.plan_id, cpm.plan_name, cpm.plan_duration, cpm.commision_in_per, "
        . "cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, cpm.total_installment_amount, cpm.installment_amount,"
        . " cpm.no_of_installment, cpm.no_of_pay_installment, cpm.maturity_return "
        . "FROM customer AS cu, customer_plan_mapping AS cpm "
        . "WHERE cu.customer_id = cpm.customer_id AND cu.status = cpm.status AND cu.status=1 AND cpm.status=1";
$result = $con -> query($query);
while ($row=  mysqli_fetch_array($result)){
$data[]=array(
   'registrationNo'=>$row['registration_no'], 
   'name'=>$row['name'], 
   'father'=>$row['father'], 
   'customerRelationship'=>$row['customer_relationship'], 
   'dob'=>$row['dob'], 
   'dateOfJoining'=>$row['date_of_joining'], 
   'expairyDate'=>$row['expairy_date'], 
   'country'=>$row['country'], 
   'post'=>$row['post'], 
   'district'=>$row['district'], 
   'pinCode'=>$row['pin_code'], 
   'mobileNo'=>$row['mobil_no'], 
   'gender'=>$row['gender'], 
   'aadharCardNo'=>$row['aadhar_card_no'], 
   'panCardNo'=>$row['pan_card_no'], 
   'bankName'=>$row['bank_name'], 
   'accountNo'=>$row['account_no'], 
   'ifsc_code'=>$row['ifsc_code'], 
   'accountHolderName'=>$row['account_holder_name'], 
   'nominee'=>$row['nominee'], 
   'realation'=>$row['realation'], 
   'planName'=>$row['plan_name'], 
   'planType'=>$row['plan_type'], 
   'planDuration'=>$row['plan_duration'], 
   'noOfInstallment'=>$row['no_of_installment'], 
   'payMode'=>$row['pay_mode'], 
   'noOfPayInstallment'=>$row['no_of_pay_installment'], 
   'totalInstallmentAmount'=>$row['total_installment_amount'], 
   'installmentAmount'=>$row['installment_amount'], 
   'maturityReturn'=>$row['maturity_return'], 
);
}
$columnIncrement = 2;
foreach ($data as $key=>$v) {
     $date_of_joining=$v['dateOfJoining'];
     $expairy_date=$v['expairyDate'];
     $dob=$v['dob'];
     $FormateJoiningDate= date("d/m/Y", strtotime($date_of_joining));
     $FormateExpairyDate= date("d/m/Y", strtotime($expairy_date));
     $FormateDob= date("d/m/Y", strtotime($dob));
     /*=====Define plan type for excel sheet======*/
     /*if($planType=='RD'){
        $newPlanType="Regular";
     }else if($plan_type=='MIS' OR $plan_type=='FD'){
        $newPlanType="Single";
     }*/
    /*=====Define plan type for excel sheet======*/
        
                $columnChar = 'A';
                
	        $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['registrationNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, strtoupper($v['name']));
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, strtoupper($v['father']));
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $FormateDob);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $FormateJoiningDate);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $FormateExpairyDate);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['aadharCardNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['panCardNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['gender']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['mobileNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['bankName']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['accountNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['accountHolderName']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['planName']);
                if($v['planType']=='RD'){
                 $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, 'Regular');   
                }elseif ($v['planType']=='MIS' OR $v['planType']=='FD') {
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, 'Single');   
                }
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['planDuration']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['payMode']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['totalInstallmentAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['installmentAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['maturityReturn']);
                 
                $columnIncrement++;
               
     }
        foreach (range('A', 'T') as $column){
        $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(TRUE);
    }
  
// Redirect output to a client’s web browser (Excel5)
$filename = "ALLCUSTOMERLISTDATA_".date('d-M-Y');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$filename.xls");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>