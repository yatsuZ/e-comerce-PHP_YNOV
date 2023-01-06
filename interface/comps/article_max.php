<?php

$stockByProducts_ = array_map(null, array_column($stock_, 'id_product'), $stock_);
foreach ($stockByProducts_ as [$key, $value]){
    $key = array_search($key, array_column($prdcts, 'id_product'));
    $prdcts[$key]["stock"][$value["size"]] = $value["in_stock"];
}

?>
<?php $art = $prdcts[array_search($query,array_column($prdcts, 'id_product'))]; ?>
<?php $imgs = ($pdo->query('SELECT * FROM Imgs WHERE id_product = '.$query))->fetchAll(); ?>
<?php $inStock = $art['stock']; $inStock = array_keys(array_diff($inStock, [0])); ?>

<article>
    <div class="etia_carousel_1 container" style="width:100%;">
        <img src="<?= $imgs[0]['url']; ?>" style="">
    </div>
</article>
<article>
    <span class="Description"> <!--Description de l'article-->
        <h1> <?= $art['name'] ?> </h1>
        <h3> [<?= ($pdo->query('SELECT * FROM Category WHERE id_category = '.$art['id_category']))->fetchAll()[0]['name_category'] ?>] </h3>
        <span> <?= $art['price'] ?>$ </span>
    </span>
    <hr>
    <section>
        <div class="etia_carousel_1 selector" style="height:100px;overflow-x: auto;overflow-y: hidden;">
            <div style="height:100%;width: max-content;"><?php foreach ($imgs as $img){ ?> <button style="display:inline-block;height:100%;margin:0;padding:0;" onclick="var c = this.innerHTML; $('.etia_carousel_1.container').html(c);"><img src="<?= $img['url']; ?>" alt=""></button> <?php } ?></div>
        </div>
    </section>
    <section style="padding: 20px;">
        <?php
            if(!empty($inStock)){
        ?>
            <button type='submit' name='opCart' value='add<?= $art["id_product"]; ?>' onclick='send(this.value+"|"+this.parentNode.querySelector("select").value);'>+ Ajouter au panier</button>
            <?php
                echo (!empty($inStock)) ? "<select>".implode('',array_map(function($v){
                    return "<option value='$v'>Taille : $v</option>";
                }, $inStock))."</select>" : ""
            ?>
        <?php
            }else{
        ?>
            Rien en stock pour l'instant...
        <?php
            }
        ?>
    </section>
</article>

<style>
    article h1, article h2, article h3{
        margin:0;
    }
    .Description *{
        padding-bottom: 5px;
    }
    article{
        padding: 30px;
    }
    [article]{
        width: 100%;
    }
    img{max-width: 100%;max-height :100%;}
    .etia_carousel_1.container img{
        object-fit: cover;
        /* aspect-ratio: 1 / 1; */
    }
</style>
<script>
    var send = function(val){
        $(document).ready(function(){
            $.post("/subpage_cart_table_back", {"op" : val});
        });
    };
</script>