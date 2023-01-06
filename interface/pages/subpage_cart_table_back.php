<?php

if(empty($_POST)){
    $cart = [];
    $cartFetch = $pdo->query("SELECT * FROM (SELECT Cart.id_cart, Valid_Command.id_valid_command, nb_products, id_product, size, Cart.id_user FROM Cart
    LEFT JOIN Valid_Command ON Cart.id_cart = Valid_Command.id_cart
    LEFT JOIN Received_Command ON Valid_Command.id_valid_command = Received_Command.id_valid_command
    WHERE Cart.id_user = $authKey) AS Cart_History
    INNER JOIN Product ON Cart_History.id_product = Product.id_product
    INNER JOIN Category ON Product.id_category = Category.id_category
    ");
    $cartHistory = $cartFetch->fetchAll();

    $cart = array_filter($cartHistory, function ($a){
        return ($a["id_valid_command"] == null || $a["nb_products"] > 0);
    });

    $total = number_format(array_sum(array_map(function($prix, $nb){
        return $prix*$nb;
    }, array_column($cart, 'price'),array_column($cart, 'nb_products'))));

    $row = function ($v){
        $id = $v["id_cart"];
        $echo = "<tr>";
        $echo .= "<td>".$v["name"]."</td>";
        $echo .= "<td>".$v["name_category"]."</td>";
        $echo .= "<td>".$v["price"]."</td>";
        $echo .= "<td>".$v["color"]."</td>";
        $echo .= "<td>".$v["size"]."</td>";
        $echo .= "<td>"."<button type='submit' name='opCart' value='minus$id' onclick='send(this.value);'>-</button>".$v["nb_products"]."<button type='submit' name='opCart' value='plus$id' onclick='send(this.value);'>+</button>"."</td>";
        $echo .= "</tr>";
        $echo .= "<style>a:has(#pagar>span){display: block !important;}</style>";

        return $echo;
    };

    $ret = (!empty($cart)) ? ['table'=>array_merge(['<tr><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Couleur</th><th>Pointure</th><th>Quantité</th></tr>'], array_map($row, $cart)), 'total'=>$total] : ['table'=>["Le panier est vide"]];

    echo json_encode($ret);
}else{
    if(str_starts_with($_POST['op'], 'minus')){
        $id = str_replace('minus', '',$_POST['op']);
        $cartEFetch = $pdo->query("SELECT * FROM Cart WHERE id_cart = $id");
        list($cartE) = $cartEFetch->fetchAll();
        $nb_products = $cartE['nb_products']-1;
        $pdo->query(
            ($nb_products>0) ? "UPDATE Cart SET nb_products = '$nb_products' WHERE id_cart = $id;" : "DELETE FROM Cart WHERE id_cart = $id;"
        );
    }
    if(str_starts_with($_POST['op'], 'plus')){
        $id = str_replace('plus', '',$_POST['op']);
        $cartEFetch = $pdo->query("SELECT * FROM Cart WHERE id_cart = $id");
        list($cartE) = $cartEFetch->fetchAll();
        $nb_products = $cartE['nb_products']+1;
        $pdo->query("UPDATE Cart SET nb_products = '$nb_products' WHERE id_cart = $id;");
    }
    if(str_starts_with($_POST['op'], 'add')){
        list($id, $size) = explode('|',str_replace('add', '',$_POST['op']));
        $cartEFetch = $pdo->query("SELECT * FROM Cart WHERE id_user = $authKey AND id_product = $id AND size = $size");
        @list($cartE) = $cartEFetch->fetchAll();
        if (empty($cartE)) {
            $pdo->query("INSERT INTO Cart (id_product, nb_products, size, id_user) VALUES ($id, 1, $size, $authKey)");
            echo "insert";
        }else{
            $id = $cartE['id_cart'];
            echo json_encode($cartE);
            $nb_products = $cartE['nb_products']+1;
            $pdo->query("UPDATE Cart SET nb_products = '$nb_products' WHERE id_cart = $id;");
        }
    }
}

?>
