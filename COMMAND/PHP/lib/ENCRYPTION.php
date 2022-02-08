<?php
    function SHA35123($input): string
    {
        $output = hash("sha3-512", $input);
        $output = strtoupper($output);
        $output = hash("sha3-512", $output);
        $output = strtoupper($output);
        $output = hash("sha3-512", $output);
        $output = strtoupper($output);

        return $output;
    }