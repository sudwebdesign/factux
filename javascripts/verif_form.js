<script type="text/javascript">
<!--
function verif_formulaire()
{
 if(document.artice.article.value == "")  {
   alert("Veuillez entrer un nom d'article!");
   document.artice.article.focus();
   return false;
  }if(document.artice.uni.value == "") {
   alert("Veuillez entrer une unité!");
   document.artice.uni.focus();
   return false;
  }
 if(document.artice.prix.value == "") {
   alert("Veuillez entrer un prix!");
   document.artice.prix.focus();
   return false;
  }
 if(document.artice.taux_tva.value == "") {
   alert("Veuillez entrer un taux de tva!");
   document.artice.taux_tva.focus();
   return false;
  }
 }
//-->
</script>