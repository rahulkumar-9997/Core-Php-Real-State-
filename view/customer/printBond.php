<?php
    session_start();
    if($_SESSION['token']===$_REQUEST['token'] && $_SESSION['uid']===$_SESSION['euid']){
        include_once '../../includes/timeout.php';
        ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['title'].":  Receipt"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" type="image/jpg" href="../../images/logo/log.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once '../../includes/header_includes.php';?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Top navigation includes -->
        <?php require_once '../../includes/top.php'; ?>
        <!-- Left navigation includes -->
        <?php include_once '../../includes/left.php'; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Welcome
            <small><?php echo $_SESSION['user']; ?></small>
          </h1>
          <ol class="breadcrumb">
            <?php include '../../includes/showBranch.php';?>  
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Customer</li>
            <li class="active">Customer List</li>
            <li class="active">Print Bond</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <?php 
                if(!empty($_REQUEST['info'])){
                    if(strpos(($_REQUEST['info']), 'success') !== FALSE){
                    ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b><i class="icon fa fa-check"></i><?php echo $_REQUEST['info']; ?></b>
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b><i class="icon fa fa-warning"></i><?php echo $_REQUEST['info']; ?></b>
                        </div>
                <?php
                    }
                }
            ?>
             <?php
             $query = "SELECT cu.registration_no, cu.sr_no, cu.agency_code,"
                                . " cu.name, cu.registration_no, cu.father, cu.customer_relationship, cu.dob, cu.date_of_joining, cu.expairy_date, cu.gender, cu.mobil_no, cu.aadhar_card_no, cu.pan_card_no, cu.bank_name, cu.account_no, cu.ifsc_code, cu.nominee_date_of_birth,"
                                . "cu.country, cu.customer_img, cu.date_of_joining, cu.expairy_date, cu.post, cu.district, cu.pin_code, cu.address, cu.nominee, cu.realation, cu.customer_img,"
                                . "cpm.no_of_installment, cpm.plan_id, cpm.plot_consideration, cpm.no_of_pay_installment, cpm.plan_name, cpm.plan_duration,"
                                . " cpm.commision_in_per, cpm.interest_rate_in_per, cpm.plan_type, cpm.pay_mode, cpm.total_installment_amount, "
                                . "cpm.installment_amount, cpm.maturity_return, cih.customer_id, cih.reciept_no, cih.pay_amount, cih.no_of_installment AS cihNoOfInstallment, cih.pay_date "
                                . "FROM customer AS cu, customer_plan_mapping AS cpm, agent_commission_history AS ach, customer_installment_history AS cih WHERE cpm.customer_id = ach.customer_id AND cpm.customer_id = cu.customer_id AND cpm.customer_id=cih.customer_id AND cu.customer_id='{$_REQUEST['cuId']}' AND cpm.customer_id='{$_REQUEST['cuId']}' AND ach.customer_id='{$_REQUEST['cuId']}'";
                                $result = $con->query($query);
                while ($customerRow = mysqli_fetch_array($result)) {
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
                    $adrCardNo=$customerRow['aadhar_card_no'];
                    $panCardNo=$customerRow['pan_card_no'];
                    $bankName=$customerRow['bank_name'];
                    $accountNo=$customerRow['account_no'];
                    $ifscCode=$customerRow['ifsc_code'];
                    $nomineeDOB=$customerRow['nominee_date_of_birth'];
                    $nomineeName=$customerRow['nominee'];
                    $nomineeRelation=$customerRow['realation'];
                    $customerPhoto=$customerRow['customer_img'];
                    $total_installment_amount=$customerRow['total_installment_amount'];
                    $installmentAmount=$customerRow['installment_amount'];
                    $cuid[]=$customerRow['customer_id'];
                    $payAmount[]=$customerRow['pay_amount'];
                    $payDate[]=$customerRow['pay_date'];
                    $recieptNo=$customerRow['reciept_no'];
                    $cihNoOfInstallment[]=$customerRow['cihNoOfInstallment'];
                    $dateOfJoi=$customerRow['date_of_joining'];
                    $expDate=$customerRow['expairy_date'];
                    $customerImage=$customerRow['customer_img'];
                    $registration_no=$customerRow['registration_no'];
                    $planId=$customerRow['plan_id'];
                    $plot_consideration=$customerRow['plot_consideration'];
                    $maturity_return=$customerRow['maturity_return'];
                    $agency_code=$customerRow['agency_code'];
                    $sr_no=$customerRow['sr_no'];
                    $customer_relationship=$customerRow['customer_relationship'];
                }
                /*====================Select Branch name=======================*/
                $selectBranchName="SELECT branch_name, district, country, state, pin_code, mobile_no, email, address, branch_code FROM branch WHERE branch_id='{$_SESSION['branch_id']}'";
                $branchResult=$con->query($selectBranchName);
                while ($branchRow = mysqli_fetch_array($branchResult)) {
                    $brachName=$branchRow['branch_name'];
                    $brachDistrict=$branchRow['district'];
                    $brachCode=$branchRow['branch_code'];
                    $branchDistrict=$branchRow['district'];
                    $branchCountry=$branchRow['country'];
                    $branchState=$branchRow['state'];
                    $branchPinCode=$branchRow['pin_code'];
                    $branchMobileNo=$branchRow['mobile_no'];
                    $branchEmail=$branchRow['email'];
                    $branchAddress=$branchRow['address'];
                    
                }
                /*====================Select Branch name end=======================*/
                $newDaOfJoininh = date("d/m/Y", strtotime($dateOfJoi));
                $neExpDate = date("d/m/Y", strtotime($expDate));
                
                /*==============Calculate customer dob in year==============*/
                 $birth_date = $dob;
                 $age= date("Y") - date("Y", strtotime($birth_date)); //25
                 $newAge=$age;
                /*==============Calculate customer dob in year==============*/
                /*==============Calculate customer dob in year==============*/
                 $birth_date_no = $nomineeDOB;
                 $age_no= date("Y") - date("Y", strtotime($birth_date_no)); //25
                 $newAge_no=$age_no;
                /*==============Calculate customer dob in year==============*/
                 /* =====================Word =================*/
                $nwords = array(  "zero", "one", "two", "three", "four", "five", "six", 
                        "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", 
                        "fourteen", "fifteen", "sixteen", "seventeen", "eightteen", 
                        "nineteen", "twenty", 30 => "thirty", 40 => "fourty",
                           50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eigthy",
                           90 => "ninety");
                function decimal_to_words($x)
                {
                        $x = str_replace(',','',$x);
                        $pos = strpos((string)$x, ".");
                        if ($pos !== false) { $decimalpart= substr($x, $pos+1, 2); $x = substr($x,0,$pos); }
                        $tmp_str_rtn = number_to_words ($x);
                        if(!empty($decimalpart))
                                $tmp_str_rtn .= ' and '  . number_to_words ((int)$decimalpart) . ' paise';
                        return   $tmp_str_rtn;
                } 

                function number_to_words ($x)
                {
                     global $nwords; 
                     if(!is_numeric($x))
                     {
                         $w = '#';
                     }else if(fmod($x, 1) != 0)
                     {
                         $w = '#';
                     }else{
                         if($x < 0)
                         {
                             $w = 'minus ';
                             $x = -$x;
                         }else{
                             $w = '';
                         }
                         if($x < 21)
                         {
                             $w .= $nwords[$x];
                         }else if($x < 100)
                         {
                             $w .= $nwords[10 * floor($x/10)];
                             $r = fmod($x, 10);
                             if($r > 0)
                             {
                                 $w .= ' '. $nwords[$r];
                             }
                         } else if($x < 1000)
                         {

                             $w .= $nwords[floor($x/100)] .' hundred';
                             $r = fmod($x, 100);
                             if($r > 0)
                             {
                                 $w .= ' '. number_to_words($r);
                             }
                         } else if($x < 100000)
                         {
                                $w .= number_to_words(floor($x/1000)) .' thousand';
                             $r = fmod($x, 1000);
                             if($r > 0)
                             {
                                 $w .= ' ';
                                 if($r < 100)
                                 {
                                     $w .= ' ';
                                 }
                                 $w .= number_to_words($r);
                             }
                         } else {
                             $w .= number_to_words(floor($x/100000)) .' lacs';
                             $r = fmod($x, 100000);
                             if($r > 0)
                             {
                                 $w .= ' ';
                                 if($r < 100)
                                 {
                                     $word .= ' ';
                                 }
                                 $w .= number_to_words($r);
                             }
                         }
                     }
                     return $w;
                } 
                        // demonstration
                 /* =====================Word =================*/
             ?>
          <style type="text/css" media="print">
			@media print {
            #printable{
                margin-left: 130px;
            }
           }
    </style>
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-user-plus"></i>Print Customer Bond</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div style="width: 950px; margin-left: 140px; font-weight:bold;" id="printable" >
                        <div style="width: 200px; height: 40px; margin-left:900px; border: 0px solid red; padding-top: 65px; font-size:28px; letter-spacing:2px;">
                            <?php echo $sr_no;?>
                        </div>
                      
                        <div style="width: 350px; height: 130px; margin-left: 100px; border: 0px solid red; margin-top: 120px;">
                            <div style="padding: 10px; font-size: 18px;">
                                <p><?php echo $name;?> <b><?php echo $customer_relationship;?></b> <?php echo $father;?></p>
                                <p style="margin-top: -10px;">Vill:- <?php echo $address;?>, Post:-<?php echo $post;?></p>
                                <p style="margin-top: -10px;">Dist:- <?php echo $district;?>, Pin:-<?php echo $pin_code;?></p>
                                <p style="margin-top: -10px;">Mo.No. -<?php echo $mobil_no;?></p>
                            </div>  
                        </div>
                        <div style="width: 300px; margin-left: 700px; margin-top: -120px; font-size: 18px;">
                           <?php echo $newDaOfJoininh;?>
                        </div>
                        <div style="width: 260px; margin-left: 900px; margin-top: -20px;">
                            <img src="<?php echo $customerImage;?>" style="width: 140px; height: 160px; margin-right: 10px;">
                        </div>
                    
                    <div style="width: 1100px; border: 0px solid red; height: 40px; margin-top: 225px; font-size: 17px;" > 
                        <div style="margin-left: 100px; float: left; width: 250px; text-align: center;">
                            <p><?php echo $registration_no;?></p>
                            <p style="margin-top: -10px;"><?php echo $newDaOfJoininh;?></p>
                        </div>
                        <div style="float: left; width: 150px;  text-align: center;">
                            <p><?php echo $plan_name;?></p>
                            <p style="margin-top: -10px;"><?php echo $plan_duration;?> Month</p>
                        </div>
                        <div style="float: left; width: 120px;  text-align: center;">
                            <p><?php echo $plot_consideration?></p>                            
                        </div>
                        <div style="float: left; width: 150px;  text-align: center;">
                            <?php
                              if($plan_type=='RD'){
                             ?>
                            <p><?php echo "Regular";?></p>
                            <?php
                                }else if($plan_type=='MIS' OR $plan_type=='FD'){
                                ?>
                                   <p><?php echo "Single";?></p>
                               <?php
                                }
                            ?>
                        </div>
                        <div style="float: left; width: 50px;  text-align: right; margin-left:80px;">
                            <?php
                            if($plan_type=='RD'){
                                if($pay_mode=='daily'){
                                 ?>
                                   <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> DLY</p>
                                 <?php
                                 } 
                                if($pay_mode=='monthly'){
                                 ?>
                                   <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> MLY</p>
                                 <?php   
                                  }
                                if($pay_mode=='quarterly'){
                                 ?>
                                   <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> QLY</p>
                                 <?php
                                }
                                 if($pay_mode=='halfyearly'){
                                  ?>
                                    <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> HLY</p>
                                 <?php
                                  }
                                 if($pay_mode=='yearly'){
                                  ?>
                                    <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> YLY</p>
                                  <?php
                                 }
                                 if($pay_mode=='fixdeposite'){
                                  ?>
                                    <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> </p>
                                  <?php
                                 }
                            }elseif ($plan_type=='MIS' OR $plan_type=='FD') {
                            ?>
                                    <p><?php echo number_format($installmentAmount, 2, '.', '') ;?> </p>
                           <?php
                            }
                                
                            ?>  
                        </div>
                        <div style="float: left; width: 100px;  text-align: right; margin-left:70px;">
                            <p><?php echo $neExpDate;?></p>                            
                        </div>
                        
                    </div>
                    
                    <div style="width: 950px; border: 0px solid red; height: 35px; margin-top: 85px; margin-left: 150px; font-size: 17px;"> 
                        <div style="float: left; width: 150px; border: 0px solid red;">
                            
                        </div>
                        <div style="float: left; width: 150px; border: 0px solid red; margin-left: 100px;">
                            <p><?php echo $recieptNo;?></p>
                        </div>
                        <div style="float: left; width: 150px; border: 0px solid red;">
                                                  
                        </div>
                        <div style="float: left; width: 150px; border: 0px solid red; margin-left: 180px;">
                            <p><?php echo $newAge;?> Y</p>
                        </div>
                        <div style="float: left; width: 150px; border: 0px solid red;">
                            
                        </div>
                        <div style="float: left; width: 150px; border: 0px solid red; margin-left: 100px;">
                            <?php
                              if($plan_type=='RD'){
                             ?>
                            <p><?php echo "Regular";?></p>
                            <?php
                                }else if($plan_type=='MIS' OR $plan_type=='FD'){
                                ?>
                                   <p><?php echo "Single";?></p>
                               <?php
                                }
                            ?>                          
                        </div>
                    </div>

                    <div style="width: 950px; border: 0px solid red; height: 35px; margin-left: 100px; margin-top:50px; font-size: 17px;"> 
                        <div style="float: left; width: 170px; border: 0px solid red;">
                           
                        </div>
                        <div style="float: left; width: 170px; margin-left:170px;">
                            <p><?php echo $nomineeName;?></p>
                        </div>
                        <div style="float: left; width: 250px;">
                            <p>Secure value at the end of term </p>
                        </div>
                        <div style="float: left; width: 170px;">
                            <p><?php echo number_format($maturity_return, 2, '.', '') ;?></p>
                        </div>
                    </div>
                    <div style="clear: left;" ></div>
                    <div style="width: 950px; border: 0px solid red; height: 35px; margin-left: 100px; margin-top:10px; font-size: 17px;"> 
                        <div style="float: left; width: 170px; border: 0px solid red;">
                           
                        </div>
                        <div style="float: left; width: 170px; margin-left:160px;">
                            <p><?php echo $newAge_no;?> Year</p>
                        </div>
                        <div style="float: left; width: 200px;">
                            
                        </div>
                        <div style="float: left; width: 170px; margin-left:100px;">
                            <p><?php echo $nomineeRelation;?></p>
                        </div>
                    </div>
                    <div style="clear: left;" ></div>
                    <div style="width: 950px; border: 0px solid red; height: 35px; margin-left: 100px; font-size: 17px;"> 
                        <div style="float: left; width: 170px; border: 0px solid red;">
                           
                        </div>
                        <div style="float: left; width: 170px; margin-top:10px; margin-left:120px;">
                            <p><?php echo $agency_code;?></p>
                        </div>
                        <div style="float: left; width: 200px;">
                            
                        </div>
                        <div style="float: left; width: 170px; margin-top:10px; margin-left:100px;">
                            <p>-----------------</p>
                        </div>
                    </div>
                    
                    <div style="clear: left;" ></div>
                    <div style="margin-top: 50px;">
                    <div style="width: 950px; border: 0px solid red; height: 140px;"> 
                        <div style="float: left; margin-left: 100px; margin-top:10px;  width: 400px; height: 120px; border: 0px solid red;">
                            <div style="padding: 10px; font-size: 17px; margin-left:10px;">
                                <p><?php echo $brachName. ','. $brachDistrict;?></p>
                                <!--<p style="margin-top: -10px;"><?php echo $branchAddress. ','. $brachDistrict?></p>-->
                                <p style="margin-top: -10px;"><?php echo $branchPinCode.','.$branchState . ' '.$branchCountry;?>, <span style=""><b style="font-size: 17px;">PH-<?php echo $branchMobileNo;?></b></span></p>
                            </div>
                        </div>
                    </div>
                    <div style="width: 950px; border: 0px solid red; height: 40px; margin-top: 15px;">
                        <div style="width: 600px; height: 40px; border: 0px solid red; float: right; margin-left: 60px;">
                            <p style="text-align: right; margin-top: 15px; font-size: 28px; letter-spacing:2px;"><?php echo $sr_no;?></p>
                        </div>
                    </div>
                    <div style="width: 1050px; border: 0px solid red; margin-top:50px;">    
                        <div style="width: 350px; float: right; border: 0px solid red;">
                          <div style="text-align: right; padding: 10px; font-size: 14px;">
                                <p style="margin-top: -10px;"><?php echo $recieptNo;?></p>
                                 <p style="margin-top: -10px;"><?php echo $brachName.' '.$brachDistrict;?> </p>
                                <p style="margin-top: -10px;"><?php echo $brachCode;?></p>
                                <p style="margin-top: -10px;"><?php echo $_SESSION['branch_id'];?></p>
                            </div>  
                        </div>
                    </div>
                    <div style="width: 1050px; border: 0px solid red;">    
                        <div style="width: 350px; margin-left: 100px; height: 130px; float: left; border: 0px solid red;">
                          <div style="padding: 10px; font-size: 17px; margin-left:10px; margin-top:120px;">
                                <p><?php echo $name;?> <b><?php echo $customer_relationship;?></b> <?php echo $father;?></p>
                                <p style="margin-top: -10px;">Vill:- <?php echo $address;?>, Post:-<?php echo $post;?></p>
                                <p style="margin-top: -10px;">Dist:- <?php echo $district?>, Pin:-<?php echo $pin_code;?></p>
                                <p style="margin-top: -10px;">Mo.No. -<?php echo $mobil_no;?></p>
                            
                          </div> 
                         <div style="padding: 10px; text-align: right; margin-left:30px; font-size: 17px;">
                                <p><?php echo number_format($installmentAmount, 2, '.', '') ;?></p>
                                <p style="margin-top: -10px;"><?php echo strtoupper(decimal_to_words($installmentAmount));?></p>
                            
                          </div> 
                        </div>
                        <div style="float: right; width:397px; border: 0px solid red;">
                             <div style="padding: 10px; text-align: right; font-size: 14px;">
                                <p><?php echo $registration_no;?></p>
                                <p style="margin-top: -10px;"><?php echo $newDaOfJoininh;?></p>
                                <p style="margin-top: -10px;"><?php echo $plan_name.'/'.$plan_duration;?> Month </p>
                                <p style="margin-top: -10px;"><?php echo $plot_consideration?> (Sq.Yd)</p>
                                <p style="margin-top: -10px;">
                                 <?php
                                    if($plan_type=='RD'){
                                        if($pay_mode=='daily'){
                                           echo $installmentAmount . 'DLY';
                                         } 
                                        if($pay_mode=='monthly'){
                                            echo $installmentAmount. 'MLY'; 
                                          }
                                        if($pay_mode=='quarterly'){
                                           echo $installmentAmount. 'QLY'; 
                                        }
                                         if($pay_mode=='halfyearly'){
                                            echo $installmentAmount. 'HLY'; 
                                          }
                                         if($pay_mode=='yearly'){
                                           echo $installmentAmount. 'YLY'; 
                                         }
                                         if($pay_mode=='fixdeposite'){
                                          echo number_format($installmentAmount, 2, '.', '') ;
                                 }
                                }elseif ($plan_type=='MIS' OR $plan_type=='FD') {
                                   echo number_format($installmentAmount, 2, '.', '') ;       
                               }
                                
                            ?>  
                                    
                                </p>
                                <p style="margin-top: -10px;">
                                <?php
                                        if($plan_type=='RD'){
                                           echo "Regular";
                                         }else if($plan_type=='MIS' OR $plan_type=='FD'){
                                            echo "Single";
                                             }
                                ?>  
                                </p>
                                <p style="margin-top: -10px;"><?php echo $neExpDate;?></p>
                                <p style="margin-top: -10px;"><?php echo $agency_code;?></p>
                                <p style="margin-top: -10px;">UNIT </p>
                            
                          </div>
                        </div>
                    </div>
                    </div>   
                    </div>
                    
                </div>
				<br/>
				<button class="btn btn-foursquare col-lg-offset-5" title="Print  Receipt" onclick="printDiv('printable')">Print Bond</button>
            </div>
			
            <!-- Content Here -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
        function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
   }
    </script>
      <?php require_once '../../includes/bottom.php'; ?>
    </div>
    <?php require_once '../../includes/footer_includes.php'; ?>

    <?php 
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
    ?>
  </body>
</html>
