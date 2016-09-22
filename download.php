<?PHP
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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
extract($_POST);
function compress($zip) {// compress a file without using shell
 $zip=rtrim($zip);
 $fp = @fopen("dump/backup.sql","rb");
 if (file_exists("dump/".$zip.".gz")) unlink("dump/".$zip.".gz");
 $zp = @gzopen("dump/".$zip.".gz", "wb9");
 if(!$fp){global $lang_aucun_sql; die($lang_aucun_sql);}    
 if(!$zp){global $lang_err_c_zip; die($lang_err_c_zip.$zip.".gz");}    
 while(!feof($fp)){
  $data=fgets($fp, 8192);	// buffer php
  gzwrite($zp,$data);
 }
 fclose($fp);
 gzclose($zp);
 return true;
}

if ($zipit) {
 if (($zipit==2) && (compress($zipname)==true))
  header("location: dump/".$zipname.".gz");
 if ($zipit==1)
  header("location: dump/backup.sql");
} else {
 die($lang_err_f);
}
