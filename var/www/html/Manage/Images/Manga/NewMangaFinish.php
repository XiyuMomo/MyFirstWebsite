<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Verify</title>
        <style>
            body
            {
                font-size: 30px;
                font-family: fantasy;
                background-color: #222222;
                color: #ffffff;
                margin: 20px auto;
                text-align: center;
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

            h1
            {
                color: orangered;
                text-align: center;
                font-size: 50px;
            }

        </style>
    </head>
    <body>
        <a href="/index.html">BACK TO MAINPAGE</a>
        <hr width="90%" color="orangered"/>

        <?php
            require("/command/PHP/lib/UpdateManga.php");

            $temp = file("temp");
            $totalpage = (int)$temp[6];
            for($i=0;$i<7;$i++)
            {
                $temp[$i] = trim($temp[$i]);
            }
            
            
            mysqli_select_db($conn, 'Info');

            $insert = 'INSERT INTO Images_Manga'.
                      '(Serial,Code,Title,Age,Artist,Language,Page)'.
                      'VALUES'.
                      "('$temp[0]','$temp[1]','$temp[2]','$temp[3]','$temp[4]','$temp[5]','$temp[6]');";
            if(!mysqli_query($conn, $insert))
            {
                echo "数据库写入错误！";
                exit;
            }

            @$cover = fopen("/var/www/html/Images/Manga/Temp/cover.jpg",'r');

            $mangaImagePath = "/var/www/html/Images/Manga/$temp[1]";
            DELETEDIR($mangaImagePath);
            mkdir($mangaImagePath);
            chmod($mangaImagePath, 0777);
            for($i=1;$i<=$totalpage;$i++)
            {
                $page = zero($i, $totalpage);
                copy("/var/www/html/Images/Manga/Temp/$page.jpg", $mangaImagePath."/$page.jpg");
            }
            if($cover)
            {
                copy("/var/www/html/Images/Manga/Temp/cover.jpg", $mangaImagePath."/$temp[1]/cover.jpg");
            }

            updateSingleManga($temp[0]);

            echo '<h1>更改已提交</h1>';
        ?>
    </body>
</html>