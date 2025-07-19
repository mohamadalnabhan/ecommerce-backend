<?php
include "../connect.php" ; 


$userid = filterRequest("userid");


getAllData("MyFavorite" , "favorite_usersid = ?",array($userid)); 

?>