<?php
    session_start();
    if(@$_SESSION['id']!=NULL)
    {

    }
    session_destroy();
    $_COOKIE['id'] = NULL;
    $_COOKIE['key'] = NULL;

    header("location:index.php");