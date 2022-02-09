<?php
    function DECTO($num, $sys)
    {
        $dict = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $result = "";

        $num = (string)$num;
        $sys = (int)$sys;
        if($sys<2 || $sys>62)
        {
            echo "ERROR!\n";
            return false;
        }
        if($sys==10 || $num=="0")
        {
            return $num;
        }
        while($num>0)
        {
            $result = $dict[bcmod($num,$sys)].$result;
            $num = bcdiv($num,$sys);
        }
        return $result;
    }

    function TODEC($num, $sys)
    {
        $dict = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $result = "0";

        $num = (string)$num;
        $sys = (int)$sys;
        if($sys<2 || $sys>62)
        {
            echo "ERROR!\n";
            return false;
        }
        if($sys==10 || $num=="0")
        {
            return $num;
        }
        $numLength = strlen($num);
        for($i=0;$i<$numLength;$i++)
        {
            $pos = strpos($dict, $num[$i]);
            $result = bcadd($result, bcmul($pos, bcpow($sys, $numLength-$i-1)));
        }
        return $result;
    }

    function NUMSYSTRANS($num, $sys1, $sys2)
    {
        return DECTO(TODEC($num, $sys1), $sys2);
    }
?>