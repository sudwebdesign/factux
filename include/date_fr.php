<?php
// TEMPS
$temps = time();

// JOURS
$jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
$jours_numero = date('w', $temps);
$jours_complet = $jours[$jours_numero];
// Numero du jour
$NumeroDuJour = date('d', $temps);


// MOIS
$mois = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai',
'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
$mois_numero = date("m", $temps);
//$mois_complet = $mois[$mois_numero];
$mois_complet = $mois[($mois_numero - 0)];//new (devient integer)

// ANNEE
$annee = date("Y", $temps);

// Affichage DATE
//echo "<p>Date : Nous sommes le <strong>$jours_complet $NumeroDuJour $mois_complet $annee</strong></p>";
echo sprintf('<strong>%s %s %s %s</strong>', $jours_complet, $NumeroDuJour, $mois_complet, $annee);

