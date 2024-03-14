<?php
ob_start();
include '../../logger/incLog.php';
include '../../controller/config/dbConnection.php';
$email = strip_tags(mysqli_real_escape_string($con, $_REQUEST['email']));
//echo $email;

$query = "SELECT email, user_id FROM f_user_detail WHERE email='{$email}'";
$log->info("Select User_detail FOR Password recovery : $query");
$result = $con->query($query);
 while ($row = mysqli_fetch_array($result)) {
    $userId = $row['user_id'];
    $emaild = $row['email'];
}
$ret = mysqli_num_rows($result);
if($ret==1){
    $key = rand(10000000, 99999999);
    $eKey = sha1($key);
    $queryUpdate = "UPDATE f_user_credential SET
                               password = '{$eKey}' -- varchar(100)
                               ,updated_by = 'Recvory Page' -- varchar(20)
                               ,updated_date = NOW() -- date
                               WHERE user_id = '{$userId}' -- bigint(20)";
    $resultUpdate = $con->query($queryUpdate);
    $log->info("Query change password :: $queryUpdate");
    //send email
    if($resultUpdate){
        $from = "KID Developers";
        $reply = "donotreply";
        $to = "$emaild";
        $log->info("User Email Id for recover password: $to");
        $subject = "Password Recovery";
        // To send HTML mail, the Content-type header must be set
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($reply) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h1 style="color:#f40;">Hi '.$userId.'!</h1>';
        $message .= '<p style="font-size:15px;">You or someone else have requested your account details.</p>';
        $message .= '<p style="font-size:15px;">Here is your account information please keep this as you may need this at a later stage..</p>';
        $message .= '<p style="color:#080;font-size:15px;">
            Your username: <b>'.$userId.'</b><br/>
            Password: <b>'.$key.'</b>.</p>';
        
        $message .= '<p style="font-size:15px;">Click here to login -&nbsp;<a title="Kashi India Developers Portal" href="http://nbfclimited.com/kid" target="_blank" rel="noopener">Kashi India Developers</a></p>';
        $message .= '</body></html>';

        $sent = mail($to, $subject, $message, $headers);
        $log->info("Message For Recover Password: $message");
        $log->info("Mail Function : $sent");
        if($sent){
            $msg="Password reset and sent to your email successfully. Check your mailbox.";
            $setUrl='../../index.php?info='.$msg;
        }
        else{
            $msg="Password reset process failed. Try again!.";
            $setUrl='../../index.php?info='.$msg;
        }
    }
    else{
        $msg="Failed to send mail. Try again!.";
        $setUrl='../../index.php?info='.$msg;
    }
}else{
    $msg="Not fount! Please enter regsitered email id.";
    $setUrl='../../index.php?info='.$msg;
}
header("Location: $setUrl");
ob_end_clean();
?>