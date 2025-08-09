<?php
include "../connect.php" ; 



$table= "address" ;
$userid = filterRequest("userid");
$city = filterRequest("city");
$name = filterRequest("name") ; 
$street = filterRequest("street");
$long = filterRequest("long");
$lang = filterRequest("lang");






$data = array(
    "address_user_id" => $userid , 
    "address_name" =>$name , 
    "address_city" => $city ,
    "address_street" => $street,
    "address_long" =>$long,
    "address_lat" => $lang ,
) ; 



insertData($table , $data) ; 




?>