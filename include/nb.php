<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *   http://factux.free.fr
 *
 * File Name: fckconfig.js
 *  Editor configuration settings.
 *
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 *
 * File Authors:
 *   Guy Hendrickx
 *.
 *
 *
 *
*/

function montant_taux ($number): string{
  return avec_virgule ($number).'%';
}

function montant_financier ($number): string{
  global $devise;
  return avec_virgule ($number).$devise;
}

function avec_virgule ($number, $decimales=2): string{
  return number_format ($number, $decimales, ",", "");
}

/**** l10n ready
 * Titre : Ecrire des nombres en literal (toutes lettres)
 * Auteur : Damien Seguy
 * Email : dams@nexen.net
 * Url : www.nexen.net/
 * up to php5 : Thomas factux.free.fr 2015
 * Description : nombre_literal ecrit en toute lettre des nombres.
 * Les nombres peuvent être entier, a virgule, mais positif, ecrit uniquement en chiffres et avec une vrai virgule (coma).

 * Avertissement : Cette librairie de fonctions PHP est distribuee avec l'espoir
 * qu'elle sera utile, mais elle l'est SANS AUCUNE GARANTIE; sans meme la garantie de
 * COMMERCIALISATION ou d'UTILITE POUR UN BUT QUELCONQUE.
 * Elle est librement redistribuable tant que la presente licence, ainsi que les credits des
 * auteurs respectifs de chaque fonctions sont laisses ensembles.
 * En aucun cas, Nexen.net ne pourra etre tenu responsable de quelques consequences que ce soit
 * de l'utilisation ou la mésutilisation de ces fonctions PHP.
****/
//include_once(__DIR__ . "/config/var.php");#devise & $lang
//include_once(__DIR__ . "/language/$lang.php");
define ("ENTIER", "");
define ("VIRGULE", ",");
define ("DECIMALE", $lang_centime);
define ("DEVISE", $lang_monnaie);
define ("ET", "et");#and
define ("CENT", "cent");#centaine hundred
define ("S", "s");#pluriel

