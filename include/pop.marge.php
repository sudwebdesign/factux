<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2015 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 * 		http://factux.free.fr
 * 
 * File Name: pop.marge.php
 * 
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 * 
 * File Authors:
 *  Thomas Ingles
 *.
 */


/**
 ---------------------------------------------------------------------------------------------
 * Le reste du code PHP, à priori, y'a plus besoin de le toucher. Par contre, y'a la CSS juste
 * un peu plus bas. Celle-là est parfaitement modifiable (c'est d'ailleurs recommandé, c'est
 * toujours mieux de personnaliser un peu le truc)
 */
ini_set('session.save_path', '../include/session');
session_cache_limiter('private'); 
session_start();

$frm = $_GET["frm"];
$champ = $_GET["ch"];
$link = "?frm=".$frm."&amp;ch=".$champ;

$ro = ($frm=="article_edit")?' readonly="readonly"':'';#tva in edit_art.php

#init default
$prix_achat=$tv=0;
$coef=$coefttc=1;
$marge=0;#.00000000000001;#coef de marge = 1
$tauxmarge=0;
#set
if (isset($_POST["pa"])){
 $prix_achat = $_POST["pa"];
 $marge = $_POST["ma"];
 $tv = $_POST["tv"];
}else{
 if (isset($_GET["pa"])){
  $prix_achat = round($_GET["pa"],3);
  $marge = round($_GET["ma"],3);
  $tv = round($_GET["tv"],3);
 }
}
#calc
if($marge!=0){
 if($marge>=100)#La division par zéro est indéfinie
  $marge=99.999;
 $coef = (1/(1-($marge/100)));
 $tauxmarge = (1-(1/$coef))*100;#%
}
$coefttc=((1+($tv/100))/(1-($marge/100)));#
$prix_vente_ht = $prix_achat * $coef;
$tva = $prix_vente_ht * ($tv/100);
$prix_vente_ttc = $prix_vente_ht + $tva;
$prix_vente_ttc2 = $prix_achat * $coefttc;
#rounded
 $coef = round($coef,3);
 $tauxmarge = round($tauxmarge,3);#%
 $coefttc = round($coefttc,3);#
 $prix_vente_ht = round($prix_vente_ht,3);
 $tva = round($tva,3);
 $prix_vente_ttc = round($prix_vente_ttc,3);
 $prix_vente_ttc2 = round($prix_vente_ttc2,3);
#*in lang
include('config/var.php');#$devise
$lang=(!empty($_SESSION['lang']))?$_SESSION['lang']:'fr';
//~ $lang_prix = "Prix";#*
//~ $lang_htva = "H.T.";#*
//~ $lang_ttc = "T.T.C.";#*
//~ $lang_tva = "T.V.A.";#*
//~ $lang_marge = "marge";#*
//~ $lang_de = "de";#*
//~ $lang_prixunitaire = "Prix unitaire";#*
//~ $lang_dachat = "d'achat";#*
//~ $lang_de_vente = "de vente";#*
include_once("language/$lang.php");

$lang_coef = "Coef";


$lang_prixunitaire_ht = "$lang_prixunitaire $lang_htva";
$lang_prix_dachat_ht = "$lang_prix $lang_dachat $lang_htva";
$lang_prix_vente_ht = "$lang_prix $lang_de_vente $lang_htva";
$lang_prix_vente_ttc = "$lang_prix $lang_de_vente $lang_ttc";
$lang_coef_ht = "$lang_coef $lang_htva";
$lang_coef_ttc = "$lang_coef $lang_ttc";
$lang_prix_ht = "$lang_prix $lang_htva";
$lang_retour_marge = "$lang_envoyer un $lang_prix_vente_ht $prix_vente_ht$devise avec une $lang_marge $lang_de $tauxmarge%";
$lang_retour_marge_title = "$lang_envoyer le $lang_prix $lang_dachat $lang_de $prix_achat$devise et la $lang_marge $lang_de $tauxmarge%";
?>
<!DOCTYPE HTML>
<html>
<head>
 <title><?php echo $lang_marge; ?></title>
 <meta charset="utf-8">
 <style>
  body, table, select {
   font-family: Arial;
   font-size: 11px;
   padding:0;
   margin:0;
  }
  body {
   z-index:0;
  }
