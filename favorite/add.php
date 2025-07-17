<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemsid = filterRequest("itemid");

$data = array(
    "favorite_usersid" => $userid,
    "favorite_itemsid" => $itemsid,
);

$result = insertData("favorite", $data);

if ($result > 0) {
    echo json_encode(["status" => "success"]);
    exit(); // ✅ make sure you EXIT
} else {
    echo json_encode(["status" => "failure"]);
    exit(); // ✅ make sure you EXIT
}
?>
