<?php
include_once("include/headers.php");
include "dbinfo.php";
extract($_POST);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
flush();
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php 
require_once("include/head.php");
if ($user_admin != 'y') { 
 echo "<h1>$lang_admin_droit</h1>";
 exit;
}
# Table backup from MySql PHP Backup
$conn = @mysql_connect($dbhost,$dbuser,$dbpass);
if ($conn==false) 
 die("password / user or database name wrong");
$x=$_SERVER['SERVER_SOFTWARE'];
if (strpos($x,"Win32")!=0) {
 $path = $path . "dump\\";
} else {
 $path = $path . "dump/";
}

// If windows gives problems
// FOR WINDOWS change to ==> $path = $path . "dump\\";
if (!is_dir($path)) mkdir($path, 0766);
@chmod($path, 0777);

$fp2 = fopen ($path."backup.sql","w");
$copyr="# Backup de $lang_factux\n".
"# Table backup from MySql PHP Backup\n".
"# AB Webservices 1999-2004\n".
"# www.absoft-my.com/pondok\n".
"# Creation date: ".date("m-d-Y h:s",time())."\n\n";

fwrite ($fp2,$copyr);
fclose ($fp2);
//chmod($path . "backup." . date('m-d-Y ') . ".sql", 0777);

if(file_exists($path . "backup.gz")) 
 unlink($path."backup.gz");
$recreate = 0;

function get_def($dbname, $table) {
 global $conn;
 $def = "";
 $def .= "DROP TABLE IF EXISTS $table;#%%\n";
 $def .= "CREATE TABLE $table (\n";
 $result = mysql_db_query($dbname, "SHOW FIELDS FROM $table",$conn) or die("Table $table not existing in database");
 while($row = mysql_fetch_array($result)) {
  $def .= "  $row[Field] $row[Type]";
  if ($row["Default"] != "")
   $def .= " DEFAULT '$row[Default]'";
  if ($row["Null"] != "YES")
   $def .= " NOT NULL";
  if ($row['Extra'] != "")
   $def .= " $row[Extra]";
   $def .= ",\n";
 }
 $def = preg_replace("~,\n$~","", $def);#deprecated ereg_replace(",\n$","", $def);
 $result = mysql_db_query($dbname, "SHOW KEYS FROM $table",$conn);
 while($row = mysql_fetch_array($result)) {
  $kname=$row['Key_name'];
  if(($kname != "PRIMARY") && ($row['Non_unique'] == 0))
   $kname="UNIQUE|$kname";
  if(!isset($index[$kname]))
   $index[$kname] = array();
  $index[$kname][] = $row['Column_name'];
 }
 while(list($x, $columns) = @each($index)) {
  $def .= ",\n";
  if($x == "PRIMARY")
   $def .= "  PRIMARY KEY (" . implode($columns, ", ") . ")";
  else if (substr($x,0,6) == "UNIQUE")
   $def .= "  UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
  else
   $def .= "  KEY $x (" . implode($columns, ", ") . ")";
 }
 $def .= "\n);#%%";
 return (stripslashes($def));
}
function get_content($dbname, $table) {
 global $conn;
 $content="";
 $result = mysql_db_query($dbname, "SELECT * FROM $table",$conn);
 while($row = mysql_fetch_row($result)) {
  $insert = "INSERT INTO $table VALUES (";
  for($j=0; $j<mysql_num_fields($result);$j++) {
   if(!isset($row[$j]))
    $insert .= "NULL,";
   else if($row[$j] != "")
    $insert .= "'".addslashes($row[$j])."',";
   else
    $insert .= "'',";
  }
  $insert = preg_replace("~,$~","",$insert);#deprecated ereg_replace(",$","",$insert);
  $insert .= ");#%%\n";
  $content .= $insert;
 }
 return $content;
}

$filetype = "sql";
$newfile ='';
if (!preg_match("~/restore\.~",$_SERVER['PHP_SELF'])) {#deprecated (!eregi("/restore\.",$_SERVER['PHP_SELF'])) {
 $cur_time=date("Y-m-d H:i");
 if ($table_names == "*" ) {
  $tables = mysql_list_tables($dbname,$conn);
  $num_tables = @mysql_num_rows($tables);
  $i = 0;
  while($i < $num_tables) { 
   $table = mysql_tablename($tables, $i);
   $table = ltrim($table);
   $newfile .= get_def($dbname,$table);
   $newfile .= "\n\n";
   $newfile .= get_content($dbname,$table);
   $newfile .= "\n\n";
   $i++;
  }	
 } else {
  $i=0;
  $tables=explode(";",$table_names);
  if (count($tables) != 0) {
   while($i < count($tables)) {
    $newfile .= get_def($dbname,ltrim($tables[$i]));
    $newfile .= "\n\n";
    $newfile .= get_content($dbname,ltrim($tables[$i]));
    $newfile .= "\n\n";
    $i++;
   }
  }    
 }
 $fp = fopen ($path."backup.$filetype","a");
 fwrite ($fp,$newfile);
 fwrite ($fp,"# Valid end of backup For Factux from MySql PHP Backup\n");
 fclose ($fp);
}
?> 
   <center>
    <table class="page" width="80%">
     <caption><?php echo $lang_back_titr; ?></caption>
     <tr>
      <td class="texte0" height="215" valign="top"> 
       <p><?php echo $lang_back_ok; ?><img alt="<?php echo $lang_oui; ?>" src="image/oui.gif"></p>
       <br />
<?php
    echo "$lang_back_lon<br />";
    if ($_POST['table_names'] == "*") {
      $count = $num_tables;
    } else {
      $count = count($tables);
    }   
    if ($count != 0 ) {
      $i=0;
      while ($i < $count) {
        if ($_POST['table_names'] == "*") {
          echo " ++ <b>".mysql_tablename($tables, $i)."</b><br />";
        } else {
          echo " ++ <b>".$tables[$i]."</b><br />";
        }
        $i++;
      }
    } else {
     echo "<font color='red'>$lang_back_err</font><br>";
    }
    echo $lang_back_lon2;
?>
       
      </td>
     </tr>
     <tr> 
      <td class="c texte0" height="27" >
       <b><a href="main.php"><br><?php echo $lang_back_ret; ?></a></b>
      </td>
     </tr>
    </table>
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
