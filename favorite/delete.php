<?php 

include "../connect.php" ; 

$usersid = filterRequest("userid") ; 
$itemsid = filterRequest("itemid") ; 

deleteData("favorite" , "favorite_usersid = $userid AND favorite_itemsid = $item
id") ; 