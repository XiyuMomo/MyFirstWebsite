<?php
    function RANDSTRING_TIMEMD5(): string
    {
        ini_set('date.timezone', 'GMT');
        $string1 = date("YmdHis");
        $string2 = (string)rand(0,99999999);
        return md5($string1.$string2);
    }