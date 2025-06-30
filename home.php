<?php
include "connect.php";


$getDataArray = array(); 

$categories = getAllData("categories" , null , null , false);


$getDataArray['categories'] = $categories ;  // ['categories is a key']


return json_encode($getDataArray);

?>