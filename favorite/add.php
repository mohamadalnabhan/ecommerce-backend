<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemsid = filterRequest("itemid"); // ✅ Make sure this matches what's sent from Flutter

$data = array(
    "favorite_usersid" => $userid,
    "favorite_itemsid" => $itemsid,
);

$result = insertData("favorite", $data);

if ($result > 0) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failure"]);
}
