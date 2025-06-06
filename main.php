<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * Version: 5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");

$page = explode("/", getenv('SCRIPT_NAME'));#split("/", getenv('SCRIPT_NAME'));#Deprecated
$n = count($page)-1;
$page = $page[$n];
$page = explode(".", $page, 2);#split("\.", $page, 2);#Deprecated
$extension = $page[1];
$page = $page[0];
/* 2005
$script 	= "$page.$extension";
$base_url 	= "http://".$_SERVER['SERVER_NAME'];
$directory 	= $_SERVER['PHP_SELF'];
$script_base = "$base_url$directory";
$base_path = $_SERVER['PATH_TRANSLATED'];
$root_path_www = $_SERVER['DOCUMENT_ROOT'];
$remove_end = strrchr($root_path_www,"/");
$root_path = ereg_replace("$remove_end", '', $root_path_www);
$url_base = "$base_url$directory";
$url_base = ereg_replace("$script", '', "$_SERVER[PATH_TRANSLATED]");
*/
#2015 alpha
#$base_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'];
$url_base = str_replace("$page.$extension",'', $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']);
//$path=str_replace("$page.$extension",'', $_SERVER['SCRIPT_FILENAME']);
#var_dump($url_base,$_SERVER);exit;

extract($_POST);
if (isset($send2) && $send2 == $lang_enter){
 $conn = @mysql_connect($dbhost,$dbuser,$dbpass);
 if ($conn==FALSE){
  die("<h1>ERROR: cannot connect to database</h1>" );
 }

 $tables = mysql_list_tables($dbname,$conn);
 $num_tables = @mysql_num_rows($tables);
 if ($num_tables==0){
  die("<h1>ERROR: Database contains no tables</h1>");
 }
 #maintenant dbinfo est supprimé quant on supprime les backup
 //~ if(!is_writable($path."dbinfo.php")){
  //~ echo "<meta http-equiv=Refresh content='3;URL=form_backup.php'>";
  //~ die("<h1>$lang_fi_lect_sl (dbinfo.php)</h1>" );
 //~ }
 $fp3 = fopen ($path."dbinfo.php","w");
 fwrite ($fp3,"<?php\n");
 fwrite ($fp3,"\$dbhost=\"$dbhost\";\n");
 fwrite ($fp3,"\$dbuser=\"$dbuser\";\n");
 fwrite ($fp3,"\$dbpass=\"$dbpass\";\n");
 fwrite ($fp3,"\$dbname=\"$dbname\";\n");
 fwrite ($fp3,"\$path=\"$path\";\n");
 $i = 0;
 while($i < $num_tables){
  $tbl = mysql_tablename($tables, $i);
  fwrite ($fp3,"\$table$i=\"$tbl\";\n");
  $i++;
 }
 $i--;
 fwrite ($fp3,"\$numtables=\"$i\";\n");
 fwrite ($fp3,"?>\n");
 fclose ($fp3);
 @chmod($path."dbinfo.php", 0644);
 include ("dbinfo.php");
}else{
 if (!file_exists("dbinfo.php")){
  echo "<meta http-equiv=Refresh content='0;URL=form_backup.php'>";
  die("Start from index.php");
 }
 include "dbinfo.php";
 $conn = @mysql_connect($dbhost,$dbuser,$dbpass);
 if ($conn==FALSE){
  die("<br>error: cannot connect to database<br>" );
 }
}
$c=0;
$tables="";
while ($c < $numtables){
  $var="table$c";
  $tables .= $$var.";\n";
  $c++;
}
$var="table".$c;
$tables .= $$var;
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <center>
    <form name="dobackup" method="post" action="backup.php">
     <table class="page" width="500" border="0" cellpadding="5" cellspacing="1" >
      <caption><?php echo $lang_fi_back; ?></caption>
      <tr>
       <input name="dbhost" type="hidden" class="textbox" value="<?php echo $dbhost; ?>" size="37" maxlength="100">
       <input name="dbuser" type="hidden" class="textbox" value="<?php echo $dbuser; ?>" size="37" maxlength="100">
       <input name="dbpass" type="hidden" class="textbox" value="<?php echo $dbpass; ?>" size="37" maxlength="100">
       <input name="dbname" type="hidden" class="textbox" value="<?php echo $dbname; ?>" size="37" maxlength="100">
      </tr>
      <tr>
       <td class="texte0" colspan="2" height="35"><?php echo $lang_back_t_a_s; ?><br></td>
       <td class="texte0" colspan="2">
        <textarea name="table_names" class="textbox" id="table" cols="37" rows="6"><?php echo $tables; ?></textarea>
       </td>
       <input name="path" type="hidden" class="textbox" value="<?php echo $url_base;?>" size="37" maxlength="100">
      </tr>
      <tr>
       <td class="c texte0" colspan="4"><?php echo $lang_nom_back; ?></td>
      </tr>
      <tr>
       <td class="c texte0" colspan="4"><input name="send2" type="submit" class="textbox" value="<?php echo $lang_sauve; ?>"></td>
      </tr>
     </table>
    </form>
    <form name="dodownload" method="post" action="download.php" target="_blank">
     <center>
      <table class="page" width="500" height="75" border="0" cellpadding="5" cellspacing="1">
       <caption><?php echo $lang_back_tel; ?></caption>
       <tr>
        <td class="texte0" valign="top">
         <div align="right">
          <div align="center"></div>
          <table class="page" width="90%" align="center">
           <tr>
            <td class="texte0" colspan="2">
              <input name="zipit" type="radio" class="textbox" value="1" onclick="if (this.value=1) { document.dodownload.zipname.disabled=true;}">
              <?php echo $lang_sql; ?>
            </td>
           </tr>
           <tr>
            <td class="texte0" colspan="2"> &nbsp;
             <input name="zipit" type="radio" class="textbox" value="2" checked onclick="if (this.value=1){ document.dodownload.zipname.disabled=false;}">
             <?php echo $lang_back_gzip; ?>
            </td>
           </tr>
           <tr>
            <td class="texte0" colspan="2"><?php echo $lang_back_comp; ?>
             <input name="zipname" type="text" class="textbox" id="zipname" size="20" maxlength="25" value="<?php echo date("Y-m-d"); ?>" >
             <?php echo $lang_back_ex; ?>
            </td>
           </tr>
          </table>
         </div>
        </td>
       </tr>
       <tr>
        <td class="c texte0" colspan="2">
         <input name="send4" type="submit" class="textbox" value="<?php echo $lang_telecharger; ?>" />
        </td>
       </tr>
      </table>
     </center>
    </form>
    <form name="dorestore" method="post" action="restore.php">
     <table class="page" width="500" height="43" border="0" cellpadding="5" cellspacing="1" >
      <caption><?php echo $lang_back_resto; ?></caption>
      <tr>
       <td class="texte1" colspan="2"><?php echo $lang_back_ser; ?></td>
      </tr>
      <tr>
       <td class="texte0" colspan="2">
        <center>
         <input name="send" type="submit" class="textbox" value="<?php echo $lang_rest; ?>">
         <input name="password" type="hidden" id="password" value="<?php echo $dbpass; ?>">
        </center>
       </td>
      </tr>
     </table>
    </form>
    <form name="dodelete" method="post" action="delete.php">
     <center>
      <table class="page" width="500" height="45" border="0" cellpadding="5" cellspacing="1">
       <caption><?php echo $lang_bac_efkf; ?></caption>
       <tr>
        <td class="texte0" colspan="2">
         <center><input name="send4" type="submit" class="textbox" value="<?php echo $lang_supprimer; ?>"></center>
        </td>
       </tr>
      </table>
     </center>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='backups';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
 </table>
</body>
</html>

