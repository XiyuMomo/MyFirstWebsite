<?php
    $MYSQL_CONN_viewer = mysqli_connect('localhost','viewer','');
    mysqli_query($MYSQL_CONN_viewer, "set names utf8");