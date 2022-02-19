<?php
    define('DURATION_SECOND', 1);
    define('DURATION_HOUR', 3600);
    define('DURATION_DAY', 86400);
    define('DURATION_WEEK', 604800);
    define('DURATION_MONTH', 2592000);
    define('DURATION_YEAR', 31536000);

    function COOKIE_NEW($name, $value, $duration, $duration_set): bool
    {
        if(isset($_COOKIE[$name]))
        {
            return true;
        }

        $expire = time() + $duration * $duration_set;
        setcookie($name, $value, $expire);

        return false;
    }

    function COOKIE_DELETE($name): bool
    {
        if(!isset($_COOKIE[$name]))
        {
            return true;
        }

        setcookie($name, '', time()-3600);

        return false;
    }