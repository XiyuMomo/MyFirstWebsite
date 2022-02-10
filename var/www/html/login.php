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
        .login
        {
            width: 40%;
            min-width: 480px;
            margin: 0 auto;
            border: 3px solid orangered;
            border-radius: 5px;
            background-color: #444444;
        }
        .inputTable
        {
            width: 90%;
            height: 90%;
            margin: 20px auto;

            font-size: 30px;
            font-family: CangErYuMo3;
        }
        .inputTD
        {
            vertical-align: middle;
        }
        .inputText
        {
            width: 90%;
            height: 30px;
        }
        .submit
        {
            margin: 40px auto;
            width: 160px;
            height: 60px;
            font-size: 30px;
            font-family: CangErYuMo3;
        }
    </style>
</head>
<body>
    <?php
        include("/var/www/secret/header.php");
    ?>

    <div style="text-align: center">
        <a class="backNormal" href="/index.html">BACK TO MAINPAGE</a>
    </div>
    <hr style="width: 90%;"/>
    <h1>LOGIN</h1>

    <form action="login.php" method="POST">
        <div class="login">
            <table class="inputTable">
                <tr>
                    <td>Username:</td>
                    <td class="inputTD"><input type="text" class="inputText" name="user"/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td class="inputTD"><input type="password" class="inputText" name="passwd"/></td>
                </tr>
            </table>
        </div>
        <div style="text-align: center;">
            <input type="submit" class="submit" value="LOG IN" />
        </div>
    </form>

    <div style="text-align: center;">
        <?php
            if(@$_POST['user']!=NULL)
            {
                $user = $_POST['user'];
                $passwd = $_POST['passwd'];

                LOGGIN($user, $passwd);

                if(ISLOGGED())
                {
                    header("location:index.php");
                }
            }
        ?>
    </div>
</body>
</html>
