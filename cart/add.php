<?php
// favAdd.php
include "../connect.php"; // Ensure this file only establishes connection and nothing else

// Assuming filterRequest function is defined in connect.php or an included utility
$userid = filterRequest("userid");
$itemid = filterRequest("itemid"); // Using 'itemid' consistently


$count = getData("cart" ,"cart_itemid = $itemid AND cart_userid = $userid" ,null,false );

$data = array(
    "cart_userid" => $userid ,
    "cart_itemid" => $itemid , 

);

insertData("cart" ,$data );



?>