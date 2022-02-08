<?php
    require ("MYSQL_CONN_userAdmin.php");
    require ("ENCRYPTION.php");

    function ISLOGGED(): bool
    {
        global $MYSQL_CONN_userAdmin;

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        if(@$_SESSION['logged'])
        {
            return true;
        }
        if(@$_COOKIE['id'])
        {
            $userID = (int)$_COOKIE['id'];
            $getCertificate = SHA35123($userID.$_SERVER['REMOTE_ADDR'].$_SERVER['REMOTE_HOST'].$_COOKIE['key']);

            $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM logged WHERE id='$userID';");
            $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $storageCertificate = $result['certificate'];

            if($getCertificate == $storageCertificate)
            {
                getUserInfoByID($userID);
                return true;
            }
        }
        return false;
    }

    function LOGGIN($user, $passwd)
    {
        global $MYSQL_CONN_userAdmin;

        if(!preg_match('/^[a-zA-Z0-9_]+$/', $user) || !preg_match('/^[a-zA-Z0-9_@]+$/', $passwd))
        {
            echo "<p>输入含非法字符！</p>";
            exit;
        }

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM user WHERE name='$user';");
        if(!mysqli_num_rows($sql))
        {
            echo "<p>用户名不存在！</p>";
            exit;
        }
        $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $storagePass = $result['passwd'];
        if(SHA35123($passwd)!=$storagePass)
        {
            echo "<p>密码错误！</p>";
            exit;
        }

        @session_start();
        $_SESSION['logged'] = true;

        getUserInfoByName($user);
        echo "<p>登录成功！</p>";
    }

    function LOGGOUT($userID)
    {
        global $MYSQL_CONN_userAdmin;
        $userID = (int)$userID;
        session_destroy();

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        mysqli_query($MYSQL_CONN_userAdmin, "DELETE FROM logged WHERE id='$userID';");
    }

    function getUserInfoByID($userID)
    {
        global $MYSQL_CONN_userAdmin;
        $userID = (int)$userID;
        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");

        $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM user WHERE id='$userID';");
        $info = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        $_SESSION['id'] = $info['id'];
        $_SESSION['name'] = $info['name'];
        $_SESSION['group'] = $info['usergroup'];
    }

    function getUserInfoByName($name)
    {
        global $MYSQL_CONN_userAdmin;
        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");

        $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM user WHERE name='$name';");
        $info = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        $_SESSION['id'] = $info['id'];
        $_SESSION['name'] = $info['name'];
        $_SESSION['group'] = $info['usergroup'];
    }