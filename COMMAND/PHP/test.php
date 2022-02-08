<?php
    require ("lib/MYSQL_CONN_userAdmin.php");

    mysqli_select_db($MYSQL_CONN_userAdmin, "web_user");
    $sql = mysqli_query($MYSQL_CONN_userAdmin, "SELECT * FROM temp_new;");
    $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);

    $time = $result['registerTime'];
    echo $time."\n";
    echo strtotime($time)."\n";

    $time = "20220206000000";
    echo $time."\n";
    echo strtotime($time)."\n";