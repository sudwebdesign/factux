<?PHP
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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
extract($_POST);
function compress($zip): bool {// compress a file without using shell
 $zip=rtrim($zip);
 $fp = @fopen("dump/backup.sql","rb");
 if (file_exists("dump/".$zip.".gz")) {
     unlink("dump/".$zip.".gz");
 }

 $zp = @gzopen("dump/".$zip.".gz", "wb9");
 if(!$fp){
  global $lang_aucun_sql;
  die($lang_aucun_sql);
 }

 if(!$zp){
  global $lang_err_c_zip;
  die($lang_err_c_zip.$zip.".gz");
 }

 while(!feof($fp)){
  $data=fgets($fp, 8192);	// buffer php
  gzwrite($zp,$data);
 }

 fclose($fp);
 gzclose($zp);
 return true;
}

if ($zipit) {
 if (($zipit==2) && (compress($zipname)==true)) {
  header("location: dump/".$zipname.".gz");
 }

 if ($zipit==1) {
  header("location: dump/backup.sql");
 }
} else {
 die($lang_err_f);
}
