<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * Version: 5.0.0
 * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
function calendrier_local_mois (){
 global $code_langue;
 setlocale(LC_TIME, $code_langue);
 $an = strftime ( "%G", time ());
 for ($i=1;$i<=12;$i++){
  $premier = mktime(0, 0, 0, $i, 1, $an);
  $calendrier [$i] = strftime ( "%B", $premier);
 }
 return $calendrier;
}
function calendrier_local_mois2 (){
 global $code_langue;
 setlocale(LC_TIME, $code_langue);
 $an = strftime ( "%G", time ());
 for ($i=12;$i<=12;$i++){
  $premier = mktime(0, 0, 0, $i, 1, $an);
  $calendrier [$i] = strftime ( "%B", $premier);
 }#echo '<h1>'.$code_langue.$an.'</h1>';var_dump(setlocale(LC_ALL, 'fr_FR', 'french', 'fr', 'fr_FR.ISO8859-1'),setlocale(LC_TIME, $code_langue));exit;
 return $calendrier;
}
function calendrier_local_mois3 (){
 global $code_langue;
 setlocale(LC_TIME, $code_langue);
 $an = strftime ( "%G", time ());
 for ($i=1;$i<=11;$i++){
  $premier = mktime(0, 0, 0, $i, 1, $an);
  $calendrier [$i] = strftime ( "%B", $premier);
 }
 return $calendrier;
}
function calendrier_local_jour (){
 global $code_langue;
 setlocale(LC_TIME, $code_langue);
 $jour = (int)strftime ( "%A", time ());
 for ($i=5;$i<=10;$i++){
  $premier = mktime(0, 0, 0, 0, $i, $jour);
  $calendrier [$i] = strftime ( "%A", $premier);
 }
 return $calendrier;
}
function calendrier_local_jour2 (){
 global $code_langue;
 setlocale(LC_TIME, $code_langue);
 $jour = (int)strftime ( "%A", time ());
 for ($i=11;$i<=11;$i++){
  $premier = mktime(0, 0, 0, 0, $i, $jour);
  $calendrier [$i] = strftime ( "%A", $premier);
 }
 return $calendrier;
}
?>
