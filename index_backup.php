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
require_once(";;/include/verif.php");
require_once("include/head.php");
require_once("include/config/common.php");
require_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';


$page = split("/", getenv('SCRIPT_NAME')); 
$n = count($page)-1; 
$page = $page[$n]; 
$page = split("\.", $page, 2); 
$extension = $page[1];
$page = $page[0];
$script 	= "$page.$extension";
$directory 	= $_SERVER['PHP_SELF'];
$script_base = "$base_url$directory";
$base_path = $_SERVER['PATH_TRANSLATED'];
$url_base = ereg_replace("$script", '', "$_SERVER[PATH_TRANSLATED]");
?>
<br><hr><center>
<FORM NAME="dobackup" METHOD="post" ACTION="main.php">
    <TABLE WIDTH="500" HEIGHT="273" BORDER="0" CELLPADDING="5" CELLSPACING="1" bgcolor="#8BA5C5">
      <TR> 
        <TD colspan="2" NOWRAP><div align="center"><strong><?php echo $lang_bc_titre ?> </strong></div></TD>
      </TR>
      <TR> 
        <TD NOWRAP WIDTH="200"> <FONT SIZE="2" FACE="verdana,sans-serif"><?php echo $lang_bc_host ?> </FONT></TD>
        <TD NOWRAP WIDTH="300"> <INPUT NAME="dbhost" TYPE="text" class="textbox" VALUE="<?php echo $host; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      <TR> 
        <TD NOWRAP WIDTH="200"> <FONT SIZE="2" FACE="verdana,sans-serif"><?php echo $lang_bc_bata ?></FONT></TD>
        <TD NOWRAP WIDTH="300"> <INPUT NAME="dbuser" TYPE="text" class="textbox" VALUE="<?php echo $user; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      <TR> 
        <TD NOWRAP WIDTH="200"> <FONT SIZE="2" FACE="verdana,sans-serif"><?php echo $lang_bc_bata_pwd ?> </FONT></TD>
        <TD NOWRAP WIDTH="300"> <INPUT NAME="dbpass" TYPE="password" class="textbox" VALUE="<?php echo $pwd; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      <TR> 
        <TD NOWRAP WIDTH="200"> <FONT SIZE="2" FACE="verdana,sans-serif"><?php echo $lang_bc_login ?> </FONT></TD>
        <TD NOWRAP WIDTH="300"> <INPUT NAME="dbname" TYPE="text" class="textbox" VALUE="<?php echo $db; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      
        
        <INPUT NAME="path" TYPE="hidden" class="textbox" VALUE="<? echo $url_base; ?>" SIZE="37" MAXLENGTH="100"> 
        
      
      <TR> 
        <TD NOWRAP></TD>
        <TD NOWRAP><INPUT NAME="send2" TYPE="submit" class="textbox" VALUE="  ok  "></TD>
      </TR>
    </TABLE>
</FORM>
<br><hr>
<?php 
$aide = backups;
include("help.php");
require_once("include/bas.php");
 ?> 
          
