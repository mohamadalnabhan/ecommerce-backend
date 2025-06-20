<?php
include "../connect.php";
include "../mail/mailer.php" ;
$username = filterRequest("username") ;
$phone = filterRequest("phone") ;
$email = filterRequest("email");
$password = sha1($_POST['password']) ;
$verifyCode = rand(10000,99999) ; 

$stmt =$con-> prepare("SELECT * FROM users WHERE `users_email` = ? OR `users_phone` = ?");
$stmt -> execute(array($email , $phone));
$count = $stmt->rowCount();

if($count > 0){
   printFailure("error happened with email or phone number") ;
}else{
    $data =  array(
    "users_name" => $username ,
    "users_phone" => $phone ,
    "users_email" => $email ,
    "users_password" => $password ,
    "users_verifycode" => $verifyCode 
    );
    $sent = sendEmail($email ,"Verification code Test", "Verification code $verifyCode");

    if (!$sent) {
    error_log("❌ sendEmail failed for $email");
}
    insertData("users" , $data);
}

?>