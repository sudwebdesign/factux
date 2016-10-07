<?php
if ($lot == 'y') { 
echo"<script language=\"javascript\" src=\"include/themes/$theme/menu_lot.js\" type=\"text/javascript\"></script>";  
}else
echo"<script language=\"javascript\" src=\"include/themes/$theme/menu.js\" type=\"text/javascript\"></script>";
?> 
<div id="conteneurmenu" style="margin-top: 24px;">
<script language="Javascript" type="text/javascript">
preChargement();
</script>
 <p id="menu1" class="menu" onmouseover="MontrerMenu('ssmenu1');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu1');"><?php echo $lang_devis_pluriel; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu1" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_dev != 'n') { ?>
  <li><a href="form_devis.php"><?php echo $lang_creer ?><span>&nbsp;:</span></a></li>
  <li><a href="lister_devis.php"><?php echo $lang_lister ?><span>.</span></a></li>
  <li><a href="chercher_devis.php"><?php echo $lang_cherc ?><span>.</span></a></li>
  <li><a href="devis_non_commandes.php"><?php echo $lang_non_com ?><span>.</span></a></li>
<?php } ?>
 </ul>
 <p id="menu2" class="menu" onmouseover="MontrerMenu('ssmenu2');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu2');"><?php echo $lang_commandes; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu2" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_com != 'n') { ?>
  <li><a href="form_commande.php"><?php echo $lang_creer ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_commandes.php"><?php echo $lang_lister ?><span>&nbsp;;</span></a></li>
  <li><a href="chercher_commandes.php"><?php echo $lang_cherc ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_commandes_non_facturees.php"><?php echo $lang_non_facu ?><span>&nbsp;;</span></a></li>
<?php } ?>
 </ul>
 <p id="menu3" class="menu" onmouseover="MontrerMenu('ssmenu3');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu3');"><?php echo $lang_factures; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu3" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_fact != 'n') { ?>
  <li><a href="form_facture.php"><?php echo $lang_creer ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_factures.php"><?php echo $lang_lister ?><span>.</span></a></li>
  <li><a href="chercher_factures.php"><?php echo $lang_cherc ?><span>.</span></a></li>
  <li><a href="lister_factures_non_reglees.php"><?php echo $lang_non_reg ?><span>.</span></a></li>
  <li><a href="form_multi_facture.php"><?php echo $lang_fact_multi ?><span>&nbsp;;</span></a></li>
  <li><a href="oneclick.php"><?php echo $lang_imp_multi ?><span>&nbsp;;</span></a></li>
<?php } ?>
 </ul>
 <p id="menu4" class="menu" onmouseover="MontrerMenu('ssmenu4');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu4');"><?php echo $lang_depenses; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu4" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_dep != 'n') { ?>
  <li><a href="form_depenses.php"><?php echo $lang_creer ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_depenses.php"><?php echo $lang_lister ?><span>&nbsp;;</span></a></li>
  <li><a href="chercher_depenses.php"><?php echo $lang_cherc ?><span>&nbsp;;</span></a></li>
<?php if ($user_stat != 'n') { ?>
  <li><a href="graph_depense.php"><?php echo $lang_depenses_par_fournisseur; ?><span>&nbsp;;</span></a></li>
  <li><a href="graph_depenses.php"><?php echo $lang_depenses_par_fournisseur_mois; ?><span>&nbsp;;</span></a></li>
<?php } }# ?>
 </ul>
 <p id="menu5" class="menu" onmouseover="MontrerMenu('ssmenu5');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu5');"><?php echo $lang_articles; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu5" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_art != 'n') { ?>
  <li><a href="form_article.php"><?php echo $lang_creer ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_articles.php"><?php echo $lang_lister ?><span>&nbsp;;</span></a></li>
