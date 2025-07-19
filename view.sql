
CREATE VIEW  items1view AS
SELECT items.* , categories.* FROM items 
INNER JOIN  categories on  items.items_catrgories = categories.categories_id , 

SELECT items2view.*, 1 AS favorite
    FROM items2view
    INNER JOIN favorite ON favorite.favorite_itemsid = items2view.items_id
    WHERE favorite.favorite_usersid = ? AND items2view.categories_id = ?

    UNION ALL

    SELECT items2view.*, 0 AS favorite
    FROM items2view
    WHERE items2view.categories_id = ?
    AND items2view.items_id NOT IN (
        SELECT favorite.favorite_itemsid
        FROM favorite
        WHERE favorite.favorite_usersid = ?
    )

    
CREATE OR REPLACE VIEW MyFavorite AS 
SELECT favorite.*, items.*, users.users_id 
FROM favorite
INNER JOIN users ON users.users_id = favorite.favorite_usersid
INNER JOIN items ON items.items_id = favorite.favorite_itemsid;
