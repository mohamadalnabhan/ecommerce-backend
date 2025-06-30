<?php
include "connect.php";

$getDataArray = array(); 

$categories = getAllData("categories", null, null, false);

$getDataArray['categories'] = $categories;
echo json_encode($getDataArray);
?>
