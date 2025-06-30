<?php
include "connect.php";

$getDataArray = array(); 

$categories = getAllData("categories", null, null, false);

$getDataArray['categories'] = $categories;

header("Content-Type: application/json"); // optional, makes it return JSON properly
echo json_encode($getDataArray);
?>
