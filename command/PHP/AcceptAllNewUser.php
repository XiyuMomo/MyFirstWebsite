<?php
    require("lib/MYSQL_CONN_userAdmin.php");

    mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
    $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM temp_new;");
    while($user = mysqli_fetch_array($sql, MYSQLI_ASSOC))
    {
        $sql2 = mysqli_query($MYSQL_CONN_userAdmin, "SELECT name FROM user WHERE id=".$user['inviterID'].";");
        $result = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
        $inviter = $result['name'];

        $insert = "INSERT INTO user ".
                  "(name, passwd, inviter, registerTime, email) ".
                  "VALUES ".
                  "('".$user['name']."', '".$user['passwd']."', '".$inviter."', '".$user['registerTime']."', '".$user['email']."');";

        mysqli_query($MYSQL_CONN_userAdmin, $insert);

        $delete = "DELETE FROM temp_new WHERE name='".$user['name']."' AND passwd='".$user['passwd']."' AND registerTime='".$user['registerTime']."';";

        mysqli_query($MYSQL_CONN_userAdmin, $delete);
    }