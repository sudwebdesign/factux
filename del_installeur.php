<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: del_installeur.ph
 * 	effacage recursif du dossier d'installation
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
function deldir($dir) {
   $dh=opendir($dir);
   while ($file=readdir($dh)) {
       if($file!="." && $file!="..") {
           $fullpath=$dir."/".$file;
           if(!is_dir($fullpath)) {
               unlink($fullpath);
           } else {
               deldir($fullpath);
           }
       }
   }

   closedir($dh);
  
   if(rmdir($dir)) {
       return true;
   } else {
       return false;
   }
}
if($_GET['util']== 'del'){
deldir("installeur");
}

include("lister_commandes.php");

 ?> 