<?php if ($use_categorie =='y') { ?>
  <li><a href="lister_cat.php"><?php echo $lang_categorie ?>s<span>&nbsp;;</span></a></li>
<?php  } ?>
<?php } ?>
 </ul>
 <p id="menu6" class="menu" onmouseover="MontrerMenu('ssmenu6');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu5');"><?php echo $lang_clients; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu6" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_cli != 'n') { ?>
  <li><a href="form_client.php"><?php echo $lang_creer ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_clients.php"><?php echo $lang_lister ?><span>&nbsp;;</span></a></li>
<?php } ?>
 </ul>
 <p id="menu8" class="menu" onmouseover="MontrerMenu('ssmenu8');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu8');"><?php echo $lang_outils; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu8" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_admin == 'y'){ ?>
  <li><a href="form_utilisateurs.php"><?php echo $lang_aj_utl ?><span>&nbsp;;</span></a></li>
  <li><a href="lister_utilisateurs.php"><?php echo $lang_list_utl ?><span>&nbsp;;</span></a></li>
  <li><a href="form_mailing.php"><?php echo $lang_infolettre ?><span>&nbsp;;</span></a></li>
  <li><a href="form_backup.php"><?php echo $lang_back_men ?><span>&nbsp;;</span></a></li>
  <li><a href="admin.php"><?php echo $lang_administra ?><span>&nbsp;;</span></a></li>
<?php } ?>
  <li><a href="include/calculette.html" onclick="window.open('','popup','width=300,height=220,top=200,left=150,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0')" target="popup"><?php echo $lang_calculette; ?><span>&nbsp;;</span></a></li>
  <li><a href="logout.php"><?php echo $lang_sortir ?><span>&nbsp;;</span></a></li>
 </ul>
 <p id="menu7" class="menu" onmouseover="MontrerMenu('ssmenu7');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu7');"><?php echo $lang_statistiques; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu7" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_stat != 'n') { ?>
  <li><a href="graph_annuel.php"><?php echo $lang_annuelles ?> <span>&nbsp;</span></a></li>
  <li><a href="graph_tva.php"><?php echo $lang_tva; ?><span>&nbsp;;</span></a></li>
  <li><a href="graph_ca_clients.php"><?php echo $lang_ca_cli ?><span>.</span></a></li>
  <li><a href="graph_ca_clients_mois.php"><?php echo $lang_cli_moi ?><span>.</span></a></li>
  <li><a href="graph_ca_client.php"><?php echo $lang_moi_cli ?><span>.</span></a></li>
  <li><a href="graph_article.php"><?php echo $lang_stat_art ?><span>.</span></a></li>
  <li><a href="graph_depense.php"><?php echo $lang_depenses_par_fournisseur; ?><span>.</span></a></li>
  <li><a href="graph_depenses.php"><?php echo $lang_depenses_par_fournisseur_mois; ?><span>&nbsp;</span></a></li>
<?php } ?>
 </ul>
<?php if ($lot == 'y') { ?>
 <p id="menu9" class="menu" onmouseover="MontrerMenu('ssmenu9');" onmouseout="CacherDelai();">
  <a href="#" onfocus="MontrerMenu('ssmenu9');"><?php echo $lang_lots; ?><span>&nbsp;:</span></a>
 </p>
 <ul id="ssmenu9" class="ssmenu" onmouseover="AnnulerCacher();" onmouseout="CacherDelai();">
<?php if ($user_fact != 'n') { ?>
  <li><a href="form_lot.php"><?php echo $lang_creer; ?><span>.</span></a></li>
  <li><a href="lister_lot.php"><?php echo $lang_lister; ?><span>&nbsp;</span></a></li>
  <li><a href="chercher_lots.php"><?php echo $lang_cherc; ?><span>.</span></a></li>
<?php } ?>
 </ul>
<?php } ?> 
</div>
<div id="texte"></div>
<script language="Javascript" type="text/javascript">
centrer_menu=true;Chargement();
//window.onresize=function(event){centrer_menu=true;Chargement();};//Never override the window.onresize function or native js functions
window.addEventListener('resize', function(event){centrer_menu=true;Chargement();})//(cela se ressent en rapidité) http://stackoverflow.com/questions/641857/javascript-window-resize-event
</script>
