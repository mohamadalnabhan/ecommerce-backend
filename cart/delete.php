<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

// Build WHERE condition directly
$where = "cart_userid = $userid AND cart_itemid = $itemid AND cart_orders = 0";

// Call deleteData WITHOUT params
deleteData("cart", $where);
