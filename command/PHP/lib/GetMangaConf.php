<?php
    function getMangaConf()
    {
        $conf = file("/command/conf/manga.conf");
        $conf_rows = count($conf);
        for($i=0;$i<$conf_rows;$i++)
        {
            $conf[$i] = trim($conf[$i]);
            $rowData = explode("=",$conf[$i]);
            $dataCount = count($rowData);
            for($j=0;$j<$dataCount;$j++)
            {
                $rowData[$j] = trim($rowData[$j]);
            }

            if($rowData[0]=="site")
            {
                define("site",$rowData[1]);
            }
            if($rowData[0]=="mangaSite")
            {
                define("mangaSite",$rowData[1]);
            }
            if($rowData[0]=="mangaImage")
            {
                define("mangaImage",$rowData[1]);
            }
            if($rowData[0]=="templateIndex")
            {
                define("templateIndex",$rowData[1]);
            }
            if($rowData[0]=="templateView")
            {
                define("templateView",$rowData[1]);
            }
            if($rowData[0]=="templateViewWF")
            {
                define("templateViewWF",$rowData[1]);
            }
        }
    }
?>