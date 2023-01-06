<?php


$history = $pdo->query("SELECT * FROM (SELECT Cart.id_cart, Valid_Command.id_valid_command, valid_commande_date, Received_Command.id_command, reception_date, nb_products, id_product, size, Cart.id_user FROM Cart
LEFT JOIN Valid_Command ON Cart.id_cart = Valid_Command.id_cart
LEFT JOIN Received_Command ON Valid_Command.id_valid_command = Received_Command.id_valid_command
WHERE Cart.id_user = $authKey) AS Cart_History
INNER JOIN Product ON Cart_History.id_product = Product.id_product
INNER JOIN Category ON Product.id_category = Category.id_category
");
$history = $history->fetchAll();


?>

<div body>
    <table style="width:100%;">
    <?php
    $i = 0;
    foreach ($history as $item){
        if([$item['id_valid_command'], $item['id_command']] == [null,null]){
            $i++;
            if($item == $history[0]){
            ?>
            <tr><th>Validation</th><th>Réception</th><th>Nombre de produits</th><th>Taille</th><th>Nom modèle</th><th>Prix</th><th>Couleur</th><th>Catégorie</th></tr>
            <?php
            }
            echo "<tr>";
            foreach($item as $key => $field){
                if(!str_starts_with($key, 'id')){
                    echo "<td>".((str_contains($key, 'date')) ? '<input type="checkbox" disabled '.((!empty($field)) ? 'checked' : '' ).'>' : '').((!empty($field) ? $field : ''))."</td>";
                }
            }
            echo "</tr>";
        }
    }
    if($i == 0){
        echo "<tr><td>Pas d'historique</td></tr>";
    }
    ?>
    </table>
</div>