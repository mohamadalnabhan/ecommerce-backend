<?php
include "../connect.php";

// Use consistent parameter names with add.php
$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

// Fix 1: Use correct column name 'cart_userid' not 'cart_usersid'
// Fix 2: Delete directly without subquery
$conditions = "cart_userid = ? AND cart_itemid = ? AND cart_orders = 0";
$params = array($userid, $itemid);

// If you have deleteData function
deleteData("cart", $conditions, $params);
