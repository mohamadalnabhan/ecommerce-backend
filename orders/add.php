<?php
include "../connect.php" ; 



$orders_userid = filterRequest("orders_userid");
$orders_type = filterRequest("orders_type");
$orders_address = filterRequest("orders_address");
$orders_pricedelivery = filterRequest("orders_pricedelivery");
$orders_price = filterRequest("orders_price");
$coupon_id = filterRequest("coupon_id");
$orders_paymentmethod = filterRequest("orders_paymentmethod");


$data = array(
    "orders_userid" => $orders_userid,
    "orders_type" => $orders_type,
    "orders_address" => $orders_address,
    "orders_pricedelivery" => $orders_pricedelivery,
    "orders_price" => $orders_price,
    "orders_coupons" => $coupon_id,
    "orders_paymentmethod" => $orders_paymentmethod,
);

$count  = insertData("orders" , $data , false) ; 

if($count > 0){
    $stmt = $con ->prepare("SELECT MAX(orders_id) from orders") ; 
    $stmt ->execute() ; 
    $maxid= $stmt->fetchColumn() ;
    $data=array("cart_orders" =>$maxid);

    updateData("cart" , $data , "cart_userid = $userid AND cart_orders = 0");
}


?>
