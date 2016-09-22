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

$page = split("/", getenv('SCRIPT_NAME')); 
$n = count($page)-1; 
$page = $page[$n]; 
$page = split("\.", $page, 2); 
$extension = $page[1];
$page = $page[0];
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
extract($_POST);

if ($send2 == "  ok  ") {
  $conn = @mysql_connect($dbhost,$dbuser,$dbpass); 
  if ($conn==FALSE) {
      die("<BR>ERROR: cannot connect to database<BR>" );
  }

  $tables = mysql_list_tables($dbname,$conn);
  $num_tables = @mysql_num_rows($tables);
  if ($num_tables==0) {
     die("ERROR: Database contains no tables");
  }   
  $fp3 = fopen ($path."dbinfo.php","w");
  fwrite ($fp3,"<?\n");
  fwrite ($fp3,"\$dbhost=\"$dbhost\";\n");
  fwrite ($fp3,"\$dbuser=\"$dbuser\";\n");
  fwrite ($fp3,"\$dbpass=\"$dbpass\";\n");
  fwrite ($fp3,"\$dbname=\"$dbname\";\n");
  fwrite ($fp3,"\$path=\"$path\";\n");
  $i = 0;
  while($i < $num_tables) { 
      $tbl = mysql_tablename($tables, $i);

      fwrite ($fp3,"\$table$i=\"$tbl\";\n");
      $i++;
  }
  $i--;
  fwrite ($fp3,"\$numtables=\"$i\";\n");	
  fwrite ($fp3,"?>\n");
  fclose ($fp3);
  chmod($path."dbinfo.php", 0644);
  include ("dbinfo.php");
} else {
  if (!file_exists("dbinfo.php")) {
    echo "<meta http-equiv=Refresh  content='0;URL=form_backup.php'>";
    die("Start from index.php");
  } 
  include "dbinfo.php";
  $conn = @mysql_connect($dbhost,$dbuser,$dbpass); 
  if ($conn==FALSE) {
      die("<BR>ERROR: cannot connect to database<BR>" );
  }
}   
$c=0;
$tables="";
while ($c < $numtables){
   $var="table$c";
   $tables .= $$var."; ";
   $c++;
}
$var="table".$c;
$tables .= $$var;
?>
<br><hr><center>
<table class="boiteaction">
<FORM NAME="dobackup" METHOD="post" ACTION="backup.php">
    <TABLE WIDTH="500" BORDER="0" CELLPADDING="5" CELLSPACING="1" >
      <TR> 
        <caption><?php echo "$lang_fi_back" ?></div></caption>
      
        <INPUT NAME="dbhost" TYPE="hidden" class="textbox" VALUE="<?=$dbhost; ?>" SIZE="37" MAXLENGTH="100"> 
        
      
        
        <INPUT NAME="dbuser" TYPE="hidden" class="textbox" VALUE="<?=$dbuser; ?>" SIZE="37" MAXLENGTH="100"> 
        
              
        <INPUT NAME="dbpass" TYPE="hidden" class="textbox" VALUE="<?=$dbpass; ?>" SIZE="37" MAXLENGTH="100"> 
        
       
        
         <INPUT NAME="dbname" TYPE="hidden" class="textbox" VALUE="<?=$dbname; ?>" SIZE="37" MAXLENGTH="100"> 
      </TR><TR> 
        <td  class="texte0" colspan="2"height="35" >Les tables à sauvgarder<br>
          </TD>
        <td  class="texte0" colspan="2"><textarea name="table_names"  class="textbox" id="table" cols="37" rows="6"><?="$tables";?></textarea></TD>
      
        
        <INPUT NAME="path" TYPE="hidden" class="textbox" VALUE="<?=$url_base;?>" SIZE="37" MAXLENGTH="100"> 
        
      </TR>
      <TR> 
        <td  class="texte0" colspan="2"><?php echo "$lang_nom_back" ?></font></TD>
        <td  class="texte0" colspan="2"><INPUT NAME="send2" TYPE="submit" class="textbox" VALUE="Backup"></TD>
      </TR>
    </TABLE>
</FORM>

<FORM NAME="dorestore" METHOD="post" ACTION="restore.php">
    <TABLE WIDTH="500" HEIGHT="43" BORDER="0" CELLPADDING="5" CELLSPACING="1" >
      <caption>Restaurer un backup</caption><br>
            <?php echo " $lang_back_ser " ?></td></tr> 
     <tr>
        <td  class="texte0" colspan="2"><CENTER>
            <input name="password" type="hidden" id="password" size="15" maxlength="15" class="textbox" value=<?=$dbpass; ?>>
            &nbsp; 
            <INPUT NAME="send" TYPE="submit" class="textbox" VALUE="Restore">
		</td>
	  </tr>	
    </table>
</FORM>

<FORM NAME="dodelete" METHOD="post" ACTION="delete.php">

      <TABLE WIDTH="500" HEIGHT="45" BORDER="0" CELLPADDING="5" CELLSPACING="1" bgcolor="#8BA5C5">
        <tr>
          <caption><?php echo "$lang_bac_efkf" ?></caption></td>
        </tr>
        <tr> 
          <td  class="texte0" colspan="2">
              <CENTER><INPUT NAME="send4" TYPE="submit" class="textbox" VALUE="Delete">
            </CENTER></td>
        </tr>
      </table>
      
    </CENTER>
  </FORM>
<FORM NAME="dodownload" METHOD="post" ACTION="download.php" TARGET="_blanck">
<CENTER>
      <TABLE WIDTH="500" HEIGHT="75" BORDER="0" CELLPADDING="5" CELLSPACING="1" bgcolor="#8BA5C5">
        <tr> 
          <caption><?php echo "$lang_back_tel" ?></caption>
        </tr>
        <tr> 
          <td valign="top"> <div align="right"> 
              <div align="center"></div>
              <table width="365" align="center">
                <tr> 
                  <td  class="texte0" colspan="2"> 
                      <input name="zipit" type="radio" class="textbox" value="1" onClick="if (this.value=1) { document.dodownload.zipname.disabled=true;}">
                      <?php echo"$lang_sql" ?>
                      </font></td>
                </tr>
                <tr> 
                  <td  class="texte0" colspan="2"> &nbsp; 
                    <input name="zipit" type="radio" class="textbox" value="2" checked onclick="if (this.value=1){ document.dodownload.zipname.disabled=false;}">
                    <?php echo "$lang_back_gzip" ?></font></td>
                </tr>
                <tr> 
                  <td  class="texte0" colspan="2"><?php echo "$lang_back_comp" ?> 
                      <input name="zipname" type="text" class="textbox" id="zipname" size="20" maxlength="25" value="<?=date("Y-M-d");?>" >
                      <?php echo "$lang_back_ex" ?></font></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr> 
          <td  class="texte0" colspan="2"><CENTER>
              <INPUT NAME="send4" TYPE="submit" class="textbox" VALUE="Go">
            </CENTER></td>
        </tr>
      </table>
      
    </CENTER>
  </FORM>
	<br><hr>
<?php 
include_once("include/bas.php");
 ?> 

</CENTER>
</BODY>
</HTML>

