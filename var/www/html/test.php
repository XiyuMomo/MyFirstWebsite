<?php
    echo 'Input:';
    $input = fgets(STDIN);
    $fp = fopen("/var/www/html/TEST/test2.html",'w');
    $string = "<!DOCTYPE>\n<html>\n<head>\n".
              "<meta charset='utf-8' />\n<title>".$input."</title>\n</head>\n".
              "<body>\n<h1>".$input."</h1>\n</body>\n</html>\n";
    fwrite($fp,$string);
    echo "Finish!";
?>