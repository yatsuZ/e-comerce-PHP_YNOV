<?php

include 'scripts/bddConnect.php';
include 'scripts/route.php';
include 'scripts/admin.php';


if(!str_starts_with($page, 'subpage_')){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styles/home.css">
    <link rel="stylesheet" href="/styles/range-slider.css">
    <link rel="stylesheet" href="/styles/scrollbar.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/scripts/jquery.js"></script>
    <title>DELYATIA</title>
</head>
<body>   
<?php include "interface/comps/nav.php"; ?>
<?php include "interface/pages/$page.php"; ?>
</body>
</html>
<?php }else{
   include "interface/pages/$page.php"; 
} ?>
<?php // } ?>
