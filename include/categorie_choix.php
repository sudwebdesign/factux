<script type="text/javascript"> 
var catego = new Array; 
var articl = new Array; 
<?php
$cartmun = (isset($article_num))?$article_num:$first_art;#not selected option admin, quel article a afficher en premier
include_once("include/config/common.php");
$sql = "SELECT * FROM `" . $tblpref ."categorie` WHERE 1";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$i=0;
$s=$sc='p0';
while($data = mysql_fetch_array($req)){
 $sql2 = "SELECT * FROM `" . $tblpref ."article` WHERE cat = $data[id_cat] and actif != 'non'";
 $req2 = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'\n'.mysql_error());
 if(mysql_num_rows($req2)){ 
  $v=0;
  $el=$elc='';
  echo "articl['p$i'] = new Array;\n";
  while($data2 = mysql_fetch_array($req2)){
   $el='';
   if ($cartmun==$data2["num"]){
    $el=$elc=' selected="selected"';
    $s='p'.$i;
   }
   $article = "$data2[article] ".montant_financier($data2["prix_htva"])." / $data2[uni]";
   if ($data2["marge"]>1)
    $article = "$data2[article] [".montant_financier($data2["prix_htva"])."] ".montant_financier($data2["prix_htva"]*$data2["marge"])." / $data2[uni]";#margé
   echo "articl['p$i']['$v'] = new Array('$data2[num]', '$article', '$el');\n";
   $v= $v+1;
  }
  echo "catego[$i] = new Array('p$i', '$data[categorie]', '$elc');\n";
  $i=$i +1;
 }
}
$j = $i ;
$sql3="SELECT * FROM `" . $tblpref ."article` WHERE cat = 0 and actif != 'non'";
$req3 = mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
if(mysql_num_rows($req3)){#divers présent(s);
 echo "articl['p$j'] = new Array;\n";
 $v=0;
 $elc='';
 while($data3 = mysql_fetch_array($req3)){
  $el='';
  if ($cartmun==$data3["num"]){
   $el=$elc=' selected="selected"';
   $s='p'.$j;
  }
  $article = "$data3[article] ".montant_financier($data3["prix_htva"])." / $data3[uni]";
  if ($data3["marge"]>1)
   $article = "$data3[article] [".montant_financier($data3["prix_htva"])."] ".montant_financier($data3["prix_htva"]*$data3["marge"])." / $data3[uni]";#margé
  echo "articl['p$j']['$v'] = new Array('$data3[num]', '$article', '$el');\n";
  $v= $v+1;
 }
 echo "catego[$j] = new Array('p$j', '$lang_divers', '$elc');\n";
}
?>
function filltheselect2(liste, choix) 
{switch (liste){ 
 case "categorie": 
  raz2("article"); 
  for (i=0; i<articl[choix].length; i++){ 
   new_option = new Option(articl[choix][i][1],articl[choix][i][0]); 
   document.formu2.elements["article"].options[document.formu2.elements["article"].length]=new_option; 
  } 
 } 
} 
function raz2(liste){
 l=document.formu2.elements[liste].length; 
 for (i=l; i>=0; i--) 
  document.formu2.elements[liste].options[i]=null;
}  
</script> 
<select name="categorie" onChange='javascript:filltheselect2(this.name, this.value)'> 
 <script type="text/javascript"> 
 for (i=0; i<catego.length; i++) 
  document.write("<option value='" +catego[i][0]+ "' " +catego[i][2]+ ">" +catego[i][1]+ "</option>"); 
 </script> 
</select> 
<br> 
<select name="article" id="article"> 
 <script type="text/javascript">
 var j='<?php echo $s; ?>'; 
 for (i=0; i<articl[j].length; i++) 
  document.write("<option value='" +articl[j][i][0]+ "' " +articl[j][i][2]+ ">" +articl[j][i][1]+ "</option>"); 
 </script>
</select>
