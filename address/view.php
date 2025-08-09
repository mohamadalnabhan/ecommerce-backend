<?php
// favDelete.php
include "../connect.php"; 

// Assuming filterRequest function is defined in connect.php or an included utility
$userid = filterRequest("userid");


$data = getAllData("address" , "address_user_id = $userid" , null , false);




?>