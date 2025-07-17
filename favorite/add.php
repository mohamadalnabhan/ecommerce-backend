<?php
// favAdd.php
include "../connect.php"; // Ensure this file only establishes connection and nothing else

// Assuming filterRequest function is defined in connect.php or an included utility
$userid = filterRequest("userid");
$itemid = filterRequest("itemid"); // Using 'itemid' consistently

// Check if the favorite already exists to prevent duplicates
$stmt = $con->prepare("SELECT COUNT(*) FROM favorite WHERE favorite_usersid = ? AND favorite_itemsid = ?");
$stmt->execute(array($userid, $itemid));
$exists = $stmt->fetchColumn();

if ($exists > 0) {
    // Item is already favorited
    echo json_encode(["status" => "fail", "message" => "Item already favorited"]);
} else {
    $data = array(
        "favorite_usersid" => $userid,
        "favorite_itemsid" => $itemid,
    );

    $result = insertData("favorite", $data); // Assuming insertData returns affected rows (>0 on success)

    if ($result > 0) {
        echo json_encode(["status" => "success", "message" => "Item added to favorites"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Failed to add item to favorites"]);
    }
}
exit(); // Crucial: terminate script immediately after JSON output
?>
