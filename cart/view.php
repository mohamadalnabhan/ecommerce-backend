<?php
// favDelete.php
include "../connect.php"; 

// Assuming filterRequest function is defined in connect.php or an included utility
$userid = filterRequest("userid");


$data = getAllData("cartview" , "cart_userid = $userid" , null , false);

$stmt = $con->prepare("SELECT SUM(totalPrice) as totalItemsPrice , SUM(itemCount) as totalItemCount FROM `cartview`

WHERE cart_userid
GROUP BY cartview.cart_userid = $userid");
$stmt -> execute();

$dataCountAndPrice = $stmt->fetch(PDO::FETCH_ASSOC) ; 

echo json_encode(array(
    "status" => "success" ,
    "datacart" => $data,
    "countAndPrice" =>$dataCountAndPrice
));


?>