<?php 

$dir = fpdf ;
    $t=time();
    $h=opendir($dir);
    while($file=readdir($h))
    {
        if( substr($file,-4)=='.pdf')
        {
            $path=$dir.'/'.$file;	
            if($t-filemtime($path)>3)
                @unlink($path);
        }
    }
    closedir($h);
 ?> 