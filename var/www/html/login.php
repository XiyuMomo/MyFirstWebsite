<?php
    ob_start();
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

    <div style="text-align: center">
        <a class="backNormal" href="/index.php">BACK TO MAINPAGE</a>
    </div>
    <hr style="width: 90%;"/>
    <h1>LOGIN</h1>

    <form action="login.php" method="POST">
        <div class="loginInputBox">
            <div class="loginInputArea">
                <div class="loginInputGroup">
                    <div class="loginInputHeader">
                        <span>Username:</span>
                    </div>
                    <div class="loginInputForm">
                        <input type="text" class="loginInputText" name="user"/>
                    </div>
                </div>
                <div class="loginInputGroup">
                    <div class="loginInputHeader">
                        <span>Password:</span>
                    </div>
                    <div class="loginInputForm">
                        <input type="password" class="loginInputPass" name="passwd"/>
                    </div>
                </div>
                <div class="loginInputGroup">
                    <div class="loginInputHeader">
                        <span>Keep login:</span>
                    </div>
                    <div class="loginInputForm">
                        <select class="loginInputSelect" name="keep">
                            <option value="0">NO</option>
                            <option value="7">A WEEK</option>
                            <option value="30">A MONTH</option>
                            <option value="365">A YEAR</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 100%;text-align: center">
            <input type="submit" class="loginButton" value="LOG IN" />
        </div>
    </form>

    <div style="text-align: center;">
        <?php
            if(@$_POST['user']!=NULL)
            {
                $user = $_POST['user'];
                $passwd = $_POST['passwd'];

                LOGIN($user, $passwd);

                if(ISLOGGED())
                {
                    echo '<script>window.location.href = "index.php";</script>';
                }
            }
        ?>
    </div>
</body>
</html>
