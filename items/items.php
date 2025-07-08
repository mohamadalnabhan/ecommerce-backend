<?php
// ✅ Show PHP errors in browser
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Test that PHP runs at all
echo "👋 PHP is working before DB call.<br>";

include "../connect.php";

// ✅ Confirm DB connection
if (!$con) {
    die("❌ DB connection failed.");
}

// ✅ Call your data function (still hidden in another file)
getAllData("items1view", "`items_discount` != 0", null, false);
?>
