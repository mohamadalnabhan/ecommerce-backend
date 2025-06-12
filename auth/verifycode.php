<?php
include "../connect.php";
include "../mail/mailer.php" ;
$email = filterRequest("email");
$verifycode = filterRequest("verifycode");

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = '$email' AND users_verifycode= '$verifycode' ");
$stmt-> execute();
$count = $stmt->rowCount();
if($count > 0){
    $data = array("users_approved" => "1");
    updateData("users" , $data ,"users_email = '$email' ");
}else{
    printFailure("verification code error");
}


?>