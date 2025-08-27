<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

// Step 1: Select cart_id safely
$stmt = $con->prepare("SELECT cart_id FROM cart WHERE cart_userid = ? AND cart_itemid = ? LIMIT 1 AND cart_orders = 0");
$stmt->execute([$userid, $itemid]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Step 2: If found, delete using the ID
if ($row) {
    $cartId = $row['cart_id'];
    deleteData("cart", "cart_id = $cartId");
} else {
    printFailure("Cart item not found");
}
