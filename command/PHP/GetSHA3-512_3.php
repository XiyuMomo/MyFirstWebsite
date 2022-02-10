<?php
    require("lib/ENCRYPTION.php");

    $test = fgets(STDIN);
    $test = trim($test);
    echo "Here is its sha3-512 * 3:\n";
    echo SHA35123($test)."\n";
?>