<?php
    session_start();
    require ("/COMMAND/PHP/lib/LOGIN.php");
    $ISLOGGED = ISLOGGED();
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <title>Create Account | TESTING</title>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <style>
            body
            {
                text-align: center;
            }
            table{
                width: 60%;
                margin: 0 auto;

                border: 2px solid orangered;
                border-radius: 5px;
            }
            .TD1
            {
                width: 240px;
                font-size: 25px;
                font-family: CangErYuMo3;
            }
            .input
            {
                text-align: left;
                vertical-align: middle;
            }
            .inputPass
            {
                height: 25px;
                width: 95%;
            }
            .inputText
            {
                margin: auto;
                width: 95%;
                height: 25px;
            }

            .submit
            {
                width: 240px;
                height: 50px;
                margin: 40px auto;
                font-size: 25px;
                font-family: CangErYuMo4;
            }
        </style>
    </head>
    <body>
        <?php
            include("/var/www/secret/header.php");
        ?>

        <div>
            <a class="backNormal" href="/index.html">BACK TO MAINPAGE</a>
        </div>
        <hr style="width: 90%;"/>

        <h1>Create Account</h1>

        <form action="createAccount.php" method="POST">
            <table>
                <tr>
                    <td class="TD1">User name</td>
                    <td class="input"><input type="text" class="inputText" name="user" size="10" /></td>
                </tr>
                <tr style="background-color: #444444;">
                    <td class="remark1" colspan="2">&nbsp;&nbsp;*用户名介于4-32字符，可含有阿拉伯数字0~9、大小写英文字母以及下划线</td>
                </tr>

                <tr>
                    <td class="TD1">Password</td>
                    <td class="input"><input type="password" class="inputPass" name="passwd0" size="10" /></td>
                </tr>
                <tr style="background-color: #444444;">
                    <td class="remark1" colspan="2">&nbsp;&nbsp;*密码可含有阿拉伯数字0~9、大小写英文字母以及下划线或'@'</td>
                </tr>
                <tr>
                    <td class="TD1">Password again</td>
                    <td class="input"><input type="password" class="inputPass" name="passwd1" size="10" /></td>
                </tr>
                <tr style="background-color: #444444;">
                    <td class="remark1" colspan="2">&nbsp;&nbsp;*两次输入的密码请保持一致</td>
                </tr>

                <tr>
                    <td class="TD1">E-mail</td>
                    <td class="input"><input type="text" class="inputText" name="email" size="10" /></td>
                </tr>
                <tr style="background-color: #444444;">
                    <td class="remark1" colspan="2">&nbsp;&nbsp;*本站通知的接收邮箱，非必填</td>
                </tr>

                <tr>
                    <td class="TD1">Invitation code</td>
                    <td class="input"><input type="text" class="inputText" name="code" size="10" /></td>
                </tr>

            </table>
            <input type="submit" class="submit" value="Create Account" />
        </form>
        <?php
            require ("/COMMAND/PHP/lib/USER.php");

            if(@$_POST['user']!=NULL)
            {
                $user = $_POST['user'];
                $passwd0 = $_POST['passwd0'];
                $passwd1 = $_POST['passwd1'];
                $code = $_POST['code'];
                $email = $_POST['email'];

                RequestAccount($user, $passwd0, $passwd1, $code, $email, $_SERVER['REMOTE_ADDR']);
            }
        ?>
    </body>
</html>