<?php
    function addZero($x, $totalPage)
    {
        $s = '';
        if($totalPage<10)
        {
            $s = (string)$x;
        }
        elseif($totalPage<100)
        {
            $s = (string)($x+100);
            $s = substr($s,1,2);
        }
        elseif($totalPage<1000)
        {
            $s = (string)($x+1000);
            $s = substr($s,1,3);
        }
        elseif($totalPage<10000)
        {
            $s = (string)($x+10000);
            $s = substr($s,1,4);
        }
        elseif($totalPage<100000)
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