<?php
    function ZEROPAD($x, $totalpage)
    {
        $s = '';
        if($totalpage<10)
        {
            $s = (string)$x;
        }
        elseif($totalpage<100)
        {
            $s = (string)($x+100);
            $s = substr($s,1,2);
        }
        elseif($totalpage<1000)
        {
            $s = (string)($x+1000);
            $s = substr($s,1,3);
        }
        elseif($totalpage<10000)
        {
            $s = (string)($x+10000);
            $s = substr($s,1,4);
        }
        elseif($totalpage<100000)
        {
            $s = (string)($x+100000);
            $s = substr($s,1,5);
        }
        else
        {
            $s = (string)($x+1000000);
            $s = substr($s,1,6);
        }
        return $s;
    }

?>