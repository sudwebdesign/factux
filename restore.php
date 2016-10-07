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
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
if($_SERVER["QUERY_STRING"]=="file=backup.sql")#before head 4 display TuxInWork flush #2015
 echo "<center id='message_backup'><h2><img src='image/tux.gif'>$lang_restore_backup</h2></center>";
include_once("include/head.php");
extract ($_REQUEST);
if (!file_exists("dbinfo.php"))
 die($lang_restore_err_dbinfo_file);
include "dbinfo.php"; 
$password = $dbpass;
#js hide TuxInWork #2015 ?>
   <script type="text/javascript">document.getElementById('message_backup').style='display:none !important';</script>
   <center>
    <table class="page" width="80%" border="0" cellspacing="0">
     <caption><?php echo $lang_back_ti_re; ?></caption>
<?php if (!isset($file)) { ?>
     <tr><td class="texte0" valign="top">&nbsp;</td></tr>
<?php } ?>    
     <tr> 
      <td class="texte0"> 
<?php
$x=$_SERVER['SERVER_SOFTWARE'];
if (strpos($x,"Win32")!=0) {
 $path = $path . "dump\\";
} else {
 $path = $path . "dump/";
}

// IF WINDOWS GIVES PROBLEMS
// FOR WINDOWS change to ==> $path = $path . "dump\\";
if (isset($file)&&$file!=""){
 if (preg_match("~gz~",$file)) {#deprcated   if (eregi("gz",$file)) { //zip file decompress first than show only
  unlink($path."backup.sql");
  $fp2 = fopen("dump/backup.sql","w");
  fwrite ($fp2,"");
  fclose ($fp2);
  chmod($path."backup.sql", 0777);
  $fp = fopen("dump/backup.sql","w");
  $zp = gzopen("dump/$file", "rb");
  if(!$fp) {
   die($lang_restore_err_crea_sql);
  }    
  if(!$zp) {
   die($lang_restore_err_zip);
  }    
  while(!gzeof($zp)){
   $data=gzgets($zp, 8192);// buffer php
   fwrite($fp,$data);
  }
  fclose($fp);
  gzclose($zp);
  echo " <p>$lang_back_ext $file <img alt='$lang_oui' src='image/oui.gif'></p>";
  $file='';
 } // end of unzip
}
if (isset($file)&&$file!=""){
 flush();
 $conn = mysql_connect($dbhost,$dbuser,$password) or die(mysql_error());
 $filename = $file;
 if(!ini_get('safe_mode'))
  set_time_limit(1000);#Warning: set_time_limit() [function.set-time-limit]: Cannot set time limit in safe mode
 $file=fread(fopen($path.$file, "r"), filesize($path.$file));
 $query=explode(";#%%\n",$file);
 for ($i=0;$i < count($query)-1;$i++) {
  mysql_db_query($dbname,$query[$i],$conn) or die(mysql_error());
 }
?>
      <table class="page" width="100%">
       <tr>
        <td class='texte0'>
         <p><b><?php echo $lang_back_resto; ?></b><img alt="<?php echo $lang_oui; ?>" src="image/oui.gif"></p>
         <p><?php echo $lang_back_restO2; ?>.</p>
        </td>
       </tr>
      </table>
<?php } ?>
      </td>
     </tr>
     <tr> 
      <td class='texte0'>
       <table class="page" width="625" cellspacing="0">
        <tr> 
         <td class="texte0" width="125" align="center"><font size="2"><u><i><?php echo $lang_fichier; ?></i></u></font></td>
         <td class="texte0" width="125" align="center"><font size="2"><u><i><?php echo $lang_tai; ?></i></u></font></td>
         <td class="texte0" width="125" align="center"><font size="2"><u><i><?php echo $lang_date; ?></i></u></font></td>
         <td class="texte0" width="125"><font size="2">&nbsp;</font></td>
         <td class="texte0" width="125"><font size="2">&nbsp;</font></td>
        </tr>
<?php
	$dir=opendir($path); 
while ($file = readdir ($dir)) {
    #if ($file != "." && $file != ".." &&  (eregi("\.sql",$file) || eregi("\.gz",$file))){ #deprecated
 if ($file != "." && $file != ".." && (preg_match("~\.sql~",$file) || preg_match("~\.gz~",$file))){#strtr ? 
  if (preg_match("~\.sql~",$file)) {#deprecated (eregi("\.sql",$file) ) {
?>
        <tr>
         <td class='texte0'><?php echo $file; ?></td>
         <td class='texte0'><?php echo round(filesize($path.$file) / 1024, 2); ?> KB</td>
         <td class='texte0'><?php echo date("d-m-Y",filemtime($path.$file)); ?></td>
         <td class='texte0'><a href="restore.php?file=<?php echo $file; ?>"><?php echo $lang_rest; ?></a></td>
         <td class='texte0'><a href="dump/<?php echo $file; ?>"><?php echo $lang_voir; ?></a></td>
        </tr>
<?php } else { ?>
        <tr>
         <td class='texte1'><?php echo $file; ?></td>
         <td class='texte0'><?php echo round(filesize($path.$file) / 1024, 2); ?> KB</td>
         <td class='texte0'><?php echo date("d-m-Y",filemtime($path.$file)); ?></td>
         <td class='texte0'><a href="restore.php?file=<?php echo $file; ?>"><?php echo $lang_decompresser; ?></a></td>
         <td class='texte0'></td>
        </tr> 
<?php
  }
 } 
}
	closedir($dir);
?>
       </table>
      </td>
     </tr>
     <tr> 
      <td class='texte0' height="20" valign="top">
       <p><br><b><a href="main.php"><?php echo $lang_back_ret; ?></a></b></p>
      </td>
     </tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='restaurer';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
