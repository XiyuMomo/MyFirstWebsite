<?php
    require("/COMMAND/PHP/lib/GetMangaConf.php");
    getMangaConf();
    echo constant("site")."\n";
    echo constant("mangaSite")."\n";
    echo constant("mangaImage")."\n";
    echo constant("templateIndex")."\n";
    echo constant("templateView")."\n";
?>