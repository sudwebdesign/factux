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
 */

include_once("nb.php");
include_once("date.php");
include_once("graphisme.php");
function naviguer($ou,$mois_1,$annee_1,$titre, $style="color:#ffffff;text-decoration:none;"){#lister_* caption's
 $adresse = $ou.'&amp;mois_1=';
 $an = '&amp;annee_1=';
 $m=$d=$n=$f=0;
 if($mois_1==1){
  $m=12;
  $d=1;
 }
 if($mois_1==12){
  $n=-12;
  $f=1;
 }
 $style = '" style="'.$style;
 global $lang_toutes;
 global $lang_tous;
 if ($annee_1==$lang_toutes){$dan=$annee_1;$fan=$annee_1;}else{$dan=($annee_1-$d);$fan=($annee_1+$f);}#an protect word
?><?php if ($annee_1!=$lang_toutes): ?>
     <a href="<?php echo $adresse.$mois_1.$an.($annee_1-1).$style; ?>" title="Ann�e Precedente">&laquo;<?php echo ($annee_1-1);#◄◄ ?></a>
     &nbsp;&nbsp;<?php endif; if ($mois_1!=$lang_tous): ?>
     <a href="<?php echo $adresse.($m+$mois_1-1).$an.$dan.$style; ?>" title="Mois Precedent">&lt;<?php printf("%02d", ($m+$mois_1-1));#◄ ?></a>
     &nbsp;&nbsp;<?php endif; ?>
     <?php echo $titre." (".(($mois_1!=$lang_tous)?sprintf("%02d",$mois_1):$mois_1)."/$annee_1)"; ?>
     &nbsp;&nbsp;<?php if ($mois_1!=$lang_tous): ?>
     <a href="<?php echo $adresse.($n+$mois_1+1).$an.$fan.$style; ?>" title="Mois Suivant"><?php printf("%02d", ($n+$mois_1+1));#► ?>&gt;</a>
     &nbsp;&nbsp;<?php endif; if ($annee_1!=$lang_toutes): ?>
     <a href="<?php echo $adresse.$mois_1.$an.($annee_1+1).$style; ?>" title="Ann�e Suivante"><?php echo ($annee_1+1);#►► ?>&raquo;</a>
<?php endif; ?>
<?php
}
