<?php
    session_start();
    require ("/command/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>##Title# | COVER</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <style>
            .center
            {
                text-align: center;
            }
            
            #coverContain
            {
                background-color: #444444;
                
                border-radius: 10px;
                border: 2px solid orangered;

                width: 50%;
                min-width: 480px;
                height: 480px;
                margin: auto;
                text-align: center;
            }
            .cover
            {
                margin: 20px auto;
                max-width: 90%;
                max-height: 90%;
            }
            #information
            {
                width: 50%;
                min-width: 480px;
                margin: 0 auto;

                font-size: 20px;
                font-family: CangErYuMo2;
                color: #ffffff;
                text-align: center;
            }
            a.startLink
            {
                font-size: 50px;
                font-family: CangErYuMo4;
                color: orangered;
                text-decoration: none;
            }
            a.startLink:hover
            {
                color: #ffffff;
            }
        </style>
    </head>
    <body>
        <?php
            include("/var/www/secret/header.php");
        ?>

        <div class="center">
            <a class="backSmall" href="/index.html">BACK TO MAINPAGE</a>
        </div>
        <hr style="width: 90%;"/>
        <div class="center">
            <a class="backSmall" href="/ImageSites/Manga/index.php">BACK TO MANGA</a>
        </div>
        <hr style="width: 90%;"/>

        <h3>##Title#</h3>

        <div id="coverContain">
            <?php
                @$cover = fopen("/var/www/html/Images/Manga/##Code#/cover.jpg",'r');
                if($cover)
                {
                    echo '<img src="/Images/Manga/##Code#/cover.jpg" class="cover"/>';
                }
                else
                {
                    echo '<img src="/Images/Manga/##Code#/##FirstPage#.jpg" class="cover" />';
                } 
            ?>
        </div>

        <div id="information">
            <p>##Artist#</p>
            <hr />
            <p>##Language#</p>
            <hr />
        </div>

        <div style="text-align: center;">
            <a class="startLink" href="##FirstPage#.html">START READING (Traditional Mode)</a>
            <br />
            <a class="startLink" href="waterfall.html">START READING (Waterfall Mode)</a>
        </div>

        <?php
        include ("/var/www/secret/foot.php");
        ?>
    </body>
</html>