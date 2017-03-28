<script type="text/javascript">
var lettres = new Array;
var clients = new Array;
<?php
$sql1="SELECT SUBSTRING(nom, 1, 1)as lettre FROM `" . $tblpref ."client` WHERE actif != 'non' GROUP by SUBSTRING(nom, 1, 1)";
$req2 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while($data6 = mysql_fetch_array($req2)){
 $initiale=$data6['lettre'];
 $lettre[]=$initiale;
}

$l=0;
$selettre='p0';
foreach ($lettre as $value) {
 echo "clients['p$l'] = new Array;\n";
 $rqSql2 ="$rqSql AND `nom` LIKE '$value%'";
 $req = mysql_query($rqSql2) or die('Erreur SQL !<br>'.$rqSql2.'<br>'.mysql_error());
 $v=0;
 while($data = mysql_fetch_array($req)){
  $selec='';
  if (isset($num) && $num==$data['num_client']){//$num#from form_edit_bon/devis
   $selettre = "p$l";
   $selec = " selected='selected'";
  }
  $nom = addslashes($data['nom']);
  echo"clients['p$l']['$v']= new Array('$data[num_client]', ' $nom ',\"$selec\");\n";
  $v++;
 }
 echo "lettres[$l] = new Array( 'p$l','$value',\"$selec\");\n";
 $l++;
}
?>
function filltheselect(liste, choix){
 switch (liste){
 case "listelettres":
  raz("listeclients");
  //raz("listerue");
  for (i=0; i<clients[choix].length; i++){
   new_option = new Option(clients[choix][i][1],clients[choix][i][0]);
   document.formu.elements["listeclients"].options[document.formu.elements["listeclients"].length]=new_option;
  }
  break;
 }
}

function raz(liste){
 l=document.formu.elements[liste].length; 
  for (i=l; i>=0; i--) 
   document.formu.elements[liste].options[i]=null;
}    
</script>
 
<select id="cluster" name="listelettres" 
        onChange='javascript:filltheselect(this.name, this.value)'> 
   <script type="text/javascript"> 
   for (i=0; i<lettres.length; i++) 
      document.write("<option value='" +lettres[i][0]+ "'" +lettres[i][2]+ ">" +lettres[i][1] + "</option>"); 
   </script> 
</select>

<select id="cluster2" name="listeclients" 
        onChange='javascript:filltheselect(this.name, this.value)'> 
   <script type="text/javascript"> 
   for (i=0; i<clients["<?php echo $selettre; ?>"].length; i++) 
      document.write("<option value='" +clients["<?php echo $selettre; ?>"][i][0]+ "'" +clients["<?php echo $selettre; ?>"][i][2]+ ">" +clients["<?php echo $selettre; ?>"][i][1] + "</option>"); 
   </script> 
</select>
