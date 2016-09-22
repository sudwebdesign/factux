<?php
include_once("include/config/common.php");
$num_fact=isset($_POST['num_fact'])?$_POST['num_fact']:"";
$moins=isset($_POST['retirer'])?$_POST['retirer']:"";
$plus=isset($_POST['ajouter'])?$_POST['ajouter']:"";
$sql = "SELECT list_num,CLIENT  
			  FROM " . $tblpref ."facture 
        WHERE num = $num_fact";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$list_num = unserialize($data['list_num']);

if ($moins !='') { 
  
$retirer=array(0=>$moins);
$tableau3 = array_diff ($list_num, $retirer);
$tableau4=array();
$a=0;
foreach ($tableau3 as $value) {

       $tableau4[$a]="$value";
			 $a=$a+1;
     }
		 

 $sql = "UPDATE `" . $tblpref ."bon_comm` SET `fact` = '0' WHERE `num_bon` = '$moins' LIMIT 1";
 mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 
}
if ($plus!='') { 
 $ajouter=array(0=>$plus); 
 $result = array_merge ($list_num, $ajouter);	
$z=0;
$tableau4=array();
foreach ($result as $value) {

       $tableau4[$z]="$value";
			 $z=$z+1;
     }
		 

$sql = "UPDATE `" . $tblpref ."bon_comm` SET `fact` = 'ok' WHERE `num_bon` = '$plus' LIMIT 1";
mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 }
 $suite_sql=" and " . $tblpref ."bon_comm.num_bon ='$tableau4[0]'";

for($m=1; $m<count($tableau4); $m++){
$suite_sql .= " or " . $tblpref ."bon_comm.num_bon ='$tableau4[$m]'";

}
$sql="SELECT SUM(tot_htva), SUM(tot_tva) 
FROM " . $tblpref ."bon_comm
WHERE 1";
$sql="$sql $suite_sql";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total_fact_h = $data['SUM(tot_htva)'];
$tva = $data['SUM(tot_tva)'];
$total_fact_ttc =($total_fact_h + $tva ) ;
 //
 
 $list_num=serialize($tableau4);
 
 $sql2 = "UPDATE `" . $tblpref ."facture` 
 SET `list_num` = '$list_num', 
 `total_fact_ttc` = '$total_fact_ttc',
 `total_fact_h` = '$total_fact_h'
 WHERE `num` = '$num_fact' LIMIT 1";
 mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
header("Location: edit_fact.php?num_fact=$num_fact"); 
//include_once("edit_fact.php");
?> 