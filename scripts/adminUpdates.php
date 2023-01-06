<?php

if (isset($_POST['add_img']) && !empty($_FILES['add_img'])) {
    $files = $_FILES['add_img']['tmp_name'];
    $filesName = $_FILES['add_img']['name'];
    foreach ($files as $id_product => $tmpCont) {
        foreach ($tmpCont as $id_file => $tmp) {
            $n = "database/imgs/".$id_product.'_'.count(scandir("database/imgs/")).'_'.pathinfo($tmp)['filename'].'.'.pathinfo($filesName[$id_product][$id_file])['extension'];
            move_uploaded_file($tmp, $n);
            $pdo->query("INSERT INTO imgs (id_product, url) VALUES ($id_product, '/$n');");
        }
    }
    header('Location: /admin/products');
}

if (isset($_POST['rmv_img'])) {
    $id = $_POST['rmv_img'];
    $pdo->query("DELETE FROM Imgs WHERE id_img = $id;");
    //header('Location: /admin/products');
}

if (isset($_POST['prdcts'])) {
    foreach ($_POST['prdcts'] as $id => $prdct) {
        foreach ($prdct as $k => $v) {
            if($k != 'name_category') {
                $sql = "UPDATE Product SET $k = '$v' WHERE id_product = $id;";
                $prdctFetch = $pdo->query($sql);
            }
        }
    }
    header('Location: /admin/products');
}
if (isset($_POST['add_prdct'])) {
    $pdo->query("INSERT INTO Product (name) VALUES ('');");
    header('Location: /admin/products');
}
if (isset($_POST['rmv_prdct'])) {
    $id = $_POST['rmv_prdct'];
    $prdctFetch = $pdo->query("DELETE FROM Product WHERE id_product = $id;");
    header('Location: /admin/products');
}

if (isset($_POST['stock'])) {
    foreach ($_POST['stock'] as $id => $prdct) {
        foreach ($prdct as $k => $v) {
            try{
                $prdctFetch = $pdo->query("UPDATE Stock SET $k = '$v' WHERE id_stock = $id;");
            }catch(Exception $e) {
                header('Location: /admin/products');
            }
        }
    }
    header('Location: /admin/products');
}
if (isset($_POST['add_stock'])) {
    $pdo->query("INSERT INTO Stock (id_product) VALUES (".$_POST['add_stock'].");");
    header('Location: /admin/products');
}
if (isset($_POST['rmv_stock'])) {
    $id = $_POST['rmv_stock'];
    $prdctFetch = $pdo->query("DELETE FROM Stock WHERE id_stock = $id;");
    header('Location: /admin/products');
}


if (isset($_POST['add_users'])) {
    $pdo->query("INSERT INTO User (password) VALUES ('".password_hash("1234", PASSWORD_DEFAULT)."');");
    header('Location: /admin/users');
}
if (isset($_POST['rmv_users'])) {
    $id = $_POST['rmv_users'];
    $prdctFetch = $pdo->query("DELETE FROM User WHERE id_user = $id;");
    header('Location: /admin/users');
}
if (isset($_POST['users'])) {
    foreach ($_POST['users'] as $id => $prdct) {
        foreach ($prdct as $k => $v) {
            $sql = "UPDATE User SET $k = '$v' WHERE id_user = $id;";
            $pdo->query($sql);
        }
    }
    header('Location: /admin/users');
}

