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
                require ("/COMMAND/PHP/lib/GetAgeClass.php");
                require ("/COMMAND/PHP/lib/MYSQL_CONN_MangaViewer.php");
                mysqli_select_db($MYSQL_CONN_MangaViewer, 'Info');

                $q1 = mysqli_query($MYSQL_CONN_MangaViewer, "SELECT COUNT(*) FROM Images_Manga;");
                $r1 = mysqli_fetch_array($q1, MYSQLI_NUM);
                $serial = $r1[0];

                $sql = mysqli_query($MYSQL_CONN_MangaViewer, "SELECT Age,Title,Code,Page FROM Images_Manga;");

                for($i=1;$i<=$serial;$i++)
                {
                    $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                    echo '<table class="workList">';
                    echo "<tr>";
                    echo '<td class="'.getAgeClass($row['Age']).'">'.$row['Age'].'</td>';
                    echo '<td class="workTitle"><a href="'.$row['Code'].'/index.php">'.$row['Title'].'</a></td>';
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