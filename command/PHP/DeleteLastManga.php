<?php
    require("lib/DELETEDIR.php");
    require("lib/GetMangaConf.php");
    getMangaConf();

    $dbhost = 'localhost';
    $dbuser = 'MangaUploader';
    $dbpass = '1145141919810';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if(!$conn)
    {
        echo "Failed to connect database, please check and try later.\n";
        exit;
    }
    else
    {
        echo "Sucessed to connect database!\n";
        echo "Ready to delete last manga.\n";
    }

    mysqli_query($conn, "set names utf8");  //设置数据库字符格式为utf-8

    mysqli_select_db($conn, "Info");
    $sql = mysqli_query($conn, "SELECT MAX(Serial) FROM Images_Manga;");
    $serial = mysqli_fetch_array($sql, MYSQLI_NUM);
    $sql = mysqli_query($conn, "SELECT * FROM Images_Manga WHERE Serial='".$serial[0]."';");
    $info = mysqli_fetch_array($sql, MYSQLI_ASSOC);

    echo "Please check the information of the manga will be delete:\n";
    print_r($info);

    echo "Are you sure to delete the manga?(Y/N)\n";
    $verify = fgets(STDIN);
    $verify = trim($verify);
    if($verify!='Y' && $verify!='y')
    {
        echo "Delete canceled\n";
        exit;
    }

    DELETEDIR(constant("site").constant("mangaSite")."/".$info['Code']);
    DELETEDIR(constant("site").constant("mangaImage")."/".$info['Code']);

    mysqli_query($conn, "DELETE FROM Images_Manga WHERE Serial='".$serial[0]."';");
    mysqli_select_db($conn, "Manga");
    mysqli_query($conn, "DROP TABLE m{$info['Code']};");

    echo "Delete finish!!\n";
?>