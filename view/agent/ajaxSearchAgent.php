<?php
 include '../../logger/incLog.php';
include_once '../../controller/config/dbConnection.php';
$branchId=$_POST['branchId'];
$token=$_POST['token'];
?>
<style type="text/css">
    /* Cart quantity update image css*/
    .loader {
        background: url('../../images/loader.gif') 50% 10% no-repeat rgb(0, 0, 0);
        background-color: black;
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 99999;
        opacity: .7;
    }
 /* Cart quantity update image css*/
</style>
<div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-user-list"></i> List Of All Agent</h3>
    <div class="pull-right" style="width: 150px;">
        <select name="branchID" class="form-control input-sm col-lg-2 branch" required="required" id="branchId">
                <option value="">Select Branch Name</option>
                <?php
                $selectBranch="SELECT branch_id, district, branch_name FROM branch WHERE status=1";
                $branchResult=$con->query($selectBranch);
                while ($branchRow = mysqli_fetch_array($branchResult)) {
                 ?>
                   <option value="<?php echo $branchRow['branch_id']?>"<?php if($branchRow['branch_id']==$branchId){ ?> selected="selected" <?php } ?>><?php echo $branchRow['branch_name'].'-'.$branchRow['district'];?></option>
                <?php
                }
                ?>
            </select>
        <input type="hidden" value="<?php echo $_REQUEST['token'];?>" id="token">
    </div>
</div><!-- /.box-header -->
<div class="box-body">
<div class="loader" id="loader-gif" style="display:none;"></div>    
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
            $query = "SELECT agency_code, id, branch_id, agent_name, country, state, district, post, pin_code, address, mobile_no, c_date, email FROM agent WHERE status=1 AND branch_id='{$branchId}'";
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
<script>
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
</script>