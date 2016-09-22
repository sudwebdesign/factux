<script type="text/javascript"> 
var pays = new Array; 
var ville=new Array;

<?php 
$sql1="SELECT SUBSTRING(nom, 1, 1)as lettre FROM `" . $tblpref ."client` WHERE actif != 'non'GROUP by SUBSTRING(nom, 1, 1)";
$req2 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while($data6 = mysql_fetch_array($req2)){	 
$initiale=$data6['lettre'];
$lettre[]=$initiale;
}

$l=0;
foreach ($lettre as $value) {
 echo"pays[$l] = new Array( \"p$l\",\"$value\");";
 echo"ville[\"p$l\"] = new Array;";  
	 $rqSql2 ="$rqSql AND `nom` LIKE '$value%'";
	 $req = mysql_query($rqSql2) or die('Erreur SQL !<br>'.$rqSql2.'<br>'.mysql_error());
	 $v=0;
	 	 while($data = mysql_fetch_array($req))
{

$nom=  addslashes($data['nom']);
echo"ville[\"p$l\"][\"$v\"]= new Array(\"$data[num_client]\", \" $nom \");";

$v=$v+1;
}
	 	$l=$l+1;	 
     }
 ?>  
function filltheselect(liste, choix) 
{switch (liste) 
   { 
   case "listepays": 
      raz("listeville"); 
      //raz("listerue"); 
      for (i=0; i<ville[choix].length; i++) 
         { 
         new_option = new Option(ville[choix][i][1],ville[choix][i][0]); 
         document.formu.elements["listeville"].options[document.formu.elements["listeville"].length]=new_option; 
         } 
      
      break; 
      } 
} 

function raz(liste) 
{l=document.formu.elements[liste].length; 
for (i=l; i>=0; i--) 
   document.formu.elements[liste].options[i]=null;
}    
</script> 
 
<select class="OPTION" ID="cluster" name="listepays" onChange='javascript:filltheselect(this.name, this.value)'> 
   <script type="text/javascript"> 
   for (i=0; i<pays.length; i++) 
      document.write("<option value=\"" +pays[i][0]+ "\">" +pays[i][1]); 
   </script> 
</select> 

<select class="OPTION" ID="cluster2"name="listeville" onChange='javascript:filltheselect(this.name, this.value)'> 
   <script type="text/javascript"> 
   for (i=0; i<ville["p0"].length; i++) 
      document.write("<option value=\"" +ville["p0"][i][0]+ "\">" +ville["p0"][i][1]); 
   </script> 
</select> 
