<?php
session_start();
include '../../logger/incLog.php';
include '../../controller/config/dbConnection.php';
include '../../model/idGenerator/idGeneratorClass.php';
$objId = new idGeneratorClass();
 if(isset($_POST["Import"])){
		
    $filename=$_FILES["file"]["tmp_name"];		

    if($_FILES["file"]["size"] > 0)
    {
            $file = fopen($filename, "r");
    while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
        
           //$id = $objId->generateId("user_id", "f_user_detail", "HSV");
           //$password = rand(1000, 9999);
           $encPass = sha1($getData[9]);
           $sqlD = "INSERT into f_user_detail (user_id, user_name, email, contact, designation, created_by, created_date) 
           values ('".$getData[8]."','".$getData[0]."','".$getData[1]."','".$getData[1]."','".$getData[3]."','".$_SESSION['uid']."', NOW())";
           //echo "$sqlD";
           $role = $con->query("SELECT * FROM f_user_role WHERE role_name='{$getData[4]}'");
           while ($row = mysqli_fetch_array($role)) {
               $roleId = $row['role_id'];
           }
           $sqlC = "INSERT into f_user_credential (user_id, password, role, region, country, plant, created_by, created_date) 
           values ('".$getData[8]."','".$encPass."','".$roleId."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$_SESSION['uid']."', NOW())";
           //echo "$sqlC";
           try {
                $con->autocommit(FALSE);
                
                    $r1 = $con->query($sqlD);
                    $r2 = $con->query($sqlC);
                if($r1 && $r2){
                    $con->autocommit(TRUE);
                    echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"uploadInBulk.php?token=".$_SESSION['token']."\";
                    </script>";
                }
                
                } catch (Exception $exc) {
                    $con->rollback();
                    echo "<script type=\"text/javascript\">
                             alert(\"Invalid File:Please Upload CSV File.\");
                             window.location = \"uploadInBulk.php?token=".$_SESSION['token']."\";
                           </script>";	
                }
        }

        fclose($file);	
    }
}	 