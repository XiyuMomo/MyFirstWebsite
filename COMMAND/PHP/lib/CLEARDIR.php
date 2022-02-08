<?php
    require("DELETEDIR.php");
    function CLEARDIR($path)
    {
        $p = scandir($path);
        foreach($p as $val)
        {
            if($val!="." && $val!="..")
            {
                if(is_dir($path."/".$val))
                {
                    DELETEDIR($path."/".$val);
                }
                else
                {
                    unlink($path."/".$val);
                }
            }
        }
    }
?>