<?php
    session_start();
    if($_SESSION['token']===$_REQUEST['token'] && $_SESSION['uid']===$_SESSION['euid']){
        include '../../includes/timeout.php';
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
  <script>
        function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
   }
    </script>
     <style type="text/css" media="print">
        @page
        {
            //size: auto; /* auto is the initial value */
            margin: 10mm 10mm 1mm 10mm; /* this affects the margin in the printer settings */
        }
        thead
        {
            //display: table-header-group;
        }
       
        tfoot
        {
            //display: table-footer-group;
        }
    </style>
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
            <li class="active">Manage Installment</li>
            <li class="active">Deposit Installment</li>
            <li class="active">Print Receipt</li>
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
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-list"></i>Print Receipt</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                    <?php
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
                        ?>
                <?php
                $cuId=$_REQUEST['cuId'];
                $receiptNo=$_REQUEST['receiptNo'];
                 /*====================Select Branch name=======================*/
                 include '../../includes/phpBranch.php';
                /*====================Select Branch name end=======================*/
                ?>
                <div class="col-lg-12" id="printable">
                    <table style="width:97%; border: 1px solid black;">
                        <tr>
                            <td colspan="1" style="text-align: left; text-indent: 5px;  margin-bottom: -10px; width: 56%; border-right: 1px solid black; border-bottom: 1px solid black;">
                                <p style="margin-top: 0px; font-size: 25px;"><b>KASHI INDIA DEVELOPERS LTD.</b><p>
                                <p style="margin-top: -12px;"><b>Address :</b><?php echo $brachName. ','.$brachDistrict.'- '.$branchPinCode.' '.$branchState.' ,'.$branchCountry?></p>
                                <p style="margin-top: -12px;"><b>Contact Us :</b> <?php echo $branchMobileNo;?></p>
                                <p style="margin-top: -12px;"><b>E-mail :</b> <?php echo $branchEmail;?> | <b>Web :</b> www.kashiindia.in</p>
                            </td>
                            </tr>
                        </table>
                        <table style="width: 97%; text-align: right; font-size: 14px;">
                            <tr style="border:  1px solid black;">
                                <td colspan="5" style="text-align: center;  border-right: 1px solid black;">&nbsp; <b>No Of Pay Installment.</b></td>
                                <td colspan="1" style="text-align: center;  border-right: 1px solid black;">&nbsp; <b>Date</b></td>
                                <td colspan="1" style="text-align: center;  border-right: 1px solid black;">&nbsp; <b>Pay Amount</b></td>
                            </tr>
                            <?php
                            $selectReceipt="SELECT customer_id, reciept_no, pay_amount, no_of_installment, pay_date FROM customer_installment_history WHERE reciept_no='{$receiptNo}' AND customer_id='{$cuId}'";
                            $log->info("$selectReceipt");
                            $result=$con->query($selectReceipt);
                            while ($row = mysqli_fetch_array($result)) {
                                $payAmount=$row['pay_amount'];
                            ?>
                            <?php //echo number_format($totalPayAmount, 2, '.', '') ;?>
                            <tr style="border:  1px solid black;">
                                <td colspan="5" style="text-align: center;  border-right: 1px solid black;">&nbsp; <?php echo $row['no_of_installment']?>.</td>
                                <td colspan="1" style="text-align: center;  border-right: 1px solid black;">&nbsp; <?php echo "".date("l M,dS Y",strtotime($row['pay_date']));?></td>
                                <td colspan="1" style="text-align: center;  border-right: 1px solid black;">&nbsp; <?php echo $row['pay_amount'];?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr style="border: 1px solid black;">
                                <td colspan="6" style="font-size: 20px;"><b>Total Amount</b></td>
                                <td colspan="2" style="text-align: center; font-size: 20px;"><b><i class="fa fa-rupee"></i> <?php echo number_format($payAmount, 2, '.', '') ;?></b></td>
                            </tr>
                            <tr style="border: 1px solid black;">
                                <td colspan="6" style="font-size: 20px;"><b>Total Amount (in words)</b></td>
                                <td colspan="2" style="text-align: center; font-size: 20px;"><b><?php echo strtoupper(decimal_to_words($payAmount));?></b></td>
                            </tr>
                        </table>
                    <div class="col-lg-12 text-center">This is a Computer Generated Receipt</div>
                     <br>
                </div>
            <div class="col-lg-12">
                <br>
              <button class="btn btn-default col-lg-offset-5" title="Print Receipt" onclick="printDiv('printable')">Print  Receipt</button>
            </div> 
             <!----->   
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

        <?php require_once '../../includes/bottom.php'; ?>
        <?php require_once '../../includes/footer_includes.php'; ?>
    </body>
</html>
    <?php
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
?>