i{cursor:pointer;}
#sexy,#nue,#sex{transition: opacity 1s;}
.sexy,.nue,.sex{
	background-size: cover;
	background-position: top left;
	background-repeat: no-repeat;
	background-attachment: fixed;
}
.sexy{background-image: url("../image/marge-sexy.gif");}
.sex{background-image: url("../image/marge-sex.3.gif");}
.nue{background-image: url("../image/marge-nue.gif");}

#bg-ios{/*for old webkit ios not bg-attach on body tag*/
	/*background-image: url("../image/marge-sexy.gif");*/
	opacity:0;
	transition: opacity 7s;
	background-position: top left;
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;
	width:100%;
	height: 100%;
	top:0;
	left:0;
	position:fixed;
	z-index:-1;
}

  #marge {
   width: 100%;
   border-collapse: collapse;
   margin: 0;
   padding: 0;
   font-size: 110%;
  }
  #marge td {
   margin: 0;
   padding: 0;
  }
  #marge td a {
   display: block;
   text-decoration: none;
   color: #009900;
   text-align: center;
   border: 1px solid #999999;
   background: rgba(0, 255, 0, 0.69);
  }
  #marge td a:hover {
   background-color: #E99042;
   color: #006600;
  }
  #marge p {
   color: #009900;
   text-align: right;
  }
  #egram {
   width: 100%;
   margin: 0;
   background: rgba(255, 255, 255, 0.69);
  }

  #egram input{
   width: 26.18%;
   margin: 0;
   padding: 0;
  }
  #egram input[name="pa"]{
   width: 49.3%;
  }
 </style>
