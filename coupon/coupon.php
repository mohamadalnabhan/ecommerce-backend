<?php
include "../connect.php";



$coupon = filterRequest("couponName");

$now = date("Y-m-d H:i:s");

getData("coupon" , "coupon_name = $coupon AND coupon_expireydate > $now AND coupon_count > 0") ; 





?>