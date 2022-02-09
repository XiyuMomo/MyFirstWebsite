<?php
    session_start();
    require ("/command/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Texts | TESTING</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <style>
        </style>
    </head>
    <body>
        <?php
            include("/var/www/secret/header.php");
        ?>

        <div class="backContain">
            <a class="backNormal" href="/index.html">BACK TO MAINPAGE</a>
            <hr />
        </div>
        <h1>Texts</h1>

        <div class="navigationContain">
            <hr />
            <a class="navigation" href="Novel/index.php">Novel</a>
            <hr />
            <a class="navigation">Reserve</a>
            <hr />
        </div>
    </body>
</html>