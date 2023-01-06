<form action="" method="POST">
    <div style="padding:20px">
        <a href="/admin"><button type="button">Retour</button></a>
        <button type="submit" name="add_users">Créer un utilisateur (ligne vide)</button>
        <button type="submit">Enregister les modifications (Utilisateurs)</button>
    </div>
    <div class="grid">
    <div class="product">
        <div class="head_" style="height:100%;">
            <h1>Produits</h1>
            Ici, vous pourrez contrôler les comptes clients. Chaque compte crée à partir d'ici sera doté du mot de passe 1234.
        </div>
    </div>

    <?php foreach ( $users as $row ) { ?>
        <div class="product">
            <div class="head">
                    <div><button> id : <?= $row['id_user']; ?></button></div>
                    <?php foreach ($row as $key => $cell) { ?>
                        <?php if($key != 'id_user') { ?>
                            <div><span><?= ['phone_number'=>'Numéro de téléphone','pseudo'=>'Nom d\'utilisateur','email'=>'Email', 'admin'=>'Admin ? (0/1)','date_of_birth'=>'Date de naissance'][$key] ?></span><input type="<?= ($key == 'date_of_birth') ? 'date' : 'text' ?>" name="users[<?= $row['id_user']; ?>][<?= $key ?>]" value="<?= $cell ?>"></div>
                        <?php } ?>
                    <?php } ?>
                    <div><button type="submit" value="<?= $row['id_user']; ?>" name="rmv_users">Supprimer l'utilisateur</button></div>
            </div>
        </div>
    <?php } ?>
    </div>
</form>

<script src="/scripts/accordion.js"></script>
<link rel="stylesheet" href="/styles/admin.css">
