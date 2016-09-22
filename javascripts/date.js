<script type="text/javascript" LANGUAGE="JavaScript">
<!-- debut du script
   var csChaine;
   var nDay, nJour, nMois, nAnnee;
   var dtJour;
  	var NomMois = new Array   (<?php   $calendrier = calendrier_local_mois3 ();
	
foreach ($calendrier as $numero_mois => $nom_mois)
{
echo"'";
echo ucfirst($nom_mois);
echo"'";
echo","; 
	}
	$calendrier = calendrier_local_mois2 ();
foreach ($calendrier as $numero_mois => $nom_mois)	{
echo"'";
echo ucfirst($nom_mois);
echo"'";
}
	?>
   );
   var NomJour = new Array(<?php 
	 $calendrier = calendrier_local_jour ();
foreach ($calendrier as $numero_jour => $nom_jour)	{
echo"'";
echo ucfirst($nom_jour);
echo"',";
}
$calendrier = calendrier_local_jour2 ();
foreach ($calendrier as $numero_jour => $nom_jour)	{
echo"'";
echo ucfirst($nom_jour);
echo"'";
}
 ?> );
   csChaine = " ";
   dtJour   = new Date();
   nDay     = dtJour.getDay();
   nJour    = dtJour.getDate();
   nMois    = dtJour.getMonth() ;
   nAnnee   = dtJour.getYear();
   csChaine += " " + NomJour[nDay]  + " ";
   csChaine += nJour;
   csChaine += " " + NomMois[nMois] + " ";

   if (nAnnee <= 199) nAnnee += 1900;
           csChaine += nAnnee + " ";
   document.write( csChaine );
// fin du script -->
</script>