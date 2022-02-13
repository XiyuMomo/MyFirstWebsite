<?php
    require("/command/PHP/lib/UpdateManga.php");

    echo "Please input manga's serial number:\n";
    $code = fgets(STDIN);
    $serial = (int)$code;

    updateSingleManga($serial);
?>