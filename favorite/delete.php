<?php
// favDelete.php
include "../connect.php"; // Ensure this file only establishes connection and nothing else

// Assuming filterRequest function is defined in connect.php or an included utility
$userid = filterRequest("userid");
$itemid = filterRequest("itemid"); // Using 'itemid' consistently

// Perform the deletion.
// Pass the parameters array as the third argument to deleteData.
$countdelete = deleteData("favorite", "favorite_usersid = $userid AND favorite_itemsid = $itemid");

// Now, echo the JSON response based on the result of deleteData
if ($countdelete > 0) {
    echo json_encode(["status" => "success", "message" => "Item removed from favorites"]);
} else {
    echo json_encode(["status" => "fail", "message" => "Favorite not found or could not be deleted"]);
}
exit(); // Crucial: terminate script immediately after JSON output
?>