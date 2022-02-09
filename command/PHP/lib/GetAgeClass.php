<?php
    function getAgeClass($age): string
    {
        if($age=='ALL')
        {
            return "age_all";
        }
        if($age=='R15')
        {
            return "age_r15";
        }
        if($age=='R18')
        {
            return "age_r18";
        }
        if($age=='R18G')
        {
            return "age_r18g";
        }
        return "ERROR";
    }