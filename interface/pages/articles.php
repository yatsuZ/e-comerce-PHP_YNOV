<?php

if (empty($query)){
    header('Location: /home');
}

?>
<div body>
    <div id="cart">
    <a href="/home/"><button>Retour</button></a>
    <?php

    require("interface/comps/cart.php")

    ?>
    </div>

    <div article>
    <?php

    require("interface/comps/article_max.php")

    ?>
    </div>
</div>

<style>
    [article]>article{
        width: 50%;
        float:left;
    }
    @media only screen and (max-width : 800px) {
        [article]>article{
            width: 100%;
        }
    }
</style>