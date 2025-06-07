<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: del_installeur.ph
 * 	effacage recursif du dossier d'installation
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
function deldir(string $dir): bool{
 $dh=opendir($dir);
 while ($file=readdir($dh)){
  if($file!="." && $file!=".."){
   $fullpath=$dir."/".$file;
   if(!is_dir($fullpath)) {
    unlink($fullpath);
   } else {
    deldir($fullpath);
   }
  }
 }

 closedir($dh);
 if(rmdir($dir)){
  return true;
 } else {
  return false;
 }
}

if($_GET['util']== 'del'){
deldir("installeur");
}

include(__DIR__ . "/lister_commandes.php");
unlink(__FILE__);
