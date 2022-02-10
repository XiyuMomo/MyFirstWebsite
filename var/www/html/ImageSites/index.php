<?php
    session_start();
    require ("/command/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Images | TESTING</title>
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

        <h1>Images</h1>

        <div class="navigationContain">
            <hr />
            <a class="navigation" href="Manga/index.php">Manga</a>
            <hr />
            <a class="navigation">ImageSet ( Virtual )</a>
            <hr />
            <a class="navigation">ImageSet ( Real )</a>
            <hr />
            <a class="navigation">Miscellaneous ( Virtual )</a>
            <hr />
            <a class="navigation">Miscellaneous ( Real )</a>
        </div>

        <?php
        include ("/var/www/secret/footer.php");
        ?>
    </body>
</html>