function nombre_literal($nombre, string $partie_entiere=ENTIER, string $virgule=VIRGULE, $devise=DEVISE, $decimale=DECIMALE): string{
 // initialisation (l10n ???)
 $zro = "zéro";
 $unite = ["", "un","deux","trois","quatre","cinq","six","sept","huit","neuf","dix","onze","douze","treize","quatorze","quinze","seize","dix-sept","dix-huit","dix-neuf"];
 $dizaine = ["", "dix","vingt","trente","quarante","cinquante","soixante","soixante-dix","quatre-vingt","quatre-vingt-dix"];
 $millier = ["", "mille","million","milliard","billion","trillion","quadrillion","quintillion"]; // on fait de cette valeur un nombre
 // on fait de cette valeur un nombre
 $nombre = preg_replace("/[^,0-9]/", "", $nombre);
 if ($nombre == ""){ return $zro; }

 $parties = explode($virgule, $nombre);#$parties = split("," , $nombre);
 $nombre = array_shift($parties);
 if ($parties !== []) { $nombre .= $virgule.implode("", $parties);}#{ $nombre .= ",".implode("", $parties);}

 $nmbr = intval($nombre); // Fix Warning: A non-numeric value encountered (Lgn: 77 78 & 79)
 $les_centaines = floor($nmbr / 100); //                           o : floor($nombre / 100);
 $les_dizaines = floor(($nmbr - $les_centaines * 100) / 10); //    o : floor(($nombre - $les_centaines * 100) / 10);
 $lunite = ($nmbr - $les_centaines * 100 - $les_dizaines * 10); // o : ($nombre - $les_centaines * 100 - $les_dizaines * 10);

 // cas de la virgule
 if (preg_match('~'.$virgule.'~', $nombre)){#2015 [strstr($virgule, $nombre)#not work???] #if (ereg(',', $nombre)){
  list($e, $d) = explode($virgule, $nombre);#list($e, $d) = explode(",", $nombre);
  $r = nombre_literal($e);
;
  $z = substr($d, 0, strlen($d) - strlen(intval($d)));
  $rc = nombre_literal(intval($d));
  # Si on utilise des devis, on affiche "zéro" et non "zéro zéro" après la virgule
  # ... attention: ça ne marche que s'il y a maximum 2 décimales.
   $z = preg_replace("~0~", $zro . ' ', $z);#2015 #ereg_replace("0", "$zro ", $z);
   if (($partie_entiere != ENTIER) && (substr ($z, 0,1) == "z")){// on utile une devise
    $z = "";
   }

   $z = ((($d>00||$d<10))?'':$z);#/!\enleve le zéro devant, quant il y a de un à neuf centimes.
   $devise = (1.01>((float)str_replace($virgule,'.',$nombre))?$devise:$devise.S);#pluriel
   $centimes = nombre_literal($d);
   $centimes = ((strstr($centimes,$unite[1]))?str_replace($unite[1],$unite[1].'e',$centimes):$centimes);#feminin (un = une)
   $decimale = ((($d!=00)&&($d!=01))?$decimale.S:$decimale);#pluriel
   $r = $r.$partie_entiere.sprintf(' %s ', $devise).ET." ".$z.$centimes." ".$decimale;
  return ucfirst($r);#retour final
 }

 // calcul
 $r = "";
 if ($nombre < 1000) {
     // en dessous de cent
     if ($les_dizaines*10 + $lunite == 0) {
         $r .= $zro;
     } elseif ($les_dizaines*10 + $lunite < 20) {
         $r .= $unite[$les_dizaines*10 + $lunite];
     } elseif (($les_dizaines == 8) && ($lunite==0)) {
         $r .= $dizaine[$les_dizaines].S;
         #pluriel
     } elseif (in_array( $les_dizaines, [2,3,4,5,6,8])) {
         $r .= $dizaine[$les_dizaines]." ".$unite[$lunite];
         if (($lunite==1) && ($les_dizaines < 8)){
          $r = preg_replace("~ ~", " ".ET." ", $r);#2015:str_replace(" ", " et ", $r) #ereg_replace(" ", " et ", $r);
         }
     } elseif (in_array($les_dizaines, [7,9])) {
         $r .= $dizaine[$les_dizaines-1]." ".$unite[$lunite+10];
         if (($lunite==1) && ($les_dizaines == 7)){
          $r = preg_replace("~ ~", " ".ET." ", $r);#2015:str_replace(" ", " et ", $r) #ereg_replace(" ", " et ", $r);
         }
     }

     // pour les centaines :
     if ($les_centaines > 1) {
         if ($r == $zro){ // cas des centaines tout rond
          $r = $unite[$les_centaines]." ".CENT.S." ";#pluriel
         } else {
          $r = $unite[$les_centaines]." ".CENT." ".$r;
         }
     } elseif ($les_centaines == 1) {
         if ($r == $zro){ $r = "";}

         $r = CENT." ".$r;
     }
 } elseif ($nombre < 1000000000000000000000) {
     // cela couvre largement les nombres classiques.
     $bloc = [];
     while($nombre > 0) {
      $milliers = floor($nombre / 1000);
      $mille = $nombre - $milliers*1000;
      $bloc[] = $mille;
      $nombre = ($nombre - $mille) / 1000;
     }

     // pour les milliers
     $milliers = $millier;
     #array("", "mille","million","milliard","billion","trillion","quadrillion","quintillion");
     foreach ($bloc as $b) {
      $s = S;#pluriel
      $rc = nombre_literal($b);
      $t = array_shift($milliers);
      if ($rc != $zro){#zéro
       #un
       if ($rc == $unite[1] && $t == $millier[1]){#mille
        $rc = "";
       }

       if (in_array($t, ["",$millier[1]]) || ($rc == $unite[1])) {
           $s = "";
       }

       $r = $rc.sprintf(' %s%s ', $t, $s).$r;
      }
     }
 }

 return trim($r.$partie_entiere);
}


