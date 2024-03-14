
<?php
    include_once '../../logger/incLog.php';
    include '../../controller/config/dbConnection.php';
    $queryCid = "SELECT id FROM h_region WHERE name='{$_REQUEST['q']}'";
    //echo "$queryCid";
    $resulti = $con->query($queryCid);
    while ($row = mysqli_fetch_array($resulti)) {
        $rida = $row['id'];
    }
    $query = "SELECT * FROM h_country WHERE region_id='{$rida}'";
    //echo "$query";
    //$log->info("Query :: $query");
    $result = $con->query($query);
?>
<select name="country" id="country" class="form-control" required="required">
    <option value="">Select Country</option>
    <?php
      while ($row1 = mysqli_fetch_array($result)) {
          ?>
            <option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option>
          <?php
      }
  ?>
</select>
