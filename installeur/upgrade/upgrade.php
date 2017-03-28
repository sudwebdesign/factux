<!DOCTYPE html> 
<html>
<head>
<meta charset="UTF-8"><?php #html5 ?>
<title>Mise à niveau de Factux : des tables de la base de données</title>
</head><body>
<?php
set_time_limit(120);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#cache les éléments deprécié
$now='../../';
echo "<link rel='stylesheet' type='text/css' href='".$now."include/themes/red/style.css'>";
echo "<center><img src='".$now."image/factux.gif' alt='FactuX : Mise à niveau' title='FactuX : Mise à niveau'>";
echo "<h2>Mise à niveau de Factux 1.1.5 -->  Factux 5.0.0</h2><hr>";
require_once($now."include/0.php");#uptophp7
include_once($now."include/config/common.php");
include_once($now."include/config/var.php");
$lang=(empty($lang))?$default_lang:$lang;#default_lg in common
include_once($now."include/language/$lang.php");

#regénération de common.php
$un=$user;
$deux=$pwd;
$trois=$db;
$quatre=$host;
$cinq=$default_lang;
$six=$tblpref;
mysql_connect($quatre,$un,$deux) or die ("<h1>Le fichier common.php semble érroné car il est impossible de ce connecter a la base de données. Veuillez verifier les information de celui-ci et recommencer la mise a niveau.");
$type = '<?php' . "\n";
$com = '//common.php créé grace à l\'installeur de Factux, soyez prudent si vous l\'éditez'. "\n";
$com .= 'error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#cache les éléments dépréciés'. "\n";
$un = '"'.$un.'";//l\'utilisateur de la base de données mysql' . "\n";
$deux = '"'.$deux.'";//le mot de passe à la base de données mysql' . "\n";
$trois = '"'.$trois.'";//le nom de la base de données mysql' . "\n";
$quatre = '"'.$quatre.'";//l\'adresse de la base de données mysql ' . "\n";
$cinq = '"'.$cinq.'";//la langue de l\'interface et des factures créées par Factux : voir la doc pour les abbréviations' . "\n";
$six = '"'.$six.'";//prefixe des tables ' . "\n";
$sept = 'require_once(@$now."include/0.php");#uptophp7 & apostrophe()'."\n";

