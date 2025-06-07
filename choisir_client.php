<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: choisir_client.php
 * 	choix des client pour utilisateurs restreinds
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$login=isset($_POST['login'])?$_POST['login']:"";
//on recupere le num user
$sql = "SELECT num FROM " . $tblpref ."user WHERE login = '".$login."'";
$result = mysql_query($sql) or die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql).mysql_error()."</p>");
$num_user = mysql_result($result, 0);
$num_user_vir = $num_user . ',' ;
//on extrait les variables du select multiple
$nbr_li = isset($_POST['client'])?count($_POST['client']):0;#si vide = notice
$message=($nbr_li)?sprintf('<h2>%s</h2>', $lang_suite_edit_utilisateur_succes):sprintf('<h1>%s</h1>', $lang_au_cli_choi);
for($i=0;$i<=($nbr_li - 1);$i++){
 //on trouve le contenu actuel de permi
 $num_client = $_POST['client'][$i];
 $sql3 = "SELECT permi FROM " . $tblpref ."client WHERE num_client = '".$num_client."'";
 $result = mysql_query($sql3) or die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql3).mysql_error()."</p>");
 $permi_av = mysql_result($result, 0);
 $permi = $permi_av . $num_user_vir;
 //on introduit les variables dans la base
 $sql2 = "UPDATE " . $tblpref .sprintf("client SET permi='%s' WHERE num_client = '", $permi).$num_client."'";
 mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
}

include_once(__DIR__ . "/edit_utilisateur.php");
