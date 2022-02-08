<?php
    require ("MYSQL_CONN_userAdmin.php");

    function SHA35123_USER($pass): string
    {
        $output = hash("sha3-512", $pass);
        $output = strtoupper($output);
        $output = hash("sha3-512", $output);
        $output = strtoupper($output);
        $output = hash("sha3-512", $output);
        $output = strtoupper($output);

        return $output;
    }

    function RequestAccount($user, $passwd0, $passwd1, $code, $email, $registerIP)
    {
        global $MYSQL_CONN_userAdmin;
        $ERROR = RequestAccountERROR($user, $passwd0, $passwd1, $code, $email);
        if($ERROR)
        {
            exit;
        }
        if(userExist($user))
        {
            exit;
        }
        if(!invited($code))
        {
            exit;
        }
        $date = date("YmdHis");
        if(frequent($registerIP, $date))
        {
            exit;
        }

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");

        $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM invite WHERE Code='$code';");
        $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $inviterID = $result['InviterID'];
        mysqli_query($MYSQL_CONN_userAdmin, "DELETE FROM invite WHERE Code='$code';");

        $passwd = SHA35123_USER($passwd0);
        ini_set('date.timezone', 'GMT');


        $insert = "INSERT INTO temp_new ".
                  "(name, passwd, inviterID, registerTime, email, registerIP) ".
                  "VALUES ".
                  "('$user', '$passwd', '$inviterID', '$date', '$email', '$registerIP');";
        mysqli_query($MYSQL_CONN_userAdmin, $insert);

        echo "<p>申请已发送，请等待通知！</p>";
    }

    function RequestAccountERROR($user, $passwd0, $passwd1, $code, $email): int
    {
        $ERROR = 0;

    //判断用户名是否合法
        if(strlen($user)<4)
        {
            echo "<p class='warning1'>用户名过短！请勿少于4个字符！</p>";
            $ERROR += 1;
        }
        if(strlen($user)>32)
        {
            echo "<p class='warning1'>用户名过长！请勿超过32个字符！</p>";
            $ERROR += 2;
        }
        if(!preg_match('/^[a-zA-Z0-9_]+$/', $user))
        {
            echo "<p class='warning1'>用户名含有非法字符！</p>";
            $ERROR += 4;
        }

    //判断密码是否合法
        if($passwd0!=$passwd1)
        {
            echo "<p class='warning1'>两次密码输入不匹配！</p>";
            $ERROR += 8;
        }
        if(!preg_match('/^[a-zA-Z0-9_@]+$/', $passwd0))
        {
            echo "<p class='warning1'>密码含有非法字符！</p>";
            $ERROR += 16;
        }
        if($passwd0=='')
        {
            echo "<p class='warning1'>密码不能为空！</p>";
            $ERROR += 32;
        }
    //判断邮箱是否合法
        if($email!=NULL)
        {
            if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email))
            {
                echo "<p class='warning1'>非法邮箱地址！</p>";
                $ERROR += 64;
            }
        }

    //判断邀请码是否合法
        if(!preg_match('/^[A-F0-9]{32}$/', $code))
        {
            echo "<p class='warning1'>非法邀请码！</p>";
            $ERROR += 128;
        }
        return $ERROR;
    }

//判断用户是否存在
    function userExist($user): bool
    {
        global $MYSQL_CONN_userAdmin;

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        $userExist = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM user WHERE name='$user';");
        if(mysqli_num_rows($userExist))
        {
            echo "<p class='warning1'>用户名已存在！</p>";
            return true;
        }
        return false;
    }

//判断邀请码是否有效
    function invited($code): bool
    {
        global $MYSQL_CONN_userAdmin;

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        $invited = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM invite WHERE Code='$code';");
        if(!mysqli_num_rows($invited))
        {
            echo "<p class='warning1'>邀请码无效！</p>";
            return false;
        }
        return true;
    }

//判断请求是否过于频繁
    function frequent($registerIP, $thisTime): bool
    {
        global $MYSQL_CONN_userAdmin;

        mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
        $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM temp_new WHERE registerIP='$registerIP' ORDER BY registerTime DESC;");
        if(!mysqli_num_rows($sql))
        {
            return false;
        }
        $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $lastTime = $result['registerTime'];
        $delay = strtotime($thisTime) - strtotime($lastTime);
        if($delay>300)
        {
            return false;
        }
        echo "<p class='warning1'>请求过于频繁！请稍后再试！</p>";
        return true;
    }