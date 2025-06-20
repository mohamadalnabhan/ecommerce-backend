<?php
include "../connect.php";
include "../mail/mailer.php" ;
 
$email = filterRequest("email");

$verifyCode = rand(10000,99999) ; 

$stmt =$con-> prepare("SELECT * FROM users WHERE `users_email` = ? ");
$stmt -> execute(array($email ));
$count = $stmt->rowCount();

result($count);

if($count > 0){
    $data = array("users_verifycode"=> $verifyCode);
    updateData("users" ,$data ,"users_email = '$email' " , false);
    $sent = sendEmail($email ,"password reset code ", "Verification code $verifyCode");

    if (!$sent) {
    error_log("❌ sendEmail failed for $email");
}

}