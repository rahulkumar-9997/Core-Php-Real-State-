<?php
$s=rand(10, 99);
foreach ($_FILES['photo']['tmp_name'] as $key => $temp_name) {
    if($_FILES['photo']['name'][$key]!=''){
        $targetfolder = "../../uploads/";
        $targetfolder = $targetfolder .'IMG-'.rand(10, 99). time() .$s.".".end(explode(".", basename( $_FILES['photo']['name'][$key])));
        $FilePath = $targetfolder;
        $ok=0;
        $file_type=$_FILES['photo']['type'][$key];
        if ($file_type=="image/png" OR $file_type== "image/jpg" OR $file_type== "image/jpeg" OR $file_type== "image/JPEG" OR $file_type== "image/PNG") {
            if(move_uploaded_file($_FILES['photo']['tmp_name'][$key], $targetfolder))
            {
                $objc->create("UPDATE customer SET customer_img='{$targetfolder}' WHERE customer_id='{$cuCutomerId}'");
                $ok=1;
                unlink($photoOld);
            }
            else {
                $ok=0;
            }
        }   
    }
    $s++;
}
?>