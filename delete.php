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
include_once("include/headers.php");
include_once("include/finhead.php");
$page = explode("/", getenv('SCRIPT_NAME'));
$n = count($page)-1; 
$page = $page[$n]; 
$page = explode(".", $page, 2);
$extension = $page[1];
$page = $page[0];
$path = str_replace("$page.$extension",'', $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']);
if (file_exists($path."dbinfo.php")) {
   $dir=opendir($path."dump/"); 
   while ($fl = readdir ($dir)) { 
       if ($fl != "." && $fl != ".." &&  (eregi("\.sql",$fl) || eregi("\.gz",$fl))){ 
         unlink($path."dump/".$fl); // del all sql and gz
       }
   } 
   closedir($dir); 
   unlink($path."dbinfo.php"); 
}
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <center>
    <table class="page" width="80%" border="0" cellspacing="0" >
     <caption><?php echo "$lang_back_utili" ?></caption>
     <tr> 
      <td class='texte0' valign="top">
       <p><?php echo $lang_back_effac; ?><img alt="<?php echo $lang_oui; ?>" src="image/oui.gif"></p>
       <font size="2"> 
        <br>
        <?php echo "$lang_back_upl" ?><br>
        <br>
       </font>
      </td>
     </tr>
     <tr> 
      <td class='c texte0' height="40" valign="top">
       <b><a href="form_backup.php"><br><?php echo $lang_back_ret; ?></a></b>
      </td>
     </tr>
     <tr>
      <td class='texte0' height="15" valign="top" class="texte1">
       <div align="right">
       <font color="#9999cc" face="arial, helvetica, sans-serif" style="font-size:6pt">
        mysql php backup &copy; 2003 by <a href="https://web.archive.org/web/2003/http://www.absoft-my.com/" target="_blank">ab webservices</a>
       </font>
       </div>
      </td>
     </tr>
    </table>
   </center>
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
