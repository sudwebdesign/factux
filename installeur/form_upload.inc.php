<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">

<form enctype="multipart/form-data" action="upload.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Transfère le fichier <input type="file" name="monfichier" />
<input type="submit" value="envoyer"/>
</form>
<?php echo "<br><p>Veuillez introduire votre logo. <br>Celui-ci doit obligatoirement etre au format jpg et son nom ne doit contenir ni espace ni point.<br>(exemple logo.jpg mais pas mon logo.jpg)<hr>";