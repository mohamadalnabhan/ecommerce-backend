<?php
include "../connect.php" ; 



$table= "address" ;
$addressid = filterRequest("address_id");
$name = filterRequest("name") ; 
$city = filterRequest("city");
$street = filterRequest("street");
$long = filterRequest("long");
$lang = filterRequest("lang");






$data = array(
     "address_name" =>$name , 
    "address_city" => $city ,
    "address_street" => $street,
    "address_long" =>$long,
    "address_lat" => $lang ,
) ; 



updateData($table , $data , "address_id = $addressid" ) ; 




?>