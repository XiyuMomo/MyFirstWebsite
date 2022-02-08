<?php
    require("lib/LANGUAGE.php");

    echo "Welcome!\n";
    echo "Here is a tool to translate short name to language's local name, please input the short name:\n";
    $language = fgets(STDIN);
    $language = trim($language);
    echo short2local($language)."\n";
?>