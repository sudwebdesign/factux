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
 * * Version:  1.1.5
 * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 *
 *
 *
 * Avertissement : Cette librairie de fonctions PHP est distribuee avec l'espoir 
 * qu'elle sera utile, mais elle l'est SANS AUCUNE GARANTIE; sans meme la garantie de 
 * COMMERCIALISATION ou d'UTILITE POUR UN BUT QUELCONQUE.
 * Elle est librement redistribuable tant que la presente licence, ainsi que les credits des 
 * auteurs respectifs de chaque fonctions sont laisses ensembles. 
 * En aucun cas, Nexen.net ne pourra etre tenu responsable de quelques consequences que ce soit
 * de l'utilisation ou la mesutilisation de ces fonctions PHP.

*/

/****
 * Titre : Ecrire des nombres 
 * Auteur : Damien Seguy 
 * Email : dams@nexen.net
 * Url : www.nexen.net/
 * Description : nombre_literal ecrit en toute lettre des nombres.
Les nombres peuvent être entier, a virgule, mais positif, et ecrit uniquement en chiffres et virgule.
****/
//$euro= '€';
//$devise = ereg_replace('&#128;', $euro, $devise);

define ("ENTIER", "");
define ("VIRGULE", ".");
define ("DECIMALE", "");

define ("EURO", "euro");
define ("ET", "et");
define ("CENT", "cent");



function montant_taux ($number)
{
  global $devise;
  return avec_virgule ($number)." ".'%';
}



function montant_financier ($number)
{
  global $devise;
  return avec_virgule ($number)." ".$devise;
}

function avec_virgule ($number, $decimales=2)
{
  return number_format ($number, $decimales, ",", "");
}


function nombre_literal($nombre, $partie_entiere=ENTIER, $virgule=VIRGULE, $decimale=DECIMALE){
// on fait de cette valeur un nombre
	$nombre = preg_replace("/[^,0-9]/", "", $nombre);
	if ($nombre == ""){ return "z&eacute;ro"; }
	$parties = split("," , $nombre);
	$nombre = array_shift($parties);
	if (count($parties) > 0) { $nombre .= ",".implode("", $parties);}
	
	// initialisation
	$unite = array("", "un","deux","trois","quatre","cinq","six","sept","huit","neuf","dix","onze","douze","treize","quatorze","quinze","seize","dix-sept","dix-huit","dix-neuf");
	$dizaine = array("", "dix","vingt","trente","quarante","cinquante","soixante","soixante-dix","quatre-vingt","quatre-vingt-dix");

	$les_centaines = floor($nombre / 100);
	$les_dizaines = floor(($nombre - $les_centaines * 100) / 10);
	$lunite = ($nombre - $les_centaines * 100 - $les_dizaines * 10);

	// cas de la virgule
	if (ereg(',', $nombre)){
		list($e, $d) = explode(",", $nombre);
		$r = nombre_literal($e);
		
		$z = substr("$d", 0, strlen($d) - strlen(intval($d)));
		$rc = nombre_literal(intval($d));
		
//		if ($rc != "z&eacute;ro"){ 
        // Modification par www.cyberiel.com 10-05-2004. Afficher "virgule zéro zéro"
        // Modification par www.cyberiel.com 10-05-2004. Afficher EURO et CENT
		// Si on utilise des devis, on affiche "zéro" et non "zéro zéro" après la virgule
		// ... attention: ça ne marche que s'il y a maximum 2 décimales.
			$z = ereg_replace("0", "z&eacute;ro ", $z);
			echo "z = $z<br>";
			echo "nombre_literal=".nombre_literal($d)."<br>";
			if (($partie_entiere <> ENTIER) && (substr ($z, 0,1) == "z"))// on utile une devise
			  {
			  $z = "";
			  }
			$r = "$r $partie_entiere $virgule $z".nombre_literal($d)." $decimale";
//		}
	   return $r;
	}	

	// calcul
	$r = "";
	if ($nombre < 1000) {
	// en dessous de cent
		if ($les_dizaines*10 + $lunite == 0){
			$r .= "z&eacute;ro";
		} else if ($les_dizaines*10 + $lunite < 20){
			$r .= $unite[$les_dizaines*10 + $lunite];
		} else if (($les_dizaines == 8) && ($lunite==0)){
			$r .= $dizaine[$les_dizaines]."s";
		} else if (in_array( $les_dizaines, array(2,3,4,5,6,8))){
			$r .= $dizaine[$les_dizaines]." ".$unite[$lunite];
			if (($lunite==1) && ($les_dizaines < 8)){
				$r = ereg_replace(" ", " et ", $r);
			}
		} else if ( in_array($les_dizaines, array(7,9))){
			$r .= $dizaine[$les_dizaines-1]." ".$unite[$lunite+10];	
			if (($lunite==1) && ($les_dizaines == 7)){
				$r = ereg_replace(" ", " et ", $r);
			}	
		}
		
		// pour les centaines :
		if ($les_centaines > 1) {
			if ($r == "z&eacute;ro"){ // cas des centaines tout rond
				$r = $unite[$les_centaines]." cents ";
			} else {
				$r = $unite[$les_centaines]." cent ".$r;
			}
		} else if ($les_centaines == 1) {
			if ($r == "z&eacute;ro"){ $r = "";}
			$r = "cent ".$r;
		}
	} else  if ($nombre < 1000000000000000) {
	// cela couvre largement les nombres classiques. 
		$bloc = array();
		while($nombre > 0) {
			$milliers = floor($nombre / 1000);
			$mille = $nombre - $milliers*1000;
			array_push($bloc, $mille);
			$nombre = ($nombre - $mille) / 1000;
		}
		$titres = array("", "mille","million","milliard","billion","trillion");
		foreach ($bloc as $b) {
			$s = "s";
			$rc = nombre_literal($b);
			$t = array_shift($titres);
			if ($rc != "z&eacute;ro") {
				if ($rc == "un") {
					if ($t == "mille"){ $rc = "";} 
				}
				if (in_array($t, array("","mille")) || ($rc == "un")){ $s = "";} 
	
				$r = $rc." $t$s ".$r;
			}		
		}
	}	
	return $r." $partie_entiere";
}

?>