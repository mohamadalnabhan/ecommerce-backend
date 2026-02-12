<?php
include "../connect.php";

$orders_userid = filterRequest("orders_userid");
$orders_type = filterRequest("orders_type");
$orders_address = filterRequest("orders_address");
$orders_pricedelivery = filterRequest("orders_pricedelivery");
$orders_price = filterRequest("orders_price");
$coupon_id = filterRequest("coupon_id");
$orders_paymentmethod = filterRequest("orders_paymentmethod");

// Check if required parameters are present
if (!$orders_userid || !$orders_type || !$orders_price) {
    echo json_encode(array("status" => "error", "message" => "Missing required parameters"));
    exit;
}

$data = array(
    "orders_userid" => $orders_userid,
    "orders_type" => $orders_type,
    "orders_address" => $orders_address,
    "orders_pricedelivery" => $orders_pricedelivery,
    "orders_price" => $orders_price,
    "orders_coupons" => $coupon_id,
    "orders_paymentmethod" => $orders_paymentmethod,
);

$count = insertData("orders", $data, false);

if ($count > 0) {
    $stmt = $con->prepare("SELECT MAX(orders_id) from orders");
    $stmt->execute();
    $maxid = $stmt->fetchColumn();
    $data = array("cart_orders" => $maxid);
    updateData("cart", $data, "cart_userid = $orders_userid AND cart_orders = 0");
    
    echo json_encode(array("status" => "success", "orders_id" => $maxid));
} else {
    echo json_encode(array("status" => "error", "message" => "Failed to insert order"));
}
?>
