<?php
require_once "dbconfig.php";
//set_time_limit(0);
ignore_user_abort(true);
    $path="app/app-release.apk";
    $file = "agriTrade.apk";
    $type = 'apk';
    if($fd = fopen($path,'r')){
        $fsize = filesize($path);
        $path_parts = pathinfo($path);
    header("Content-length:$fsize");
    header("Content-type:$type");
    header("Content-Disposition:attachment;filename=$file");
        header("Cache-control: private");
        while(!feof($fd)){
        $buffer = fread($fd, 2048);
            echo $buffer;
        }
    }
    fclose($fd);
    exit;
