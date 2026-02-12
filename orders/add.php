<?php
// NO whitespace or HTML before <?php
include "../connect.php";

// Get parameters - support both POST and GET
function filterRequest($requestname) {
    if (isset($_POST[$requestname])) {
        return $_POST[$requestname];
    } elseif (isset($_GET[$requestname])) {
        return $_GET[$requestname];
    }
    return null;
}

$orders_userid = filterRequest("orders_userid");
$orders_type = filterRequest("orders_type");
$orders_address = filterRequest("orders_address");
$orders_pricedelivery = filterRequest("orders_pricedelivery");
$orders_price = filterRequest("orders_price");
$coupon_id = filterRequest("coupon_id");
$orders_paymentmethod = filterRequest("orders_paymentmethod");

// Debug: Log received parameters
error_log("Received parameters: " . json_encode($_POST));

// Validate required parameters
if (!$orders_userid) {
    echo json_encode(array("status" => "error", "message" => "orders_userid is missing"));
    exit;
}
if (!$orders_type) {
    echo json_encode(array("status" => "error", "message" => "orders_type is missing"));
    exit;
}
if (!$orders_price) {
    echo json_encode(array("status" => "error", "message" => "orders_price is missing"));
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
    $updateData = array("cart_orders" => $maxid);
    updateData("cart", $updateData, "cart_userid = $orders_userid AND cart_orders = 0");
    
    echo json_encode(array("status" => "success", "orders_id" => $maxid));
} else {
    echo json_encode(array("status" => "error", "message" => "Failed to insert order"));
}
?>
