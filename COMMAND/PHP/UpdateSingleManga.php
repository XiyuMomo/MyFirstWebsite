<?php
    require("/COMMAND/PHP/lib/UpdateManga.php");

    echo "Please input manga's code:\n";
    $code = fgets(STDIN);
    $serial = (int)$code;

    updateSingleManga($serial);
?>