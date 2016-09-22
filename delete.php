<?
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
include_once("include/head.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';

if (file_exists($path."dbinfo.php")) {
   $dir=opendir($path."dump/"); 
   $fl = readdir($dir);
   while ($fl = readdir ($dir)) { 
       if ($fl != "." && $fl != ".." &&  (eregi("\.sql",$fl) || eregi("\.gz",$fl))){ 
         unlink($path."dump/".$fl); // del all sql and gz
       }
   } 
   closedir($dir); 
   unlink($path."dbinfo.php"); 
}
 
?>
<html>
<head>


</head>

<center>

  <TABLE WIDTH="80%" border="0" cellspacing="0" >
    <TR> 
      <TD  valign="top"> <h4><?php echo "$lang_back_utili" ?></h4>
        <b><font color="#990000"><?php echo "$lang_back_effac" ?></font></b><font size="2"> 
        <br>
        <?php echo "$lang_back_upl" ?><br>
        <br>
        </font></TD>
    </TR>
    <TR> 
      <TD height="40" valign="top"><b><br>
        <a href="form_backup.php"><font size="1"><?php echo "$lang_back_ret" ?></font></a> 
        </b></TD>
    </TR>
    <TR>
      <TD height="15" valign="top" bgcolor="#FFFFFF"><div align="right"><font color="#9999CC" face="Arial, Helvetica, sans-serif" style="font-size:6Pt">MySql 
          Php Backup &copy; 2003 by <a href="http://www.absoft-my.com" target="_blank">AB 
          Webservices</a></font> </div></TD>
    </TR>
  </TABLE>

<br><br>
  <br>
  <br>
  <br>
  <br>
  <br>

</center>
</body>
</html>
