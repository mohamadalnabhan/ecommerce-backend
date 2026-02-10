<?php
include "../connect.php";



$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

// 🔕 IMPORTANT: disable JSON output from getData
$count = getData(
    "cart",
    "cart_itemid = $itemid AND cart_userid = $userid AND cart_orders = 0",
    null,
    false // already false, BUT getData itself probably still echoes
);

// OPTIONAL: prevent duplicates
if ($count > 0) {
    echo json_encode(["status" => "success"]);
    exit;
}

$data = [
    "cart_userid" => $userid,
    "cart_itemid" => $itemid,
];

// 🔕 Disable JSON here too
insertData("cart", $data, false);

// ✅ ONE response. ALWAYS.
echo json_encode(["status" => "success"]);
