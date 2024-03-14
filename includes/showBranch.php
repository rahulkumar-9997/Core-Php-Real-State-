<?php
    echo $_SESSION['branch_name']."-".$_SESSION['district'];
if($_SESSION['role']=='ROL001'){    
  ?>
<div class="pull-left" style="width: 150px; margin-top: -8px;">
      <select name="planType" class="form-control input-sm branch" required="required" id="branch" onchange="getBranchId()">
              <option value="">Select Branch Name</option>
              <?php
              $selectBranch="SELECT branch_id, branch_name, district FROM branch WHERE status=1";
              $branchResult=$con->query($selectBranch);
              while ($branchRow = mysqli_fetch_array($branchResult)) {
               ?>
               <option value="<?php echo $branchRow['branch_id']?>"<?php if($branchRow['branch_id']==$_SESSION['branch_id']){ ?> selected="selected" <?php } ?>><?php echo $branchRow['branch_name'].'-'.$branchRow['district'];?></option>
              <?php
              }
              ?>
      </select>
      <input type="hidden" value="<?php echo $_REQUEST['token'];?>" id="token">
  </div>
<script type="text/javascript">
        function getBranchId(){
            var branchId = document.getElementById('branch').value;
            //alert(pin);
            var url = "../../model/authentication/ajaxReloadBranchSessionId.php?branchId="+branchId;
            //alert(url);
            $.ajax({
                url: url,
                cache: false,
                success:function(response){
                    location.reload();
                }
            });
        }
    </script>
<?php
}
?>    