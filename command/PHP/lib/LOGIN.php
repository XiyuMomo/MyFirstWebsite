<?php
    require ("MYSQL_CONN_userAdmin.php");   //MySql连接
    require ("ENCRYPTION.php");             //加密函数库
    require ("COOKIE.php");                 //COOKIE操作函数库
    require ("RANDSTRING.php");             //随机字符串函数库

    //检测用户是否登录
    //已登录：true
    //未登录：false
    function ISLOGGED(): bool
    {
        global $MYSQL_CONN_userAdmin;
        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");

        //检测到SESSION则直接通过
        if(@$_SESSION['logged'])
        {
            return true;
        }

        //检测COOKIE
        if(@$_COOKIE['id'])
        {
            $userID = (int)$_COOKIE['id'];  //从COOKIE获得用户ID
            //从COOKIE获得key，与用户id，ip地址共同得到certificate用于身份验证
            @$getCertificate = SHA35123($userID.$_SERVER['REMOTE_ADDR'].$_COOKIE['key']);
            //从数据库查询用户是否登录
            $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM logged WHERE id='$userID';");
            $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $storageCertificate = $result['certificate'];   //获得数据库中存储的certificate

            if($getCertificate == $storageCertificate)      //比对COOKIE得到的certificate与数据库中的是否一致
            {
                getUserInfoByID($userID);
                return true;
            }
        }

        //验证均未通过则返回假
        return false;
    }

    function LOGIN($user, $passwd)
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
        getUserInfoByName($user);

        if($_POST['keep'])
        {
            //操作COOKIE
            COOKIE_NEW('id', $_SESSION['id'], $_POST['keep'], DURATION_DAY);
            $key = RANDSTRING_TIMEMD5();    //随机字符串作为key
            if(isset($_COOKIE['key']))
            {
                COOKIE_DELETE('key');
            }
            COOKIE_NEW('key', $key, $_POST['keep'], DURATION_DAY);
            //存储凭证
            if(mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM logged WHERE id='".$_SESSION['id']."';"))
            {
                $delete = "DELETE FROM logged WHERE id='".$_SESSION['id']."';";
                mysqli_query($MYSQL_CONN_userAdmin, $delete);
            }
            $certificate = SHA35123($_SESSION['id'].$_SERVER['REMOTE_ADDR'].$key);
            $insert = "INSERT INTO logged (id, certificate, logTime) VALUES ".
                      "('".$_SESSION['id']."','".$certificate."','".date("YmdHis")."');";
            if(!mysqli_query($MYSQL_CONN_userAdmin, $insert))
            {
                echo "数据库写入错误！";
                exit;
            }
        }

        echo "<p>登录成功！</p>";
    }

    function LOGOUT()
    {
        global $MYSQL_CONN_userAdmin;

        session_start();
        $userID = (int)$_SESSION['id'];     //获得当前登录用户ID
        session_destroy();      //清空SESSION

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        mysqli_query($MYSQL_CONN_userAdmin, "DELETE FROM logged WHERE id='$userID';");      //删除logged中用户登陆记录

        //删除COOKIE
        COOKIE_DELETE('id');
        COOKIE_DELETE('key');

        header("location:index.php");   //返回首页
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
        $_SESSION['logged'] = true;
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
        $_SESSION['logged'] = true;
    }