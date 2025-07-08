<?php
ob_start(); // ✅ buffer output

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../connect.php";


$categories_id = filterRequest("id");

getAllData("items1view", "`categories_id` = $categories_id", null, true);

ob_end_flush(); // ✅ flush output
