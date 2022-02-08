<?php
    require("lib/RANDSTRING.php");
    for($i=0;$i<10;$i++)
    {
        echo RANDSTRING_TIMEMD5()."\n";
    }
?>