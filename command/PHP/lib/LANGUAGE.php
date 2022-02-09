<?php
    require("MYSQL_CONN_viewer.php");

    function short2local($language)
    {
        global $LANGUAGE, $MYSQL_CONN_viewer;

        $language = (string)$language;
        mysqli_select_db($MYSQL_CONN_viewer, "web");
        $sql = mysqli_query($MYSQL_CONN_viewer, "SELECT * FROM language WHERE ShortName='".$language."';");
        if(!$sql)
        {
            return "UNKNOWN";
        }
        $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        return $result['Local'];
    }
?>