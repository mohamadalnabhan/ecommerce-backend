<?php
// favDelete.php
include "../connect.php"; // Ensure this file only establishes connection and nothing else

// Assuming filterRequest function is defined
$userid = filterRequest("userid");
$itemid = filterRequest("itemid"); // Using 'itemid' consistently

// Perform the deletion
$countdelete = deleteData("favorite", "favorite_usersid = ? AND favorite_itemsid = ?", array($userid, $itemid)); // Assuming deleteData returns affected rows (>0 on success)

if ($countdelete > 0) {
    echo json_encode(["status" => "success", "message" => "Item removed from favorites"]);
} else {
    echo json_encode(["status" => "fail", "message" => "Favorite not found or could not be deleted"]);
}
exit(); // Crucial: terminate script immediately after JSON output

?>