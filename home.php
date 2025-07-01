<?php
include "connect.php";

$getDataArray = array(); 
$getDataArray['status'] = "success"; 
$categories = getAllData("categories", null, null, false);

$getDataArray['categories'] = $categories;


$items = getAllData("items1view" , "`items_discount` != 0 " , null , false);
$getDataArray['items'] = $items;
echo json_encode([
  "status" => "success",
  "categories" => $categories,
  "items" => $items
], JSON_UNESCAPED_UNICODE);

?>
