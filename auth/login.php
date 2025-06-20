<?php
include "../connect.php";
include "../mail/mailer.php" ;


$email = filterRequest("email");
$password = sha1("password") ;


$stmt =$con-> prepare("SELECT * FROM users WHERE `users_email` = ? OR `users_password` = ?");
$stmt -> execute(array($email , $password));
$count = $stmt->rowCount();



?>