<?php
include '../../controller/config/dbConnectionExcel.php';
include '../../PHPExcel/Classes/PHPExcel.php';
include '../../PHPExcel/Classes/PHPExcel/IOFactory.php';
function numberToRoman($num) 
 {
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value) 
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
 } 
 session_start();
//include '../../logger/incLog.php';
//include '../../controller/config/dbConnection.php';
//$from = $_REQUEST['from'];
//$to = $_REQUEST['to'];
$con = new mysqli($dbHost, $dbUser, $dbPass, $dbName); 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->setCellValue('A1', "NAME");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "EMAIL");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "MOBILE");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "DESIGNATION");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "ROLE");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "REGION");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "COUNTRY");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "PLANT");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "USER ID");
$objPHPExcel->getActiveSheet()->setCellValue('J1', "PASSWORD");
$objPHPExcel->getActiveSheet()->setAutoFilter('A1:J1');
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(
    array(
        'font' => array(
            'size' => 10,
            'bold' => true,
        ),
    )
);
foreach (range('A', 'J') as $column){
    $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(TRUE);
}
//SELECT zone_id,MONTH(c_date),SUM(CASE WHEN point_status = '0' THEN 1 ELSE 0 END) AS Open,SUM(CASE WHEN point_status = '1' THEN 1 ELSE 0 END) AS Close FROM h_score where YEAR(c_date)=2017 GROUP BY zone_id ,MONTH(c_date)
if($_SESSION['role'] == 'ROL001'){
    $queryRecord = "SELECT ud.user_name, ud.email, ud.contact,ud.designation, uc.role,  uc.region, uc.country, uc.plant, ud.user_id, uc.password, ur.role_name FROM f_user_detail as ud, f_user_credential as uc, f_user_role as ur WHERE ud.user_id = uc.user_id AND ur.role_id=uc.role";
}
else{
    $queryRecord = "SELECT ud.user_name, ud.email, ud.contact,ud.designation, uc.role,  uc.region, uc.country, uc.plant, ud.user_id, uc.password, ur.role_name FROM f_user_detail as ud, f_user_credential as uc, f_user_role as ur WHERE ud.user_id = uc.user_id AND ur.role_id=uc.role AND uc.plant='{$_SESSION['plant']}'";
}
//echo $queryRecord;
$resultRecord = $con->query($queryRecord);
$k = 2;
while ($rowRecord = mysqli_fetch_array($resultRecord)) {
    $objPHPExcel->getActiveSheet()->setCellValue("A$k", $rowRecord['user_name']);
    $objPHPExcel->getActiveSheet()->setCellValue("B$k", $rowRecord['email']);
    $objPHPExcel->getActiveSheet()->setCellValue("C$k", $rowRecord['contact']);
    $objPHPExcel->getActiveSheet()->setCellValue("D$k", $rowRecord['designation']);
    $objPHPExcel->getActiveSheet()->setCellValue("E$k", $rowRecord['role_name']);
    $objPHPExcel->getActiveSheet()->setCellValue("F$k", $rowRecord['region']);
    $objPHPExcel->getActiveSheet()->setCellValue("G$k", $rowRecord['country']);
    $objPHPExcel->getActiveSheet()->setCellValue("H$k", $rowRecord['plant']);
    $objPHPExcel->getActiveSheet()->setCellValue("I$k", $rowRecord['user_id']);
    $objPHPExcel->getActiveSheet()->setCellValue("J$k", "123456");
    $k++;
}

// Redirect output to a client’s web browser (Excel5)
$filename = "Users ".date('d-M-Y');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename='$filename.'");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('php://output');