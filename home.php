<?php
include "connect.php";

$getDataArray = array(); 
$getDataArray['status'] = "success"; 
$categories = getAllData("categories", null, null, false);

$getDataArray['categories'] = $categories;
echo json_encode($getDataArray);

$items = getAllData("items" , "`items_discount` != 0 " , null , false);
$getDataArray['items'] = $items;
echo json_encode($getDataArray);

?>