$connect = '$cdb = mysql_connect($host,$user,$pwd) or die ("serveur de base de données injoignable. Vérifiez dans /factux/include/common.php si $host est correct.");
mysql_select_db($db) or die ("La base de données est injoignable. Vérifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");
if(function_exists(\'mysql_set_charset\'))//connexion en utf-8 maintenant
 mysql_set_charset(\'utf8\', $cdb);
else
 mysql_query("SET NAMES \'utf8\'", $cdb);//before 5.2.3
mysql_query("SET character_set_results = \'utf8\', character_set_client = \'utf8\', character_set_connection = \'utf8\', character_set_database = \'utf8\', character_set_server = \'utf8\', collation-server = \'utf8_general_ci\'");
';
#backup
file_put_contents($now."include/config/common.old_".time().".php",str_ireplace('<?php','<?php exit;//Laisser tel quel ou supprimer ce fichier du serveur',file_get_contents($now."include/config/common.php"))); 
$monfichier = fopen($now."include/config/common.php", "w+"); 
fwrite($monfichier, "\xEF\xBB\xBF".''.$type.''.$com.'$user= '.$un.'$pwd= '.$deux.'$db= '.$trois.'$host= '.$quatre.'$default_lang= '.$cinq.'$tblpref= '.$six.$sept.$connect);
fclose($monfichier);
?>

<h2>Fichier <font color="red">/factux/include/config/common.php</font> mis a jour</h2>
<?php
#regénération de var.php
$zero=apostrophe($entrep_nom);
$un=apostrophe($social);
$deux=$tel_vend;
$trois=$tva_vend;
$quatre=$compte;
$cinq=apostrophe($slogan);
$six=$reg;
$sept=$mail;
$huit=$devise;
$euro = '€';//'&euro;';//En fait nul besoin de toucher kelk chose a la devise, php se demerde bien avec le bon encodage :::  === sigle euro en utf-8
$huit = preg_replace('~'.$euro.'~', '&euro;', $huit);//$huit = preg_replace('~'.$euro.'~', '', $huit);
$type = '<?php' . "\n";
$com= '//var.php créé grâce à l\'installeur de Factux soyez prudent si vous l\'éditez' . "\n";
$zero = '"'.$zero.'";//Nom de l\'entreprise' . "\n";
$un = '"'.$un.'";//Siège social de l\'entreprise' . "\n";
$deux = '"'.$deux.'";//numéro de tel. de l\'entreprise' . "\n";
$trois = '"'.$trois.'";//numéro de T.V.A. de l\'entreprise' . "\n";
$quatre = '"'.$quatre.'";//Compte en banque de l\'entreprise ' . "\n";
$cinq = '"'.$cinq.'";//slogan de l\'entreprise' . "\n";
$six = '"'.$six.'";//Registre de commerce de l\'entreprise' . "\n";
$sept = '"'.$sept.'";//adresse email' . "\n";
$huit = '"'.$huit.'";//devise utilisée par Factux' . "\n";
$neuf = '"'.$logo.'";//fichier comportant le logo de l\'entreprise' . "\n";
$monfichier = fopen($now."include/config/var.php", "w+"); 
fwrite($monfichier, "\xEF\xBB\xBF".''.$type.''.$com.'$entrep_nom= '.$zero.'$social= '.$un.'$tel_vend= '.$deux.'$tva_vend= '.$trois.'$compte= '.$quatre.'$slogan= '.$cinq.'$reg= '.$six.'$mail= '.$sept.'$devise= '.$huit.'$logo = '.$neuf);
fclose($monfichier);
?>
<h2>Fichier <font color="red">/factux/include/config/var.php</font> mis a jour</h2>
<?php
#regénération de configav.php
require($now."include/configav.php");
$choix_use_lot=$lot;
$choix_use_liste_cli=$liste_cli;
$choix_use_cat=$use_categorie;
$choix_use_payement=$use_payement;
$choix_theme=$theme;
$choix_use_stock=$use_stock;
$choix_impression=$autoprint;
$nbr_impression=$nbr_impr;
$choix_auth_cli_devis='y';
$choix_auth_cli_bon='y';
$choix_auth_cli_fact='y';
$choix_first_art=0;
$choix_echeance_fact=30;

$filename = $now.'include/configav.php';
$texte='<?php';
$texte.="\n";
$texte.='$lot=\'';
$texte.=$choix_use_lot;
$texte.='\';';
$texte.="\n";
$texte.='$liste_cli=\'';
$texte.=$choix_use_liste_cli;
$texte.='\';';
$texte.="\n";
$texte.='$use_categorie =\'';
$texte.=$choix_use_cat;
$texte.='\';';
$texte.="\n";
$texte.='$use_payement =\'';
$texte.=$choix_use_payement;
$texte.='\';';
$texte.="\n";
$texte.='$theme=\'';
$texte.=$choix_theme;
$texte.='\';';
$texte.="\n";
$texte.='$use_stock=\'';
$texte.=$choix_use_stock;
$texte.='\';';
$texte.="\n";
$texte.='$autoprint=\'';
$texte.=$choix_impression;
$texte.='\';';
$texte.="\n";
$texte.='$nbr_impr=\'';
$texte.=$nbr_impression;
$texte.='\';';
$texte.="\n";
$texte.='$auth_cli_devis=\'';
$texte.=$choix_auth_cli_devis;
$texte.='\';';
$texte.="\n";
$texte.='$auth_cli_bon=\'';
$texte.=$choix_auth_cli_bon;
$texte.='\';';
$texte.="\n";
$texte.='$auth_cli_fact=\'';
$texte.=$choix_auth_cli_fact;
$texte.='\';';
$texte.="\n";
$texte.='$first_art=\'';
$texte.=$choix_first_art;
$texte.='\';';
$texte.="\n";
$texte.='$echeance_fact=\'';
$texte.=$choix_echeance_fact;
$texte.='\';';
$texte.="\n";

if (is_writable($filename)){
 if (!$handle = fopen($filename, 'w+')){
  echo "<h1>Impossible d'ouvrir le fichier ($filename)</h1>";
 }
 if (fwrite($handle, "\xEF\xBB\xBF".$texte) === FALSE){
  $message= "<h1>Impossible d'écrire dans le fichier ($filename)</h1>";
 }
 fclose($handle);
}else{
 $message= "<h1>Le fichier $filename n'est pas accessible en écriture.</h1>";
}
?>
<h2>Fichier admin <font color="red">/factux/include/configav.php</font> mis a jour</h2>
<hr>
<h2>Mise à niveau des données de la base</h2>
<h3>Les devis Perdus</h3>
<p><?php
$sql = "
SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff
FROM " . $tblpref ."devis 
WHERE resu = 'per'
ORDER BY num_dev ASC
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date_aff'];
 $c++; 
echo "$lang_devis $lang_numero $num_dev <br>";
}
echo "<br>Nombre $lang_total $lang_de $lang_devis $lang_perdu dans la base : $c<br>";
$sql = "UPDATE " . $tblpref ."devis SET resu = '-1' WHERE resu = 'per'";
mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
echo "<br>
Les devis perdus sont à jour.<br>
Vérification<br>
";

$sql = "
SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff
FROM " . $tblpref ."devis 
WHERE resu = '-1'
ORDER BY num_dev ASC
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$d=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date_aff'];
 $d++; 
 echo "$lang_devis $lang_numero $num_dev $date ($lang_total $total $lang_htva) à jour <br>";
}
echo "<br>Nombre total de devis perdu à jour dans la base : $d<br>Verif des devis : ";
echo ($c==$d)?"tout semble correct ;-)":"Une disparité de nombre entre les originaux et ceux mis a jour :-(";
?></p>
<h3>Les devis Gagné</h3>
<p><?php
$sql = "
SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff
FROM " . $tblpref ."devis 
WHERE resu = 'ok'
ORDER BY num_dev ASC
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date_aff'];
 $c++; 
 echo "$lang_devis $lang_ga $lang_numero $num_dev $date ($lang_total $total $lang_htva)";
 if(isset($_GET['devnet'])){
  $sql1 = "DELETE FROM " . $tblpref ."cont_dev WHERE dev_num = '".$num_dev."'";
  mysql_query($sql1) or die('<h1>Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
  echo " est supprimé<br>";
 }else{
  echo " va etre remis en intransformé<br>";
 }
}
echo "<br>Nombre total de devis gagnés dans la base : $c<br>";
?></p>
<hr>
<!--
Trouver les relations orphelines dans une base de données MySQL

SELECT t1.ID
FROM table_1 AS t1
LEFT JOIN table_2 AS t2
ON t1.ID = t2.ref_ID
WHERE t2.ref_ID IS NULL
-->
<h2>Nettoyer les relations orphelines</h2>
<h3>Les devis</h3>
<p><?php
$sql = "
SELECT " . $tblpref ."cont_dev.dev_num
FROM " . $tblpref ."cont_dev
LEFT JOIN " . $tblpref ."devis
ON " . $tblpref ."cont_dev.dev_num = " . $tblpref ."devis.num_dev
WHERE " . $tblpref ."devis.num_dev IS NULL
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$t = mysql_num_rows($req);
$sql .= "
GROUP BY " . $tblpref ."cont_dev.dev_num
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['dev_num'];
 $c++; 
 echo "$lang_devis $lang_numero $num_dev inexistant, données orphelines effacés<br>";
 $sql1 = "DELETE FROM " . $tblpref ."cont_dev WHERE dev_num = '".$num_dev."'";
 mysql_query($sql1) or die('<h1>Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
}
echo ($c)?"<br>$t lignes orphelines appartenant à $c devis inexistants ont été néttoyés<br>":"sont propres";
?></p>
<h3>Les bons de commande</h3>
<p><?php
$sql = "
SELECT " . $tblpref ."cont_bon.bon_num
FROM " . $tblpref ."cont_bon
LEFT JOIN " . $tblpref ."bon_comm
ON " . $tblpref ."cont_bon.bon_num = " . $tblpref ."bon_comm.num_bon
WHERE " . $tblpref ."bon_comm.num_bon IS NULL
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$t = mysql_num_rows($req);
$sql .= "
GROUP BY " . $tblpref ."cont_bon.bon_num
";
$req=mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num_bon = $data['bon_num'];
 $c++; 
 $sql1 = "DELETE FROM " . $tblpref ."cont_bon WHERE bon_num = '".$num_bon."'";
 mysql_query($sql1) or die('<h1>Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 echo "$lang_bon $lang_numero $num_bon inexistant, données orphelines effacés<br>";
}
echo ($c)?"<br>$t lignes orphelines appartenant à $c bons inexistants ont été néttoyés<br>":"sont propres";
?></p>
<hr>
<h3>Les Factures</h3>
<p>
<?php
/*
#fonctionnel
lister_commandes #si facturée, donne son numéro pour éditer la facture
Mesure pour relation numero_fact et commande (upgrade from 5.0.0)
pseudo code
	pour toutes les facture
		déserialisé les numéros de bons de la facture
			pour chaque numéro de bon
				mettre fact avec le numéro de la facture
*/
$sql = "
SELECT num, list_num, client  
FROM " . $tblpref ."facture 
WHERE num >= 0
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$z=0;
while($data = mysql_fetch_array($req)){
 $client = $data['client'];
 $num = $data['num'];
 $list_num = unserialize($data['list_num']);
 foreach ($list_num as $value){
  $z++;
 $sql = "UPDATE `" . $tblpref ."bon_comm` SET `fact` = '$num' WHERE `num_bon` = '$value' LIMIT 1";
 mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 echo "$lang_bon $lang_numero $value a $lang_jour avec le $lang_numero de $lang_facture $num <br />";
 }
}
echo "$z ".$lang_bon."s mis a jour";
?>
</p>
<hr>
<h2>Mise à niveau des tables de la base</h2>
<p>
<?php
//1.1.5 --> 2015
#--remise, marge, optimis, relations
$sql = "
ALTER TABLE `" . $tblpref ."bon_comm`
CHANGE `client_num` `client_num` int(10) NOT NULL DEFAULT '0' AFTER `num_bon`,
CHANGE `fact` `fact` int(11) NOT NULL DEFAULT '0' AFTER `tot_tva`;
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#vérifé

$sql = "
ALTER TABLE `" . $tblpref ."article`
CHANGE `cat` `cat` int(11) NOT NULL DEFAULT '0' AFTER `stomax`,
CHANGE `prix_htva` `prix_htva` float(20,2) NOT NULL DEFAULT '0.00' AFTER `article`,
CHANGE `taux_tva` `taux_tva` float(4,2) NOT NULL DEFAULT '0.00' AFTER `prix_htva`,
ADD `marge` float(6,2) NOT NULL DEFAULT '1.00' AFTER `taux_tva`;
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#vérifé

$sql = "
ALTER TABLE `" . $tblpref ."cont_bon`
CHANGE `num` `num` int(40) NOT NULL AUTO_INCREMENT FIRST,
CHANGE `bon_num` `bon_num` int(30) NOT NULL DEFAULT '0' AFTER `num`,
CHANGE `num_lot` `num_lot` int(10) NOT NULL DEFAULT '0' AFTER `bon_num`,
CHANGE `article_num` `article_num` int(10) NOT NULL DEFAULT '0' AFTER `num_lot`,
ADD `marge_jour` float(6,2) NOT NULL DEFAULT '1.00',
ADD `remise` float(6,2) NOT NULL DEFAULT '0.00' AFTER `marge_jour`;
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#

$sql = "
ALTER TABLE `" . $tblpref ."cont_dev`
CHANGE `num` `num` int(40) NOT NULL AUTO_INCREMENT FIRST,
CHANGE `dev_num` `dev_num` int(30) NOT NULL DEFAULT '0' AFTER `num`,
CHANGE `article_num` `article_num` int(10) NOT NULL DEFAULT '0' AFTER `dev_num`,
ADD `marge_jour` float(6,2) NOT NULL DEFAULT '1.00',
ADD `remise` float(6,2) NOT NULL DEFAULT '0.00' AFTER `marge_jour`;
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#

$sql = "
ALTER TABLE `" . $tblpref ."depense`
ADD `mont_tva` float(10,2) NOT NULL DEFAULT '0.00',
ADD `tx_tva` float(10,2) NOT NULL DEFAULT '0.00' AFTER `mont_tva`;
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#

$sql = "
ALTER TABLE `" . $tblpref ."devis`
CHANGE `client_num` `client_num` int(10) NOT NULL DEFAULT '0' AFTER `num_dev`,
CHANGE `resu` `resu` int(30) NOT NULL DEFAULT '0' AFTER `tot_tva`;
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#

$sql = "
ALTER TABLE `" . $tblpref ."facture`
CHANGE `date_fact` `date_fact` date NOT NULL DEFAULT '0000-00-00' AFTER `date_fin`,
ADD `date_pay` date NOT NULL DEFAULT '0000-00-00' AFTER `date_fact`
;";

$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$sql = "
ALTER TABLE `" . $tblpref ."facture`
CHANGE `CLIENT` `client` int(10) NOT NULL DEFAULT '0' AFTER `date_pay`
;";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#

$sql = "DROP TABLE `" . $tblpref ."payement`;";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());#
?>
Réalisé</p>
<hr>
<h2>Les Factures réglées</h2>
<p>
<?php
$sql = "
SELECT num, date_fact  
FROM " . $tblpref ."facture 
WHERE payement != 'non';
";
$req = mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$z=0;
$j=(isset($_GET['daytopay'])&&is_numeric($_GET['daytopay']))?$_GET['daytopay']:30;
while($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $date_fact = $data['date_fact'];
 $date_pay = date('Y-m-d',strtotime("+$j day", strtotime($date_fact)));
 $sql = "UPDATE `" . $tblpref ."facture` SET `date_pay` = '$date_pay' WHERE `num` = '$num' LIMIT 1";
 mysql_query($sql) or die('<h1>Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 echo "$lang_facture $lang_numero $num du $date_fact à le statut $lang_pay_le $date_pay ($j jours aprés)<br />";
 $z++;
}
echo "$z ".$lang_facture."s mises a jour";
#maybe https://docs.moodle.org/23/en/Converting_your_MySQL_database_to_UTF8
?>
</p>
<hr>Votre base de données ainsi que les fichiers de paramètrage sont à jour.<br>
Faites une verification du bon déroulement de la mise à niveau en comparant vos anciennes factures au format papier et les factures stockées dans Factux<br>
Si tout est correct faite une sauvegarde immediatement, vos anciens backups étant a présent inutilisables.
</p>
<h2>La mise à niveau de Factux est terminée, félicitations.<br>
<a href="../../doc/Utilisation-fr.html"
   onclick="window.open('','popup','width=500,height=220,top=200,left=150,toolbar=0,location=0,directories=0,status=0,menubar=1,scrollbars=1,resizable=1')" 
   target="popup">Voir la doc<br><img src="../../image/help.png" border="0" alt="aide" title="aide"></a><br>
<a href="../../index.php">Entrez<br><img src="../../image/factux.gif" border="0" alt="Entrez dans Factux" title="Entrez dans Factux"></a></h2> 
</body></html>
