<?php
    require ("lib/MYSQL_CONN_userAdmin.php");
    require ("lib/RANDSTRING.php");

    $amount = 0;
    echo "How many invitation code do you want to create?\n";
    $amount = (int)trim(fgets(STDIN));

    mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
    $username = "root";
    $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM user WHERE name='root';");
    $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $passwd = $result['passwd'];
    for($i=0;$i<$amount;$i++)
    {
        ini_set('date.timezone', 'GMT');
        $time = date("YmdHis");
        $string = $username.$passwd.RANDSTRING_TIMEMD5();
        $code = strtoupper(md5($string));

        $insert = "INSERT INTO invite ".
                  "(Code, InviterID, CreateTime) ".
                  "VALUES ".
                  "('$code', '1', '$time');";
        mysqli_query($MYSQL_CONN_userAdmin, $insert);
    }