<?php

include "../connect.php" ; 

$favid = filterRequest("favid");

deleteData("favorite" , "favorite_id = $favid");

?>