</head>
<body class="sexy">
<form name="egram" id="egram" method="post" action="<?php echo $link; ?>">
 <table id="marge">
  <tr>
   <td title="<?php echo $lang_prix_dachat_ht; ?>">
    <b><?php echo $lang_prix_ht; ?>:</b>
    <input name="pa" onChange="reload(this.form)" id="pa" value="<?php echo $prix_achat; ?>" size="13" maxlength="13" />
   </td>
   <td><b><?php echo $lang_tva; ?>:</b><input name="tv" id="tv" onChange="reload(this.form)" value="<?php echo $tv; ?>" size="5" maxlength="6"<?php echo $ro; ?> />%</td>
   <td><b><?php echo $lang_marge; ?>:</b><input name="ma" id="ma" onChange="reload(this.form)" value="<?php echo $marge; ?>" size="5" maxlength="6" />%</td>
  </tr>
  <tr>
   <td title="<?php echo $lang_prix_vente_ht; ?>"><b><?php echo $lang_htva; ?>:</b><?php echo $prix_vente_ht.$devise; ?></td>
   <td title="<?php echo $lang_tva; ?>"><!--<b><?php echo $lang_tva; ?></b>--><?php echo $tva.$devise; ?></td>
   <td title="<?php echo $lang_prix_vente_ttc; ?>"><b><?php echo $lang_ttc; ?>:</b><?php echo $prix_vente_ttc.$devise; ?></td>
  </tr>
  <tr>
   <td title="<?php echo $lang_retour_marge_title; ?>" colspan="3">
    <a href="#" onClick="submitmarge(<?php echo $coef; ?>)"><?php echo $lang_retour_marge; ?><br /><b><?php echo $lang_coef_ht; ?>: </b><?php echo $coef; ?></a>
   </td>
  </tr>
  <tr>
   <td title="<?php echo $lang_prix_vente_ht; ?>"><b><?php echo $lang_htva; ?></b>:<?php echo $prix_vente_ht.$devise; ?></td>
   <td title="<?php echo $lang_coef_ttc; ?>"><b><?php echo $lang_coef_ttc; ?></b>:<?php echo $coefttc; ?></td>
   <td title="<?php echo $lang_prix_vente_ttc; ?>"><b><?php echo $lang_ttc; ?></b>:<?php echo $prix_vente_ttc2.$devise; ?></td>
  </tr>
  <tr>
   <td colspan="3">
    <p id="sexy">
     Un coef de <i onClick="margesex('sex',270,1);" title="En Voir Plus">marge</i> 30% se calcule ici avec la formule :<br />
     1/(1-0,30) [0.30 = 30%] = 1,429<br />
     Elle sert en général a trouver le prix de vente TTC<br />par une simple multiplication.<br />
     Sauf qu'ici elle sert a trouver le "prix unitaire" de vente HT pour Factux.</p>
     <br />
     <br />    <br />
     <p id="sex" style="opacity:0;">Une <i onClick="margesex('nue',600,1);" title="En SaVoir Plus">Marge comme ça,</i> j'aime.</p>
     <br />    <br />
     <br />
     <p>
     Le coef de <i onClick="margenue('nue',600,1);" title="Voir marge nue">marge</i> est utilisé afin de<br /> 
     récupérer la TVA déboursé a l'achat du/des produit/s.<br />
     Pour ainsi l'inclure dans le prix de vente<br />Toutes TAXEs Comprises des acheteurs finaux.<br />
     D'ailleur voici la formule pour trouver le coef de <i onClick="margenue('sex',600,1);" title="Voir marge sexy">marge</i> courrament usité :
     </p>
     <?php echo $lang_prix_dachat_ht; ?> : 10<?php echo $devise; ?><br />
     Taxe <?php echo $lang_dachat; ?> (<?php echo $lang_tva; ?>) : 5,5%<br />
     <?php echo ucfirst($lang_marge); ?> souhaité : 16%<br />
     <?php echo $lang_coef; ?>: ((1+0.055)/(1-0.16)) = 1,256<br />
     <?php echo $lang_prix_vente_ttc; ?>: 10 x 1,256 = 12,56<?php echo $devise; ?><br />
     <hr />
     Méthode Factux<br />
     <?php echo $lang_coef; ?>: (1/(1-0.16)) = 1,19<br />
     <?php echo $lang_prixunitaire_ht; ?>: 10 x 1,19 = 11,90<?php echo $devise; ?><br />
     TAXE / la Voleur Ajouter: 11,90 x 0,055 = 0,66<br />
     <?php echo $lang_prix_vente_ttc; ?>: 11,90 + 0,66 = 12,56<?php echo $devise; ?><br />
     <hr />
     <p id="nue" style="opacity:0;">Cela revient au même au final (question d'arrondis) la <i onClick="margesex('sexy',160,1);" title="Réhabillé marge">marge</i> est toujours respecté, ainsi que la récupération de la TVA déboursé a nos fournisseurs.</p>
     <br /><br /><hr />
   </td>
  </tr>
  <tr>
  </tr>
 </table>
</form>

<script type="text/javascript">
 /**
  * Reload la fenêtre en soumettant le formulaire
  *
  * @param   object   frm  L'object document du formulaire
  */
 function reload(frm){
  frm.submit();
/*
//non testé, juste transformé du php en js, doit être proche de fonctionner. Thomas
  var prix_achat = frm.elements["pa"];
  var marge = frm.elements["ma"];
  var tv = frm.elements["tv"];
//calc
if(marge.value!=0){
 if(marge.value>=100)//La division par zéro est indéfinie
  marge.value=99.999;
 var coef = (1/(1-(marge.value/100)));
 var tauxmarge = (1-(1/coef))*100;
}
var coefttc=((1+(tv.value/100))/(1-(marge.value/100)));
var prix_vente_ht = prix_achat.value * coef;
var tva = prix_vente_ht * (tv.value/100);
var prix_vente_ttc = prix_vente_ht + tva;
var prix_vente_ttc2 = prix_achat.value * coefttc;
//var p = parseFloat(FLOATVAR).toFixed(2);//arrondir a deux décimale
*/
 }
 /**
  * Créé la string de retour et la renvoie à la page d'appel
  *
  * C'est ici que le champ du formulaire de la page d'appel reçoit la valeur de retour.
  * La fenêtre s'auto-fermera ensuite toute seule comme une grande.
  *
  * Paisible est l'étudiant qui comme la rivière peut suivre son cours sans quitter son lit...
  *
  * @param   integer  taux  Le taux de marge ht
  */
 function submitmarge(val){
  //assignation des variables
  var <?php echo $champ; ?> = window.opener.document.<?php echo $frm.".elements['".$champ."']"; ?>;
  var prixvente = window.opener.document.<?php echo $frm ?>.elements['prixvente'];
  var tauxmarge = window.opener.document.<?php echo $frm ?>.elements['tauxmarge'];
  var prix = window.opener.document.<?php echo $frm; ?>.elements['prix'];
  //Écrire les nouvelles valeurs 
  <?php echo $champ; ?>.value = val;
  prixvente.value = '<?php echo $prix_vente_ht.$devise; ?>';
  tauxmarge.value = '<?php echo  $tauxmarge; ?>%';
  prix.value =  <?php echo $prix_achat; ?>;
  /**/
  if(val==1){
   <?php echo $champ; ?>.size = "<?php echo ($ro!='')?20:7; ?>";
   prixvente.type = "hidden";
   tauxmarge.type = "hidden";
  }else{
   <?php echo $champ; ?>.size = "3";
   prixvente.type = "text";
   tauxmarge.type = "text";
  }
<?php if ($frm=="newart"){?> 
  window.opener.document.<?php echo $frm; ?>.elements['taux_tva'].value = document.egram.elements['tv'].value;
<?php } ?>
/* \/1 4 memory only
  window.opener.document.<?php echo $frm.".elements['".$champ."']"; ?>.value = val;
  window.opener.document.<?php echo $frm.".elements['prixvente'].value = '".$prix_vente_ht.$devise; ?>';
  window.opener.document.<?php echo $frm.".elements['tauxmarge'].value = '".$tauxmarge; ?>%';
  window.opener.document.<?php echo $frm.".elements['prix'].value = ".$prix_achat; ?>;
*/
  window.close();
 }
//animarge
 function margesex(c,h,o){
  window.innerHeight=h;//alert(window.innerHeight);
  var suggere = document.body.childNodes[document.body.childNodes.length-2];//alert(suggere.className);//!\ IS \i// document.getElementById("bg-ios")
  suggere.style['opacity'] = o;
  setTimeout(function(){
   document.getElementById(c).style['opacity'] = o;
   suggere.style['opacity'] = 0;
   document.body.className = c;//si commenté , elle se réhabille tjrs (*)
  }, 7000);
  suggere.className = c;//alert(suggere.className);

	//4 memory only
	//document.body.style.background = "#ffffff url('../image/marge-sex.1.gif') no-repeat top left fixed";
	//document.body.style['background-size'] = "cover";
	//document.body.className = "nue";
	//suggere.style['transition'] = "linear opacity 7s";
	//document.body.className = "nue";
 }
 function margenue(c,h,o){
  var bg = document.getElementById("bg-ios");
  var bd = window.document.body;
//  bd.className = c;// commenté, reviens au bg original +  si (*) commenté elle se réhabille tjrs
  bg.className = c;
  bg.style['z-index']=2;
  bg.style['opacity'] = o
  setTimeout(function(){
   bg.style['opacity'] = 0;
   setTimeout(function(){
    bg.style['z-index']=-1;
    //margesex(c,h,o);
   }, 7000);
  }, 13000);
 }
</script>
<div id="bg-ios" class="sexy"></div>
</body>
</html>
