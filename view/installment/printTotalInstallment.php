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
                $cuId=$_REQUEST['cuId'];
                 /*====================Select Branch name=======================*/
                 include '../../includes/phpBranch.php';
                /*====================Select Branch name end=======================*/
                 $selectCuIHis="SELECT cu.id, cu.customer_id, cu.registration_no, cu.sr_no, cu.agency_code, cu.branch_id, "
                         . "cu.name, cu.father, cu.dob, cu.country, cu.post, "
                         . "cu.district, cu.pin_code, cu.address, cu.mobil_no, cu.nominee, cu.realation, cih.id, "
                         . "cih.customer_id, cih.reciept_no, cih.pay_amount, cih.no_of_installment, cih.pay_date, cpm.total_installment_amount, cpm.plan_type "
                         . "FROM customer AS cu, customer_installment_history AS cih, customer_plan_mapping AS cpm WHERE cu.customer_id = cih.customer_id AND cu.customer_id = cpm.customer_id AND cu.customer_id='{$cuId}' AND cih.customer_id='{$cuId}' AND cpm.customer_id='{$cuId}'";
                $resultCu=$con->query($selectCuIHis);
                while ($cuRow = mysqli_fetch_array($resultCu)) {
                  $name=$cuRow['name'];  
                  $father=$cuRow['father'];  
                  $country=$cuRow['country'];  
                  $post=$cuRow['post'];  
                  $district=$cuRow['district'];  
                  $pin_code=$cuRow['pin_code'];  
                  $address=$cuRow['address'];  
                  $registration_no=$cuRow['registration_no'];  
                  $sr_no=$cuRow['sr_no'];  
                  $mobil_no=$cuRow['mobil_no'];  
                  $totalInstallmentAmount=$cuRow['total_installment_amount'];  
                  $agency_code=$cuRow['agency_code']; 
                  $plan_type=$cuRow['plan_type']; 
                  $customer_id[]=$cuRow['customer_id']; 
                  $reciept_no[]=$cuRow['reciept_no']; 
                  $pay_amount[]=$cuRow['pay_amount']; 
                  $no_of_installment[]=$cuRow['no_of_installment']; 
                  $pay_date[]=$cuRow['pay_date']; 
                  $id[]=$cuRow['id']; 
                  
                }
                ?>
                <div class="col-lg-12" id="printable">
                      <table style="width:97%;">
                        <tr>
                            <td><img src="../../images/logo/logo.png" style="width: 200px; height: 70px;"></td> 
                            <td colspan="1" style="text-align: left; text-indent: 5px;  margin-bottom: 10px; width: 56%;">
                                <p style="margin-top: 0px; font-size: 20px; text-align: center"><b>KASHI INDIA DEVELOPERS LTD.</b><p>
                                <p style="margin-top: -12px; text-align: center;"><b><?php echo $brachName. ','.$brachDistrict;?></b></p>
                                <p style="margin-top: -12px; text-align: center;"><b><?php echo $branchState;?></b></p>
                                <p style="margin-top: -12px; text-align: center;"><b><?php echo $branchPinCode;?></b></p>
                                
                                <p style="margin-top: 0px; font-size: 15px; text-align: center"><b><?php echo $name. ' , '.$plan_type?></b><p>
                                <p style="margin-top: -12px; text-align: center;"><b>Vill:</b><?php echo $address;?> <b>Post</b>: <?php echo $post.', '.$district;?></p>
                                <p style="margin-top: -12px; text-align: center;"><b><?php echo $agency_code;?> Mo:</b><?php echo $mobil_no;?></p>
                                <p style="margin-top: -12px; text-align: center;"><b>Bill-wise Details</b></p>
                            </td>
                            </tr>
                        </table>
                       <table style="width:97%;">
                           <tr style="border-bottom: 1px solid black; border-top: 1px solid black;">
                                <td>Date</td>    
                                <td>Ref.No</td>    
                                <td>Opening Amount</td>    
                                <td>No Of Installment</td>    
                                <td>Pending Amount</td>    
                                <td>Due On</td>    
                           </tr>
                           <?php
                            $paidAmount=0; 
                            for($i=0; $i<count($customer_id); $i++){
                                $paidAmount+=$pay_amount[$i];    
                           ?>
                           <tr>
                                <td><?php echo "".date("l M,dS Y",strtotime($pay_date[$i]));?></td>    
                                <td><?php echo $id[$i];?></td>    
                                <td><?php echo number_format($pay_amount[$i], 2, '.', '') ;?></td>    
                                <td><?php echo $no_of_installment[$i];?></td>    
                                <td><?php echo number_format($pay_amount[$i], 2, '.', '') ;?></td>    
                                <td><?php echo "".date("l M,dS Y",strtotime($pay_date[$i]));?></td>    
                           </tr>
                           <?php
                            }
                           ?>
                           <tr>
                               <td></td>
                               <td></td>
                                <td colspan="" style="font-size: 15px;"><b><i class="fa fa-rupee"></i> <?php echo number_format($paidAmount, 2, '.', '') ;?></b></td>
                                <td></td> 
                                <td colspan="" style="font-size: 15px;"><b><i class="fa fa-rupee"></i> <?php echo number_format($paidAmount, 2, '.', '') ;?></b></td>
                           </tr>
                            
                        </table>
                        
                    <div class="col-lg-12 text-center">This is a Computer Generated  Receipt</div>
                     <br>
                </div>
            <div class="col-lg-12">
                <br>
              <button class="btn btn-bitbucket col-lg-offset-5" title="Print  Receipt" onclick="printDiv('printable')">Print  Receipt</button>
            </div> 
             <!----->   
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

        <?php require_once '../../includes/bottom.php'; ?>
        <?php require_once '../../includes/footer_includes.php'; ?>
        <script>
            $(document).on('click', '.deldp', function(){
                var tr = $(this).closest('tr'),
                    del_id = $(this).attr('id');
                    idArr = del_id.split('-');
                    if(idArr[1]=='dl'){
                        var c = confirm("Do you want to delete this Plan?");
                        if(c==true){
                            var url = "ajaxDeletePlan.php?id=";
                            stts=0;
                        }else{
                             url = "";
                        }
                    }
                $.ajax({
                    url: url+idArr[0]+"&sts="+stts,
                    cache: false,
                    success:function(result){
                        tr.fadeOut(300, function(){
                            $(this).remove();
                        });
                    }
                });
            });
        </script>
    </body>
</html>
    <?php
    }
    else{
        $setUrl = '../../index.php?token='.$_SESSION['token'];
        header("Location: $setUrl");
    }
?>



