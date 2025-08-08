<?php
ob_start();
include "../connect.php";



// // Log incoming ID
// file_put_contents("debug_id_log.txt", "ID = " . $categories_id);

// if (empty($categories_id)) {
//     echo json_encode(["status" => "failure", "message" => "Missing category ID"]);
//     exit;
// }

// getAllData("items1view", "categories_id = ?", [$categories_id]);

// ob_end_flush();


$categories_id = filterRequest("id");
$userid = filterRequest("userid");
$stmt = $con->prepare("
    SELECT 
        items2view.*, 
        1 AS favorite, 
        ROUND(items_price - (items_price * items_discount / 100), 2) AS itemsPriceDiscount
    FROM items2view
    INNER JOIN favorite 
        ON favorite.favorite_itemsid = items2view.items_id
    WHERE favorite.favorite_usersid = ? 
      AND items2view.categories_id = ?

    UNION ALL

    SELECT 
        items2view.*, 
        0 AS favorite, 
        ROUND(items_price - (items_price * items_discount / 100), 2) AS itemsPriceDiscount
    FROM items2view
    WHERE items2view.categories_id = ?
      AND items2view.items_id NOT IN (
          SELECT favorite.favorite_itemsid
          FROM favorite
          WHERE favorite.favorite_usersid = ?
      )
");

$stmt->execute([$userid, $categories_id, $categories_id, $userid]);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "failure"]);
}

ob_end_flush();
