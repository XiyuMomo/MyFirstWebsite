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

            table{
                width: 60%;
                margin: 0 auto;

                border: 2px solid orangered;
                border-radius: 5px;
            }
            .TD1
            {
                width: 200px;
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
            }

            .submit
            {
                width: 80px;
                height: 40px;
                margin: 10px auto;
            }
        </style>
    </head>
    <body>
        <div>
            <a href="/index.html">BACK TO MAINPAGE</a>
        </div>
        <hr width="90%" color="orangered"/>
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
    </body>
</html>