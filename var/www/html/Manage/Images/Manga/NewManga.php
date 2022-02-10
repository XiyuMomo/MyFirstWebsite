<?php
    session_start();
    require ("/command/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>NewManga</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <style>

            table{
                width: 60%;
                margin: 0 auto;

                border: 2px solid orangered;
                border-radius: 5px;
            }
            .TD1
            {
                width: 200px;
                text-align: center;
                font-size: 30px;
                font-family: CangErYuMo3;
                line-height: 45px;
            }
            .input
            {
                text-align: left;
                vertical-align: middle;
            }
            .inputText
            {
                margin: auto;
                width: 95%;
                height: 25px;
            }
            .inputSelect
            {
                height: 25px;
                font-family: CangErYuMo3;
                font-size: 15px;
            }

            .submitContain
            {
                margin: 30px auto;
                text-align: center;
            }
            .submit
            {
                width: 80px;
                height: 40px;
                border: 2px solid orangered;
                border-radius: 10px;
                background-color: #222222;

                color: #ffffff;
                font-family: CangErYuMo4;
                font-size: 25px;

                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <?php
            include("/var/www/secret/header.php");
        ?>
        <div class="backContain">
            <a class="backSmall" href="/index.php">BACK TO MAINPAGE</a>
            <hr />
        </div>

        <h1>New Manga</h1>

        <?php
            if(!$ISLOGGED)
            {
                //用户未登录
                readfile("/var/www/secret/Manage/Images/Manga/NewManga/NewManga_nolog.php");
            }
            elseif (@$_SESSION['group']!="Administrators" && @$_SESSION['group']!="Uploaders")
            {
                //用户无权限
                readfile("/var/www/secret/Manage/Images/Manga/NewManga/NewManga_noper.php");
            }
            else
            {
                readfile("/var/www/secret/Manage/Images/Manga/NewManga/NewManga_ok.php");
            }
        ?>

        <?php
            include("/var/www/secret/footer.php");
        ?>
    </body>
</html>