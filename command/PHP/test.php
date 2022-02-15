<?php
    $MYSQL_CONN_MangaViewer = mysqli_connect('localhost', 'MangaViewer', '114514');
    define("MYSQL_CONN_MangaViewer", $MYSQL_CONN_MangaViewer);
    print_r($MYSQL_CONN_MangaViewer);
    exit;
    mysqli_query(constant("MYSQL_CONN_MangaViewer"), "set names utf8");
    mysqli_select_db(constant("MYSQL_CONN_MangaViewer"), "Info");

    $select = "SELECT * FROM Images_Manga;";
    $query = mysqli_query(constant("MYSQL_CONN_MangaViewer"), $select);

    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
    {
        foreach ($row as $value)
        {
            echo $value."  ";
        }
        echo "\n";
    }
