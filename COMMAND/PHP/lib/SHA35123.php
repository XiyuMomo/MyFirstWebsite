<?php
    function SHA35123($pass): string
    {
        $output = hash("sha3-512", $pass);
        $output = strtoupper($output);
        $output = hash("sha3-512", $output);
        $output = strtoupper($output);
        $output = hash("sha3-512", $output);
        $output = strtoupper($output);

        return $output;
    }