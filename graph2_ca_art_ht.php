<?php
/* fait partie de stats2.2.php
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: graph2_client.php
 * 	parametrage d'appel du camembert ca / client.
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *
 */
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
//pour le formulaire
$mois_1 = isset($_GET['mois_1'])?$_GET['mois_1']:$lang_tous;#date("m")
$annee_1 = isset($_GET['annee_1'])?$_GET['annee_1']:$lang_toutes;#date("Y")
$ands = ($annee_1==$lang_toutes)?'':'WHERE YEAR(date) = ' . $annee_1;#si année choisie
$aw = (($annee_1==$lang_toutes&&$mois_1!=$lang_tous))?'WHERE':' AND';#si toutes années et mois choisi #idée GROUP BY DAY(date)
$ands .= ($mois_1==$lang_tous)?'':sprintf('%s MONTH(date) = %s', $aw, $mois_1);#si année entiere

//pour le total
$sql = "
SELECT SUM(tot_art_htva)
FROM " . $tblpref ."cont_bon
LEFT JOIN " . $tblpref ."bon_comm on bon_num = num_bon
{$ands}
";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_art_htva)'];

$sql = "
SELECT " . $tblpref ."article.num,
SUM(tot_art_htva) AS tot_art_htva,
SUM(quanti) AS nombre,
p_u_jour,
prix_htva,
SUM((tot_art_htva - ((p_u_jour / marge_jour) * quanti)) * (1-(remise/100))) AS marge,
SUM((p_u_jour * quanti) - tot_art_htva) AS remise,
date,
article,
uni
FROM  " . $tblpref ."cont_bon
LEFT JOIN " . $tblpref ."bon_comm on bon_num = num_bon
LEFT JOIN " . $tblpref ."article on " . $tblpref ."article.num = article_num
{$ands}
GROUP BY article
";//ORDER BY tot_art_htva DESC
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//$data = mysql_fetch_array($req);
$c = 0;
$remise = 0;
$marge = 0;
$margereele = 0;
$cd=320;
while ($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $art = $data['article'];
 $tot = $data['tot_art_htva'];
 $quanti = $data['nombre'];
 $uni = $data['uni'];
 $prix_achat = $data['prix_htva'];
 $prix = $data['p_u_jour'];
 $remise += $data['remise'];
 $marge += $data['marge'];
 $margereele += $data['marge']-$data['remise'];
 $pourcentage = (string)round($tot / $total * 100.00, 2);
/**/
 $ChartLabel[]=$art." (".$pourcentage."%)";//$data['nom'];
 $ChartData[]=$tot;
 $cd+=10;
}

if($cd==320){#si vide
 $ChartData[]=0;
 $ChartLabel[]='N/A';
}

$ChartDiameter=($cd<=760)?$cd:760;
$ChartFont=13;
include(__DIR__ . "/graph_circulaire_base.php");#Graphique sectoriel au format GIF
