<?php
// favDelete.php
include "../connect.php"; // Ensure this file only establishes connection and nothing else

// Assuming filterRequest function is defined
$userid = filterRequest("userid");
$itemid = filterRequest("itemid"); // Using 'itemid' consistently

// Perform the deletion
$countdelete = deleteData("favorite", "favorite_usersid = ? AND favorite_itemsid = ?", array($userid, $itemid)); // Assuming deleteData returns affected rows (>0 on success)

exit(); // Crucial: terminate script immediately after JSON output

?>