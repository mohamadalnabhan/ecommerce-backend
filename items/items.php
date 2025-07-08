<?php
ob_start();
include "../connect.php";

$categories_id = filterRequest("id");

// Log incoming ID
file_put_contents("debug_id_log.txt", "ID = " . $categories_id);

if (empty($categories_id)) {
    echo json_encode(["status" => "failure", "message" => "Missing category ID"]);
    exit;
}

getAllData("items1view", "categories_id = ?", [$categories_id]);

ob_end_flush();
