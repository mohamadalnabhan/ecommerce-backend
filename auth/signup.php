<?php
include "../connect.php";

$username = filterRequest("username") ;
$phone = filterRequest("phone") ;
$email = filterRequest("email");
$password = sha1("password") ;
$verifyCode = "0" ; 

$stmt =$con-> prepare("SELECT * FROM users WHERE `users_email` = ? OR `users_phone` = ?");
$stmt -> execute(array($email , $phone));
$count = $stmt->rowCount();

if($count > 1){
   printFailure("error happened with email or phone number") ;
}else{
    $data =  array(
    "users_name" => $username ,
    "users_phone" => $phone ,
    "users_email" => $email ,
    "users_password" => $password ,
    "users_verifycode" => $verifyCode 
    );
    insertData("users" , $data);
}

?>