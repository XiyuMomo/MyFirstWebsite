<?php
    session_start();
    require ("/command/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Verify</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <style>
            body
            {
                text-align: center;
            }

            .output
            {
                margin: 0 auto;
                width: 70%;
                border: 2px solid orangered;
                border-radius: 5px;
                font-family: 'Courier New', Courier, monospace;
                font-size: 15px;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <?php
            include("/var/www/secret/header.php");
        ?>

        <div class="backContain">
            <a class="backSmall" href="/index.html">BACK TO MAINPAGE</a>
            <hr />
            <a class="backSmall" href="NewManga.php">BACK TO PREVIOUS</a>
            <hr />
        </div>

        <h2>Verify the information</h2>

        <div class="output">
            <?php
                require ("/command/PHP/lib/MYSQL_CONN_viewer.php");
                require ("/command/PHP/lib/NUMSYS.php");

                if(!$MYSQL_CONN_viewer)
                {
                    echo "数据库连接失败，请检查故障！";
                    exit;
                }
                echo "<p>数据库连接成功！</p>";

                mysqli_select_db($MYSQL_CONN_viewer, 'Info');
                $q1 = mysqli_query($MYSQL_CONN_viewer, "SELECT MAX(Serial) FROM Images_Manga;");
                $r1 = mysqli_fetch_array($q1, MYSQLI_NUM);
                $serial = $r1[0] + 1;
                echo "<p>将分配以该序号：".$serial."</p>";

                $code = DECTO($serial,62);
                echo "<p>文件编号：".$code."</p>";
            ?>

            <?php
                $title = $_POST['title'];
                echo "<p>将赋予该标题：".$title."</p>";

                $age = $_POST['age'];
                echo "<p>年龄等级：".$age."</p>";

                $artist = $_POST['artist'];
                if($artist=='')
                {
                    $artist = "UNKONWN";
                }
                echo "<p>作者：".$artist."</p>";

                require("/command/PHP/lib/LANGUAGE.php");
                $language = $_POST['language'];
                echo "<p>语言：".short2local($language)."</p>";

                $url = "/var/www/html/Images/Manga/Temp/*";
                $fa = glob($url);
                $amount = sizeof($fa);
                @$cover = fopen("/var/www/html/Images/Manga/Temp/cover.jpg",'r');
                if($cover)
                {
                    echo "<p>封面：有</p>";
                    $amount--;
                }
                else
                {
                    echo "<p>封面：无</p>";
                }
                echo "<p>总页数：".$amount."</p>";

                $fp = fopen("temp",'w');
                flock($fp, LOCK_EX);
                fwrite($fp, $serial."\n");
                fwrite($fp, $code."\n");
                fwrite($fp, $title."\n");
                fwrite($fp, $age."\n");
                fwrite($fp, $artist."\n");
                fwrite($fp, $language."\n");
                fwrite($fp, $amount."\n");
                flock($fp, LOCK_UN);
            ?>
        </div>
        <div style="margin: 20px auto;">
            <a href="NewMangaFinish.php">生效</a>
        </div>

        <?php
            include("/var/www/secret/footer.php");
        ?>
    </body>
</html>