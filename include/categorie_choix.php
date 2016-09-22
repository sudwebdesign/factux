<?php 
$euro= '€';
//$devise = ereg_replace('&euro;', $euro, $devise);
 ?> 
<script type="text/javascript"> 
var catego = new Array; 
var articl=new Array; 
<?php
 include_once("include/config/common.php");
 $sql = "SELECT * FROM `" . $tblpref ."categorie` WHERE 1";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $i=0;
 while($data = mysql_fetch_array($req)){
 
 echo"catego[$i] = new Array(\"p$i\", \"$data[categorie]\");\n";
 
 
 $sql2="SELECT * FROM `" . $tblpref ."article` WHERE cat = $data[id_cat] and actif != 'non'";
 
 $req2 = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'\n'.mysql_error());
 $v=0;
 echo"articl[\"p$i\"] = new Array;\n";
 while($data2 = mysql_fetch_array($req2)){
 $article=  addslashes($data2['article']);
 echo"articl[\"p$i\"][\"$v\"] = new Array(\"$data2[num]\", \"$article $data2[prix_htva] $devise / $data2[uni] \");\n";
 $v= $v+1;
 }
 $i=$i +1;
 }
 $j = $i ;
 echo"catego[$j] = new Array(\"p$j\", \"divers\");\n";
 echo"articl[\"p$j\"] = new Array;\n";
 $sql3="SELECT * FROM `" . $tblpref ."article` WHERE cat = '0' and actif != 'non'";
 $req3 = mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'\n'.mysql_error());
 $v=0;
 while($data3 = mysql_fetch_array($req3)){
 echo"articl[\"p$j\"][\"$v\"] = new Array(\"$data3[num]\", \"$data3[article] $data3[prix_htva] $devise / $data3[uni] \");\n";
 $v= $v+1;
 }
 ?>


function filltheselect2(liste, choix) 
{switch (liste) 
   { 
   case "categorie": 
      raz2("article"); 
      
      for (i=0; i<articl[choix].length; i++) 
         { 
         new_option = new Option(articl[choix][i][1],articl[choix][i][0]); 
         document.formu2.elements["article"].options[document.formu2.elements["article"].length]=new_option; 
         } 
      
   
   } 
} 

function raz2(liste) 
{l=document.formu2.elements[liste].length; 
for (i=l; i>=0; i--) 
   document.formu2.elements[liste].options[i]=null;
}    
</script> 


<select  name="categorie" onChange='javascript:filltheselect2(this.name, this.value)'> 
   <script type="text/javascript"> 
   for (i=0; i<catego.length; i++) 
      document.write("<option value=\"" +catego[i][0]+ "\">" +catego[i][1]); 
   </script> 
	 
</select> 
<br> 

<select  name="article" > 
   <script type="text/javascript"> 
   for (i=0; i<articl["p0"].length; i++) 
      document.write("<option value=\"" +articl["p0"][i][0]+ "\">" +articl["p0"][i][1]); 
   </script>
	  
</select> 

