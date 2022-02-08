<?php
    session_start();
    require ("/COMMAND/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Manga | TESTING</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <link rel="stylesheet" type="text/css" href="/css/manga.css">
        <style>
            body
            {
                background-color: #222222;
                color: #ffffff;
            }

            a{
                text-decoration: none;
            }
            a:link
            {
                color: #ffffff;
            }
            a:visited
            {
                color: #ffffff;
            }
            a:hover
            {
                color: #888888;
            }

            .center
            {
                text-align: center;
            }

            .workList
            {
                margin: 0 auto;
                width: 90%;
                border: 0;
                font-family: "CangErYuMo2";
                color: #dddddd;
            }
            .workTitle
            {
                border-left: 2px solid orangered;
                font-size: 25px;
                text-align: left;
                border-right: 2px solid orangered;
            }
            .workPageNum
            {
                text-align: center;
                vertical-align: middle;
                width: 70px;
                font-size: 18px;
                font-family: "CangErYuMo3";
            }

            .ALL
            {
                text-align: center;
                vertical-align: middle;
                width: 70px;
                font-size: 16px;
                font-family: "CangErYuMo3";
                color: #66ff66;
            }
            .R18
            {
                text-align: center;
                vertical-align: middle;
                width: 70px;
                font-size: 16px;
                font-family: "CangErYuMo3";
                color: #ff99cc;
            }
            .R18G
            {
                text-align: center;
                vertical-align: middle;
                width: 70px;
                font-size: 16px;
                font-family: "CangErYuMo3";
                color: #cc0000;
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
            <a class="backSmall" href="/ImageSites/index.php">BACK TO IMAGES</a>
        </div>
        <hr style="width: 90%;"/>

        <h1>Manga</h1>

        <div class="listContain">
            <br/>
            <hr style="width: 90%;"/>
            <?php
                $dbhost = 'localhost';
                $dbuser = 'MangaViewer';
                $dbpass = '114514';
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
                mysqli_query($conn, "set names utf8");
                mysqli_select_db($conn, 'Info');

                $q1 = mysqli_query($conn, "SELECT COUNT(*) FROM Images_Manga;");
                $r1 = mysqli_fetch_array($q1, MYSQLI_NUM);
                $serial = $r1[0];

                $code = 1000000 + $serial;
                $code = (string)$code;
                $code = substr($code,1,6);

                $sql = mysqli_query($conn, "SELECT Age,Title,Code,Page FROM Images_Manga;");

                for($i=1;$i<=$serial;$i++)
                {
                    $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                    echo '<table class="workList">';
                    echo "<tr>";
                    echo '<td class="'.$row['Age'].'">'.$row['Age'].'</td>';
                    echo '<td class="workTitle"><a href="'.$row['Code'].'/index.html">'.$row['Title'].'</a></td>';
                    echo '<td class="workPageNum">'.$row['Page'].' 页</td>';
                    echo "</tr>";
                    echo "</table>";
                    echo '<hr style="width: 90%;"/>';
                }
            ?>
            <br/>
        </div>
    </body>
</html>