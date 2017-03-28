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
 * File Name: date.php
 * 	Date multilingue.
 * 
 * * Version: 5.0.0
 * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Thomas Ingles
 *.m removed 4 code lang
 */
include('lang_days_months.php');
function calendrier_local_mois (){
 global $jm;
 for ($i=1;$i<=12;$i++){
  $calendrier [$i] = $jm[$i-1][str_replace('.m','',$_SESSION['lang'])];
 }
 return $calendrier;
}
function calendrier_local_mois2 (){
 global $jm;
 for ($i=12;$i<=12;$i++){
  $calendrier [$i] = $jm[$i-1][str_replace('.m','',$_SESSION['lang'])];
 }
 return $calendrier;
}
function calendrier_local_mois3 (){
 global $jm;
 for ($i=1;$i<=11;$i++){
  $calendrier [$i] = $jm[$i-1][str_replace('.m','',$_SESSION['lang'])];
 }
 return $calendrier;
}
function calendrier_local_jour (){
 global $jc;
 for ($i=5;$i<=10;$i++){
  $calendrier [$i] = $jc[$i-5][str_replace('.m','',$_SESSION['lang'])];
 }
 return $calendrier;
}
function calendrier_local_jour2 (){
 global $jc;
 for ($i=11;$i<=11;$i++){
  $calendrier [$i] = $jc[$i-5][str_replace('.m','',$_SESSION['lang'])];
 }
 return $calendrier;
}
