<?
include "dbinfo.php";
//include_once("include/verif.php");
include_once("include/head.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';

extract($_POST);
?>
<html>
<head>
<title><?php echo "$lang_factux" ?></title>
<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >
<style type="text/css">
body { font-family: "verdana", sans-serif }
</style>
</head>

<?

flush();
$conn = @mysql_connect($dbhost,$dbuser,$dbpass);
if ($conn==false)  die("password / user or database name wrong");
   $x=$_SERVER[SERVER_SOFTWARE];
   if (strpos($x,"Win32")!=0) {
      $path = $path . "dump\\";
   } else {
      $path = $path . "dump/";
   }

   // If windows gives problems
   // FOR WINDOWS change to ==> $path = $path . "dump\\";
   
   if (!is_dir($path)) mkdir($path, 0766);
   chmod($path, 0777);

	$fp2 = fopen ($path."backup.sql","w");
        $copyr="# Table backup from MySql PHP Backup\n".
               "# AB Webservices 1999-2004\n".
               "# www.absoft-my.com/pondok\n".
               "# Creation date: ".date("m-d-Y h:s",time())."\n\n";

	fwrite ($fp2,$copyr);
	fclose ($fp2);
        chmod($path."backup.sql", 0777);

   if(file_exists($path . "backup.gz"))
   { 
       unlink($path."backup.gz");
   } 
   $recreate = 0;  

function get_def($dbname, $table) {
    global $conn;
    $def = "";
    $def .= "DROP TABLE IF EXISTS $table;#%%\n";
    $def .= "CREATE TABLE $table (\n";
    $result = mysql_db_query($dbname, "SHOW FIELDS FROM $table",$conn) or die("Table $table not existing in database");
    while($row = mysql_fetch_array($result)) {
        $def .= "    $row[Field] $row[Type]";
        if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'";
        if ($row["Null"] != "YES") $def .= " NOT NULL";
       	if ($row[Extra] != "") $def .= " $row[Extra]";
        	$def .= ",\n";
     }
     $def = ereg_replace(",\n$","", $def);
     $result = mysql_db_query($dbname, "SHOW KEYS FROM $table",$conn);
     while($row = mysql_fetch_array($result)) {
          $kname=$row[Key_name];
          if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname";
          if(!isset($index[$kname])) $index[$kname] = array();
          $index[$kname][] = $row[Column_name];
     }
     while(list($x, $columns) = @each($index)) {
          $def .= ",\n";
          if($x == "PRIMARY") $def .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
          else if (substr($x,0,6) == "UNIQUE") $def .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
          else $def .= "   KEY $x (" . implode($columns, ", ") . ")";
     }

     $def .= "\n);#%%";
     return (stripslashes($def));
}

function get_content($dbname, $table) {
global $filetype, $path;
     // this function might give memory constraints on big tables
     // have to add a forced writing otherwise $content can grow to big
     // and memory will run out.
     global $conn;
     $content="";
     $result = mysql_db_query($dbname, "SELECT * FROM $table",$conn) or die("Cannot get content of table");
     // after every 5000 rows we write than no memory troubles
     $cnt=0;
     while($row = mysql_fetch_row($result)) {
         $insert = "INSERT INTO $table VALUES (";
         for($j=0; $j<mysql_num_fields($result);$j++) {
            if(!isset($row[$j])) $insert .= "NULL,";
            else if($row[$j] != "") $insert .= "'".addslashes($row[$j])."',";
            else $insert .= "'',";
         }
         $insert  = ereg_replace(",$","",$insert);
         $insert .= ");#%%\n";
         $content.= $insert;
         $cnt++;
         if ($cnt==5000) {
         	$fp = fopen ($path."backup.$filetype","a");
	        fwrite ($fp,$content);
	        fclose ($fp);
	        $cnt    = 0;
	        $content= '';
         }
         
     }
     return $content;
} // end ret_content

$filetype = "sql";

if (!eregi("/restore\.",$PHP_SELF)) {
	
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
	fwrite ($fp,"# Valid end of backup from MySql PHP Backup\n");
	fclose ($fp);
}
?>

<body bgcolor="#f4f4f4" link="#000000" alink="#000000" vlink="#000000">


<CENTER>
  <BR>
  <TABLE WIDTH="80%" border="0" cellspacing="0" bgcolor="#8BA5C5">
    <TR> 
      <TD height="215" valign="top"> <h4>MySQL PHP Backup :: Backup</h4>
        <b><font color="#990000">Your backup request was processed.</font></b> 
        <br> <font size="2"> If you did not receive any errors on the screen, 
        then you should find a directory called "dump" (without the quotes) in 
        the sub-directory of MySQL PHP Backup. <br>
        In the "dump" directory, you should find a file titled "backup.sql" (without 
        the quotes). <br>
        It contains the following tables:<br>
        <? 
        if ($_POST[table_names] == "*") {
           $count = $num_tables;
        } else {
           $count = count($tables);
        }      

        if ($count != 0 ) {
           $i=0;
           while ($i < $count) {
                if ($_POST[table_names] == "*") {
                   echo " ++ <b>".mysql_tablename($tables, $i)."</b><br>";
                } else {
                   echo " ++ <b>".$tables[$i]."</b><br>";
                }
                $i++;
           }
        } else {
           echo "<font color='red'>No tables have been backed-up </font><br>";
        }   ?>
                     
                
        This file is an unzipped backup of your database and must have the <em>same 
        name</em> if you wish to do a restore using MySQL PHP Backup. </font> 
      </TD>
    </TR>
    
    <TR> 
      <TD height="27" valign="top"><B><A HREF="main.php"><font color="#FFFFFF" size="1"><br>
        Return to Main</font></A></B></TD>
    </TR>
    <TR>
      <TD height="15" valign="top" bgcolor="#FFFFFF"><div align="right"><font color="#9999CC" face="Arial, Helvetica, sans-serif" style="font-size:6Pt">MySql 
          Php Backup &copy; 2003 by <a href="http://www.absoft-my.com" target="_blank">AB 
          Webservices</a></font> </div></TD>
    </TR>
  </TABLE>

<BR><BR>
  <BR>
  <BR>
</CENTER>
</body>
</html>
