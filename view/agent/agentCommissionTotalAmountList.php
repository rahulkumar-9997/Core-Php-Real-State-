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
    <title><?php echo $_SESSION['title'].": Agent Commission Amount List"; ?></title>
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
            <li class="active">Manage Agent</li>
            <li class="active">Agent Commission Amount List</li>
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
          /*echo $_SESSION['role'];*/
          if($_SESSION['role']=='ROL001'){
          ?>
          <!--================================IF user admin than show ===================================-->
          <div class="box box-info SeaechAgentList">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user-list"></i>Agent Commission Amount List</h3>
              <!--<div class="pull-right" style="width: 150px;">
                  <select name="planType" class="form-control input-sm col-lg-2 branch" required="required" id="branchId">
                          <option value="">Select Branch Name</option>
                          <?php
                          $selectBranch="SELECT branch_id, district, branch_name FROM branch WHERE status=1";
                          $branchResult=$con->query($selectBranch);
                          while ($branchRow = mysqli_fetch_array($branchResult)) {
                           ?>
                          <option value="<?php echo $branchRow['branch_id']?>"<?php if($branchRow['branch_id']==$_SESSION['branch_id']){ ?> selected="selected" <?php } ?>><?php echo $branchRow['branch_name'].'-'.$branchRow['district'];?></option>
                          <?php
                          }
                          ?>
                      </select>
                  <input type="hidden" value="<?php echo $_REQUEST['token'];?>" id="token">
              </div>-->
            </div><!-- /.box-header -->
            <div class="loader_gif" id="loader-gif" style="display:none;"></div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>Agent Id</th>
                        <th>Customer Id</th>
                        <th>Commission Amount</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $s=1;
                            include '../../controller/config/dbConnection.php';
                            $query = "";
                            $result = $con->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $s; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['c_date'])); ?></td>
                                        <td><?php echo strtoupper($row['agent_name']); ?></td>
                                        <td><?php echo $row['agency_code']; ?></td>
                                         <td><?php echo $row['address']. ','.$row['district']. ','.$row['pin_code']. ','.$row['state']. ','.$row['country']; ?></td>
                                        <td><?php echo $row['mobile_no']; ?></td>
                                        <td>
                                            <a href="editAgent.php?token=<?php echo $_REQUEST['token']; ?>&id=<?php echo $row['id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                            <a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                $s++;
                            }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--================================IF user admin than show end ===================================-->
              <?php
               }else{
                ?>
              <!--================================IF user other than admin than show ===================================-->
                <div class="box box-info SeaechAgentList">
                 <!--<div class="box-header with-border">
                   <h3 class="box-title"><i class="fa fa-user-list"></i> List Of All Agent</h3>
                   <div class="pull-right" style="width: 150px;">
                       <select name="planType" class="form-control input-sm col-lg-2 branch" required="required" id="branchId">
                               <option value="">Select Branch Name</option>
                               <?php
                               $selectBranch="SELECT branch_id, branch_name FROM branch WHERE status=1";
                               $branchResult=$con->query($selectBranch);
                               while ($branchRow = mysqli_fetch_array($branchResult)) {
                                ?>
                               <option value="<?php echo $branchRow['branch_id']?>"><?php echo $branchRow['branch_name'];?></option>
                               <?php
                               }
                               ?>
                           </select>
                       <input type="hidden" value="<?php echo $_REQUEST['token'];?>" id="token">
                   </div>
                 </div>--\><!-- /.box-header -->
                 <div class="box-body">
                     <table id="example1" class="table table-bordered table-striped">
                         <thead>
                           <tr>
                             <th>S No</th>
                             <th>Create Date</th>
                             <th>Agent Name.</th>
                             <th>Agency Code</th>
                             <th>Address</th>
                             <th>Mobile No</th>
                             <th>Action</th>
                           </tr>
                         </thead>
                         <tbody>
                             <?php
                                 $s=1;
                                 include '../../controller/config/dbConnection.php';
                                 $query = "SELECT agency_code, id, branch_id, agent_name, country, state, district, post, pin_code,"
                                         . " address, mobile_no, c_date, email FROM agent WHERE status=1 AND branch_id='{$_SESSION['branch_id']}'";
                                 $result = $con->query($query);
                                 while ($row = mysqli_fetch_array($result)) {
                                     ?>
                                         <tr>
                                             <td><?php echo $s; ?></td>
                                             <td><?php echo date("d-m-Y", strtotime($row['c_date'])); ?></td>
                                             <td><?php echo $row['agent_name']; ?></td>
                                             <td><?php echo $row['agency_code']; ?></td>
                                              <td><?php echo $row['address']. ','.$row['district']. ','.$row['pin_code']. ','.$row['state']. ','.$row['country']; ?></td>
                                             <td><?php echo $row['mobile_no']; ?></td>
                                             <td>
                                                 <a href="editAgent.php?token=<?php echo $_REQUEST['token']; ?>&id=<?php echo $row['id']; ?>"><button class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                 <a href="#" class="btn btn-danger btn-xs deldp" data-toggle="tooltip" title="Delete" id="<?php echo $row['id'].'-dl'; ?>"><i class="fa fa-remove"></i></a>
                                             </td>
                                         </tr>
                                     <?php
                                     $s++;
                                 }
                             ?>
                         </tbody>
                       </table>
                     </div>
                   </div>
                  <!--================================IF user other than admin than show end===================================-->
                
                <?php
               }
              ?>
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
                        var c = confirm("Do you want to delete this agent?");
                        if(c==true){
                            var url = "ajaxDeleteAgent.php?id=";
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
            /*search*/
              /*Search */
      $(document).on('change', '.branch', function(){
            var branchId=$("#branchId").val();
            var token=$("#token").val();
            $("#loader-gif").show();
            $.ajax({
               url:"ajaxSearchAgent.php",
               type: 'POST',
               data:{branchId:branchId,token:token},
               beforeSend: function () {
                        $('.sidebar-mini').css("opacity", ".5");
                    },
               success:function(data){
                   $('.SeaechAgentList').html(data);
                   $("#loader-gif").hide();
                   $('.sidebar-mini').css("opacity", "");
                   //alert(data);
               }
            });
       });
       /*Search */
            /*search*/
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



