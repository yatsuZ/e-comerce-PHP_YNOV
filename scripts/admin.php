<?php

$usrsFetch = $pdo->query('SELECT id_user, admin, pseudo, email, date_of_birth, phone_number FROM User ORDER BY id_user ASC');
$users = $usrsFetch->fetchAll();

$prdctFetch = $pdo->query('SELECT * FROM Product LEFT JOIN Category ON Product.id_category = Category.id_category ORDER BY Product.id_product ASC');
$prdct_ = $prdctFetch->fetchAll();
$prdcts = $prdct_;
foreach ($prdcts as $k => $v){
    $prdcts[$k]["stock"] = [];
    $prdcts[$k]['img'] = @($pdo->query('SELECT * FROM Imgs WHERE id_product = '.$v['id_product'].' ORDER BY id_product ASC'))->fetchAll()[0]["url"] or "";
}

$stockFetch = $pdo->query('SELECT * FROM Stock ORDER BY size ASC');
$stock_ = $stockFetch->fetchAll();

$imgsFetch = $pdo->query('SELECT * FROM Imgs ORDER BY id_img ASC');
$imgs_ = $imgsFetch->fetchAll();
?>