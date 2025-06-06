<?php
$dir = (isset($now)?$now:'').'fpdf';
$t=time();
$h=opendir($dir);
while($file=readdir($h)){
 if( substr($file,-4)=='.pdf'){
  $path=$dir.'/'.$file;
  if($t-filemtime($path)>3)
   @unlink($path);
 }
}
closedir($h);
#fichiers de sessions périmés
$dir = (isset($now)?$now:'').'include/session';
$t=time();
$h=opendir($dir);
while($file=readdir($h)){
 if( substr($file,0,1)=='s'){#protect .htaccess
  $path=$dir.'/'.$file;
  if($t-filemtime($path)>(3600*12))#1/2 jour
   @unlink($path);
 }
}
closedir($h);
