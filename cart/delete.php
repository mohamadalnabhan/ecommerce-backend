<?php
// favDelete.php
include "../connect.php"; // Ensure this file only establishes connection and nothing else

// Assuming filterRequest function is defined in connect.php or an included utility
$userid = filterRequest("userid");
$itemid = filterRequest("itemid"); // Using 'itemid' consistently
   






deleteData("cart" , "cart_id  = (SELECT cart_id FROM cart WHERE cart_usersid = $userid AND cart_itemsid = $itemid LIMIT 1)"); 


?>