<form action="" method="POST" enctype="multipart/form-data">
    <div style="padding:20px">
        <a href="/admin"><button type="button">Retour</button></a>
        <button type="submit" name="add_prdct">Créer un produit (ligne vide)</button>
        <button type="submit">Enregister les modifications (Produits)</button>
    </div>
    <div class="grid">
    <div class="product">
        <div class="head_" style="height:100%;">
            <h1>Produits</h1>
            Ici, vous pourrez contrôler le stock et les modèles disponibles sur le site.
        </div>
    </div>

    <?php foreach ( $prdct_ as $row ) { ?>
        <div class="product">
            <div class="head">
                    <div><button> id : <?= $row['id_product']; ?></button></div>
                    <?php foreach ($row as $key => $cell) { ?>
                        <?php if($key != 'id_product') { ?>
                            <div><input type="text" name="prdcts[<?= $row['id_product']; ?>][<?= $key ?>]" value="<?= $cell ?>"><span><?= $key ?></span></div>
                        <?php } ?>
                    <?php } ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                    <div style="padding: 10px;display: grid;align-items: stretch;grid-template-columns: repeat(auto-fill,50px);">
                        <?php 
                        foreach (($pdo->query('SELECT * FROM Imgs WHERE id_product = '.$row['id_product']))->fetchAll() as $img) {
                        ?>
                        <label button style="padding:0;">
                            <img src="<?= $img["url"]; ?>" alt="" style="width: 50px; height: 70px; object-fit:cover">
                            <button type="submit" value="<?= $img['id_img']; ?>" name="rmv_img" style="display:none;">Ajouter une image</button>
                        </label>
                        <?php } ?>
                        <label button><input type="file" name="add_img[<?= $row['id_product']; ?>][]" accept="image/*" multiple style="display:none;" onchange="document.querySelector('button[value=\'<?= $row['id_product']; ?>\'][name=\'add_img\']').click();"> Ajouter une image</label><button type="submit" value="<?= $row['id_product']; ?>" name="add_img" style="display:none;">Ajouter une image</button>
                    </div>
                    </form>
                    <div><button type="button" class="show" value="<?= $row['id_product']; ?>" name="add_stock">Afficher stock</button></div>
                    <div><button type="submit" value="<?= $row['id_product']; ?>" name="add_stock">Créer du stock</button></div>
                    <div><button type="submit" value="<?= $row['id_product']; ?>" name="rmv_prdct">Supprimer le produit</button></div>
            </div>
            <div class="stock" style="padding:10px">
                <table>
                <?php foreach ( $stock_ as $row_ ) { ?>
                    <tr>
                    <?php if ( $row_['id_product'] == $row['id_product']) { ?>
                            <?php foreach ($row_ as $key => $cell) { ?>
                                <?php if($key != 'id_stock' && $key != 'id_product') { ?>
                                    <td>[<?= $key ?>] <input type="text" name="stock[<?= $row_['id_stock']; ?>][<?= $key ?>]" value="<?= $cell ?>"></td>
                                <?php } ?>
                            <?php } ?>
                            <td><button type="submit" value="<?= $row_['id_stock']; ?>" name="rmv_stock">Supprimer le stock</button</td>
                    <?php } ?>
                    </tr>
                <?php } ?>
                </table>
            </div>
        </div>
    <?php } ?>
    </div>
</form>

<script src="/scripts/accordion.js"></script>
<link rel="stylesheet" href="/styles/admin.css">