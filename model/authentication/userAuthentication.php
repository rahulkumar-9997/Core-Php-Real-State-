<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userAuthentication
 *
 * @author Mr Jai WD
 */

class userAuthentication {
    //put your code here
    public function userVerification($username, $password){
        include '../../controller/config/dbConnection.php';
        $log = Logger::getLogger('|| 7DW ||');
        $log->info("Connection error : ".mysqli_errno($con));
        //$seluser = "select * from f_user_credential where user_id='{$username}' AND password='{$password}' AND status='1'";
        $seluser = "select f_user_detail.user_id, f_user_detail.c_date, role, branch_id from f_user_credential,"
                . " f_user_detail where f_user_credential.user_id='{$username}' AND password='{$password}' AND status='1' AND f_user_credential.user_id=f_user_detail.user_id";
        $log->info("Query executed as : $seluser");
        $selResult = $con->query($seluser);
        //$log->info("Query result is $selResult");
        $flag = $selResult->num_rows;
        $log->info("Flag set as $flag");
        if($flag > 0 && ctype_alnum($username)){
            //session_start();
            while ($row = mysqli_fetch_array($selResult)) {
                $_SESSION["LAST_ACTIVITY"] = time();
                $_SESSION['uid']  = $row['user_id'];
                $_SESSION['euid'] = "$username";
                $_SESSION['crDate']  = $row['c_date'];
                $_SESSION['role']  = $row['role'];
                $_SESSION['branch_id']  = $row['branch_id'];
                $query = "SELECT branch_id, district, branch_name, branch_code FROM branch WHERE branch_id='{$_SESSION['branch_id']}'";
                $log->info("Branch name And Id :: $query");
                $resultB = $con->query($query);
                while ($row2 = mysqli_fetch_array($resultB)) {
                  $_SESSION['branch_code'] = $row2['branch_code'];  
                  $_SESSION['district'] = $row2['district'];  
                  $_SESSION['branch_name'] = $row2['branch_name'];  
                }
                $selUserDetail = "select * from f_user_detail where user_id='{$username}'";
                $log->info("query detail is : $selUserDetail");
                $detResult = $con->query($selUserDetail);
                $log->info("Detail row count : ".$detResult->num_rows);
                while ($row1 = mysqli_fetch_array($detResult)) {
                    $_SESSION['user'] = $row1['name'];
                    $_SESSION['profile_pic'] = $row1['user_img'];
                }
                
                $strResult = $con->query("SELECT * FROM f_cofis");
                //$log->debug("company info query : $strResult");
                while ($row2 = mysqli_fetch_array($strResult)) {
                    $_SESSION['shortName'] = $row2['short_name'];
                    $_SESSION['companyName'] = $row2['company_name'];
                    $_SESSION['title'] = $row2['title'];
                    $_SESSION['logo'] = $row2['logo'];
                    $_SESSION['fvcn'] = $row2['favicon'];
                }
            }
            return TRUE;
        }
        else{
            return FALSE;
        }
        $con->close();
    }

public function logOut(){
        session_start();
        session_destroy();
        return TRUE;
    }
    
}
