<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>Factux : l'installeur</title>

<?php				
echo "<link rel='stylesheet' type='text/css' href='../../include/themes/default/style.css'>";
echo '<center><img src="../../image/factux.gif" alt="">';
echo '<h2>Upgrade de Factux 1.1.4 --> 1.1.5</h2><hr>';
require_once("../../include/config/common.php");

 $sql1 = "ALTER TABLE " . $tblpref ."facture ADD `list_num` MEDIUMTEXT  NOT NULL ;"
        . ' ';
	 mysql_query($sql1)or die('Erreur SQL1 !'.$sql1.'
'.mysql_error());			
$sql2 = "ALTER TABLE " . $tblpref ."facture CHANGE `payement` `payement` VARCHAR( 15 ) DEFAULT 'non' NOT NULL ";
 mysql_query($sql2)or die('Erreur SQL2 !'.$sql2.'
'.mysql_error());
$sql3 = "ALTER TABLE " . $tblpref ."cont_bon ADD `num_lot` VARCHAR( 15 ) NOT NULL ;"
        . ' ';
 mysql_query($sql3)or die('Erreur SQL3 !'.$sql3.'
'.mysql_error());				
$sql4 = "CREATE TABLE " . $tblpref ."categorie ( `id_cat` int( 11 ) NOT NULL AUTO_INCREMENT ,"
        . ' `categorie` varchar( 30 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `id_cat` ) ) TYPE = MYISAM ';
 mysql_query($sql4)or die('Erreur SQL4 !'.$sql4.'
'.mysql_error());				
$sql5 = "ALTER TABLE " . $tblpref ."article ADD `stock` FLOAT( 15, 2 ) DEFAULT '0.00' NOT NULL ,"
        . ' ADD `stomin` FLOAT( 15, 2 ) DEFAULT \'0.00\' NOT NULL ,'
				. ' ADD `stomax` FLOAT( 15, 2 ) DEFAULT \'0.00\' NOT NULL ;'
        . ' ';
 mysql_query($sql5)or die('Erreur SQL5 !'.$sql5.'
'.mysql_error());

 $sql6 = "ALTER TABLE " . $tblpref ."article ADD `cat` VARCHAR( 10 ) DEFAULT '0' NOT NULL ;"
        . ' ';
 mysql_query($sql6)or die('Erreur SQL6 !'.$sql6.'
'.mysql_error());

$sql7 = "UPDATE " . $tblpref ."article SET cat='0' WHERE 1 ";
mysql_query($sql7) or die('Erreur SQL7 !<br>'.$sql7.'<br>'.mysql_error());



echo"La structure des tables à été mise à jour<br>";

$sql="SELECT date_deb, date_fin, num, CLIENT FROM " . $tblpref ."facture WHERE list_num =''";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$debut=$data['date_deb'];
		$fin=$data['date_fin'];
		$num_fact=$data['num'];
		$client=$data['CLIENT'];
		
		
//nouvelle methode
$sql1 = " SELECT num_bon 
		FROM " . $tblpref ."bon_comm 
		 WHERE " . $tblpref ."bon_comm.client_num = '".$client."' 
		 AND " . $tblpref ."bon_comm.date >= '".$debut."' 
		 and " . $tblpref ."bon_comm.date <= '".$fin."'";


$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
unset($list_num);
while($data1 = mysql_fetch_array($req1))
    {
		$list_num[] = $data1['num_bon'];
		}
		
$list_num = serialize($list_num);


$sql2 = "UPDATE " . $tblpref ."facture SET list_num='$list_num' WHERE " . $tblpref ."facture.num = '".$num_fact."' ";
mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
echo"Facture $num_fact mis à jour<br>";

}
 
 $sql8 = "ALTER TABLE " . $tblpref ."facture DROP `accompte` ;"
        . ' ';
	 mysql_query($sql8)or die('Erreur SQL8 !'.$sql8.'
'.mysql_error());
			

?>
Votre base de donnée et les enregistrement des factures ont été mis a jour. <br>
Faites une verification du bon deroulement de l'upgrade en comparant vos anciennes factures au foremat papier et les factures stockées dans Factux<br>
Si tout est correct faite un backup imediatement vos anciens backups étant a present inutilisables.

