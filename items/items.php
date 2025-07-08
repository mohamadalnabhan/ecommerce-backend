<?php
ob_start(); // ✅ buffer output

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../connect.php";



getAllData("items1view", "`items_discount` != 0", null, false);

ob_end_flush(); // ✅ flush output
