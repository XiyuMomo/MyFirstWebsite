<?php
    session_start();
    require ("/command/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MainPage | TESTING</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <style>

        </style>
    </head>
    <body>
        <?php
            include("/var/www/secret/header.php");
        ?>

        <h2 id="title">
            <?php
                if($ISLOGGED)
                {
                    echo "欢迎回来，".$_SESSION['name']."!";
                }
                else
                {
                    echo "您的IP：".$_SERVER['REMOTE_ADDR'];
                }
            ?>
        </h2>

        <div class="navigationContain">
            <hr />
            <a class="navigation" href="TextSites/index.php">Texts</a>
            <hr />
            <a class="navigation" href="ImageSites/index.php">Images</a>
            <hr />
            <a class="navigation">Sounds</a>
            <hr />
            <a class="navigation">Videos</a>
            <hr />
            <a class="navigation">Games</a>
        </div>

        <?php
            include("/var/www/secret/footer.php");
        ?>

        <script>
            var colorBool = true
            function changeColor()
            {
                if(colorBool)
                {
                    document.getElementById("title").style.color = "orange";
                    colorBool = false;
                }
                else
                {
                    document.getElementById("title").style.color = "orangered";
                    colorBool = true;
                }
            }
            setInterval("changeColor()",250);
        </script>
    </body>
</html>