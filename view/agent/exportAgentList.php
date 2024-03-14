<?php
include '../../controller/config/dbConfigExcel.php';
include '../../PHPExcel/Classes/PHPExcel.php';
include '../../PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A1', "Agency Code");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Agent Name");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Address");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "Mobile No.");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "Email Id");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "Bank Name");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "IFSC Code");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "Account Holder Name");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "aadhar Card No.");
$objPHPExcel->getActiveSheet()->setCellValue('J1', "Pan Card No.");
$objPHPExcel->getActiveSheet()->setCellValue('K1', "Register Date.");
$query ="SELECT agency_code, branch_id, agent_name, country, district, state, post, pin_code,  c_date, mobile_no,"
        . " address, email, bank_account_no, bank_name, bank_ifsc_code, account_holder_name, aadhar_card_no, "
        . "pan_card_no FROM agent WHERE status=1";
$result = $con -> query($query);
while ($row=  mysqli_fetch_array($result)){
$data[]=array(
   'agencyCode'=>$row['agency_code'], 
   'agentName'=>$row['agent_name'], 
   'country'=>$row['country'], 
   'district'=>$row['district'], 
   'state'=>$row['state'], 
   'post'=>$row['post'], 
   'pinCode'=>$row['pin_code'], 
   'mobileNo'=>$row['mobile_no'], 
   'address'=>$row['address'], 
   'email'=>$row['email'], 
   'bankAccountNo'=>$row['bank_account_no'], 
   'bankName'=>$row['bank_name'], 
   'bankIfscCode'=>$row['bank_ifsc_code'], 
   'accountHolderName'=>$row['account_holder_name'], 
   'aadharCardNo'=>$row['aadhar_card_no'], 
   'panCardNo'=>$row['pan_card_no'], 
   'regDate'=>$row['c_date'], 
);
}
$columnIncrement = 2;
foreach ($data as $key=>$v) {
     $regiDate=$v['regDate'];
     $newRegiDate= date("d/m/Y", strtotime($regiDate));
     /*=====Define plan type for excel sheet======*/
     /*if($planType=='RD'){
        $newPlanType="Regular";
     }else if($plan_type=='MIS' OR $plan_type=='FD'){
        $newPlanType="Single";
     }*/
    /*=====Define plan type for excel sheet======*/
        
                $columnChar = 'A';
                
	        $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['agencyCode']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, strtoupper($v['agentName']));
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['address']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['mobileNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['email']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['bankName']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['bankIfscCode']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['accountHolderName']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['aadharCardNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $v['panCardNo']);
                $objPHPExcel->getActiveSheet()->setCellValue(($columnChar++).$columnIncrement, $newRegiDate);
                $columnIncrement++;
               
     }
        foreach (range('A', 'K') as $column){
        $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(TRUE);
    }
  
// Redirect output to a client’s web browser (Excel5)
$filename = "ALLAGENTDATA_".date('d-M-Y');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$filename.xls");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>