<?php

$cartFetch = $pdo->query("SELECT * FROM (SELECT Cart.id_cart, Valid_Command.id_valid_command, nb_products, id_product, size, Cart.id_user FROM Cart
LEFT JOIN Valid_Command ON Cart.id_cart = Valid_Command.id_cart
LEFT JOIN Received_Command ON Valid_Command.id_valid_command = Received_Command.id_valid_command
WHERE Cart.id_user = $authKey) AS Cart_History
INNER JOIN Product ON Cart_History.id_product = Product.id_product
INNER JOIN Category ON Product.id_category = Category.id_category
");
$cartHistory = $cartFetch->fetchAll();

$history = array_filter($cartHistory, function ($a){
    //return ($a["id_valid_command"] != null);
});

print_r($history);

?>