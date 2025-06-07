<?php
include_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
$num_fact=isset($_POST['num_fact'])?$_POST['num_fact']:"";
$moins=isset($_POST['retirer'])?$_POST['retirer']:"";
$plus=isset($_POST['ajouter'])?$_POST['ajouter']:"";
$sql = "
SELECT list_num,client
FROM " . $tblpref ."facture
WHERE num = {$num_fact}
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$list_num = unserialize($data['list_num']);

if ($moins !=''){
 $retirer=[0=>$moins];
 $tableau3 = array_diff ($list_num, $retirer);
 $tableau4=[];
 $a=0;
 foreach ($tableau3 as $value){
  $tableau4[$a]=$value;
  $a += 1;
 }

 $sql = "UPDATE `" . $tblpref .sprintf("bon_comm` SET `fact` = '0' WHERE `num_bon` = '%s' LIMIT 1", $moins);
 mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}

if ($plus!=''){
 $ajouter=[0=>$plus];
 $result = array_merge ($list_num, $ajouter);
 $z=0;
 $tableau4=[];
 foreach ($result as $value){
  $tableau4[$z]=$value;
  $z += 1;
 }

 sort($tableau4,SORT_NUMERIC);
 $sql = "UPDATE `" . $tblpref .sprintf("bon_comm` SET `fact` = '%s' WHERE `num_bon` = '%s' LIMIT 1", $num_fact, $plus);
 mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}

$suite_sql=" and " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $tableau4[0]);
$counter = count($tableau4);

for($m=1; $m<$counter; $m++){
 $suite_sql .= " or " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $tableau4[$m]);
}

$sql="
SELECT SUM(tot_htva), SUM(tot_tva)
FROM " . $tblpref ."bon_comm
WHERE 1
";
$sql=sprintf('%s %s', $sql, $suite_sql);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total_fact_h = floatval($data['SUM(tot_htva)']);
$tva = floatval($data['SUM(tot_tva)']);
$total_fact_ttc =($total_fact_h + $tva ) ;

$list_num=serialize($tableau4);//

$sql2 = "
UPDATE `" . $tblpref ."facture`
SET `list_num` = '{$list_num}',
`total_fact_ttc` = '{$total_fact_ttc}',
`total_fact_h` = '{$total_fact_h}'
WHERE `num` = '{$num_fact}'
LIMIT 1
";
mysql_query($sql2) || die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());

header('Location: edit_fact.php?num_fact=' . $num_fact);
//include_once(__DIR__ . "/edit_fact.php");
