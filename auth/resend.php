<?php


include "../connect.php";


$verifyCode = rand(10000,99999) ; 
$email = filterRequest("email");
$data = array(
"users_verifycode" => $verifyCode
);


updateData("users" ,$data ,"users_email = '$email' " );

sendEmail($email ,"password reset code ", "Verification code $verifyCode");

?>




