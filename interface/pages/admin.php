<?php

require('scripts/adminUpdates.php');

?>
<div body style="overflow:auto;">
<?php

if (empty($query)){

?>
    <ul style="list-style-type: none;">
        <li><a href="/admin/products"><button type="button">Panel Produits</button></a></li>
        <li><a href="/admin/users"><button type="button">Panel Utilisateurs</button></a></li>
    </ul>
<?php

}else{

    if (!in_array($query.'.php', scandir("interface/pages/admin/"))) {
        header('Location: /admin');
    }

    include("interface/pages/admin/$query.php");

}

?>
</div>
