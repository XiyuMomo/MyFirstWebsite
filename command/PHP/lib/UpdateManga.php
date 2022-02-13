<?php
    require("GetMangaConf.php");
    require("DELETEDIR.php");
    require("LANGUAGE.php");
    require("MATH.php");
    getMangaConf();

    $dbhost = 'localhost';
    $dbuser = 'MangaUploader';
    $dbpass = '1145141919810';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_query($conn, "set names utf8");  //设置数据库字符格式为utf-8

//=====更新所有漫画函数========================
    function updateAllManga()
    {
        global $conn;

        mysqli_select_db($conn, "Info");
        $sql = mysqli_query($conn, "SELECT Serial FROM Images_Manga");
        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC))
        {
            updateSingleManga($row['Serial']);
        }
    }

//=====更新单个漫画函数========================
    function updateSingleManga($serial)
    {
        global $info, $conn;

        mysqli_select_db($conn, 'Info');
        $infoMap = mysqli_query($conn, "SELECT * FROM Images_Manga WHERE Serial='$serial';");
        $info = mysqli_fetch_array($infoMap, MYSQLI_ASSOC);

        $mangaSiteDir = constant("site").constant("mangaSite")."/".$info['Code'];
        DELETEDIR($mangaSiteDir);
        mkdir($mangaSiteDir);
        chmod($mangaSiteDir, 0777);

        updateIndex();   //更新封面
        updateView();    //更新阅读页面
        updateDB();      //更新漫画数据库
    }

//=====更新封面函数============================
    function updateIndex()
    {
        global $info;

        $totalPage = (int)$info['Page'];
        $firstPage = addZero(1, $totalPage);

        $template = file(constant("templateIndex"));
        $rows = count($template);

        $indexPath = constant("site").constant("mangaSite")."/".$info['Code']."/index.php";
        $fp = fopen($indexPath,'w');
        
        for($i=0;$i<$rows;$i++)
        {
            $tempText = $template[$i];
            $tempText = str_replace("##Code#",$info['Code'],$tempText);
            $tempText = str_replace("##Title#",$info['Title'],$tempText);
            $tempText = str_replace("##Artist#",$info['Artist'],$tempText);
            $tempText = str_replace("##Language#",short2local($info['Language']),$tempText);
            $tempText = str_replace("##FirstPage#",$firstPage,$tempText);
            fwrite($fp,$tempText);
        }
    }

//=====更新阅读页面函数=========================
    function updateView()
    {
        global $conn, $info;
        $totalpage = (int)$info['Page'];
        $waterfall = '';
        $selectPage = '';

        mysqli_select_db($conn, 'Manga');

        for($i=1;$i<$totalpage;$i++)
        {
            $page = addZero($i, $totalpage);
            $selectPage = $selectPage."<option value=".$page.">第".$i."页</option>";
        }

        for($i=1;$i<=$totalpage;$i++)
        {
            $page = addZero($i, $totalpage);

            $template = file(constant("templateView"));
            $rows = count($template);

            $viewPath = constant("site").constant("mangaSite")."/".$info['Code']."/$page.html";     //阅读页面将被写入该路径
            $fp = fopen($viewPath,'w');

            $imgSRC = Constant("mangaImage")."/".$info['Code']."/$page.jpg";
            $img = getimagesize(constant("site").$imgSRC);

            for($j=0;$j<$rows;$j++)
            {
                $tempText = $template[$j];

                $tempText = str_replace("##Code#",$info['Code'],$tempText);
                $tempText = str_replace("##Total#",$totalpage,$tempText);
                $tempText = str_replace("##Page#",$page,$tempText);

                $tempText = str_replace("##ImageWidth#",$img[0],$tempText);
                $tempText = str_replace("##ImageHeight#",$img[1],$tempText);

                $tempText = str_replace("##ImageSrc#",$imgSRC,$tempText);

                $tempText = str_replace("##Select#",$selectPage,$tempText);

                fwrite($fp,$tempText);
            }

            $imgSRC_WF = "/Images/Manga/4/".$page.".jpg";
            $waterfall = $waterfall."<img src=".$imgSRC.' loading="lazy" style="width:100%">'."\n";            
        }
        
        $template = file(constant("templateViewWF"));
        $rows = count($template);

        $viewPath = constant("site").constant("mangaSite")."/".$info['Code']."/waterfall.html";     //阅读页面将被写入该路径
        $fp = fopen($viewPath,'w');

        for($j=0;$j<$rows;$j++)
        {
            $tempText = $template[$j];
            $tempText = str_replace("##Title#",$info['Title'],$tempText);
            $tempText = str_replace("##Waterfall#",$waterfall,$tempText);
            fwrite($fp,$tempText);
        }
    }

//=====更新漫画数据库函数==============================
    function updateDB()
    {
        global $conn, $info;
        $totalpage = (int)$info['Page'];
        
        mysqli_select_db($conn, 'Manga');
        mysqli_query($conn, "DROP TABLE m{$info['Code']};");
        $newtable = "CREATE TABLE m{$info['Code']} (PageNum SMALLINT NOT NULL, ImagePath varchar(255) NOT NULL, CONSTRAINT m{$info['Code']}_pk PRIMARY KEY (PageNum));";
        mysqli_query($conn, $newtable);

        for($i=1;$i<=$totalpage;$i++)
        {
            $page = addZero($i, $totalpage);

            $imgSRC = Constant("mangaImage")."/".$info['Code']."/$page.jpg";
            $insert = "INSERT INTO m{$info['Code']}".
                      "(PageNum,ImagePath)".
                      "VALUES".
                      "('$i','".$imgSRC."');";
            mysqli_query($conn, $insert);
        }
    }
?>