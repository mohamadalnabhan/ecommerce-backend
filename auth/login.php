<?php
include "../connect.php";
include "../mail/mailer.php" ;


$email = filterRequest("email");
$password = filterRequest("password");
// $stmt =$con-> prepare("SELECT * FROM users WHERE `users_email` = ? AND `users_password` = ? AND users_approved = 1");
// $stmt -> execute(array($email , $password));
// $count = $stmt->rowCount();
// result($count);

 getData("users" ,"`users_email` = ? AND `users_password` = ?" , array($email ,$password));
