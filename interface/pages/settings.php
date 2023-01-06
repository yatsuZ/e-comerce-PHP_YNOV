<?php

if (isset($_POST['users'])) {
    $pwd = $pdo->query("SELECT password FROM User WHERE id_user = $authKey;");
    $pwd = $pwd->fetchAll();
    $pwd = $pwd[0]["password"];

    if (password_verify($_POST["users"][$authKey]["ol_password"], $pwd)){
        unset($_POST["users"][$authKey]["ol_password"]);
        if (!empty($_POST["users"][$authKey]["password"][0]) && $_POST["users"][$authKey]["password"][0] == $_POST["users"][$authKey]["password"][1]){
            $_POST["users"][$authKey]["password"] = password_hash($_POST["users"][$authKey]["password"][0], PASSWORD_DEFAULT);
        }else{
            unset($_POST["users"][$authKey]["password"]);
        }
        foreach ($_POST['users'] as $id => $user) {
            foreach ($user as $k => $v) {
                $sql = "UPDATE User SET $k = '$v' WHERE id_user = $id;";
                $pdo->query($sql);
            }
        }
    }
    //header('Location: /admin/users');
}

$userRow = $users[array_search($authKey,array_column($users, 'id_user'))];

?>
<div body style="padding:20px 0">

<?php foreach ([$userRow] as $row ) { ?>
<form action="" method="POST">
    <div class="product">
        <div class="head">
                <h1>Paramètres</h1>
                <?php foreach ($row as $key => $cell) { ?>
                    <?php if($key != 'id_user' && $key != 'admin' && $key != 'date_of_birth') { ?>
                        <div><span><?= ['phone_number'=>'Numéro de téléphone','pseudo'=>'Nom d\'utilisateur','email'=>'Email'][$key] ?></span><input type="text" name="users[<?= $row['id_user']; ?>][<?= $key ?>]" value="<?= $cell ?>" placeholder="<?= ['phone_number'=>'Numéro de téléphone','pseudo'=>'Nom d\'utilisateur','email'=>'Email'][$key] ?>"></div>
                    <?php } ?>
                <?php } ?>
                <div><span>Nouveau mot de passe</span><input type="password" name="users[<?= $row['id_user']; ?>][password][]" value="" placeholder="Nouveau mot de passe"></div>
                <div><span>Confirmation</span><input type="password" name="users[<?= $row['id_user']; ?>][password][]" value="" placeholder="Confirmation"></div>

                <div><span>Mot de passe actuel (confirmer les changements)</span><input type="password" name="users[<?= $row['id_user']; ?>][ol_password]" value="" placeholder="Mot de passe actuel"></div>
                <div><button type="submit" value="<?= $row['id_user']; ?>">Enregistrer</button></div>
        </div>
    </div>
</form>
<?php } ?>

</div>

<link rel="stylesheet" href="/styles/admin.css">
<link rel="stylesheet" href="/styles/settings.css">
