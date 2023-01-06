<?php

$stockByProducts_ = array_map(null, array_column($stock_, 'id_product'), $stock_);
foreach ($stockByProducts_ as [$key, $value]){
    $key = array_search($key, array_column($prdcts, 'id_product'));
    $prdcts[$key]["stock"][$value["size"]] = $value["in_stock"];
}
unset($stockByProducts_);

// echo "<pre>"; 
// echo json_encode($prdcts);	
// echo "</pre>";

$card = function($data){
    extract($data);
    $inStock = array_keys(array_diff($stock, [0]));
    $selectStock = (!empty($inStock)) ? "<select>".implode('',array_map(function($v){
        return "<option value='$v'>Taille : $v</option>";
    }, $inStock))."</select>" : "";
    $stockEcho = implode(', ', $inStock);
    $stockEcho_ = implode('|', $inStock);
    $stockEcho = (empty($stockEcho)) ? "rien" : $stockEcho ;
    $button = (!empty($_COOKIE[md5('AUTH_KEY')])) ? "<a href='/articles/$id_product'><button type='button'>Voir l'article</button></a>" : "<a href='/login'><button type='button'>Se connecter pour voir</button></a>";
    $button2 = (!empty($_COOKIE[md5('AUTH_KEY')]) && !empty($inStock)) ? "\n<button type='submit' name='opCart' value='add$id_product' onclick='send(this.value+\"|\"+this.parentNode.querySelector(\"select\").value);'>+ Ajouter au panier</button>$selectStock" : '';
    echo "<div card title='$name' price='$price' color='$color' pntr='$stockEcho_' cat='$name_category'>
        <div class='img'><img src='$img'></div>
        <div class='foot'>
            <div class='head'>
                <div class='title'>[$name_category] $name</div>
                <div class='price'>$price$</div>
            </div>
            $color <br><br>
            Tailles en stock :
            $stockEcho
            $button
            <div class='foot'>$button2</div>
        </div>
    </div>";
};

?>