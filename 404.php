<!DOCTYPE html>
<html>
<head>
<title>404 ERROR</title>
<link rel="stylesheet" href="knacss-unminified.css"/>
<style>
body {
background: url('background.jpg') repeat;
}
#abs {
	width: 100%;
	text-align: justify;
position: absolute;
top: 20%;
}
.center {
	width: 600px;
}
</style>
</head>
<body>
<?php header( "Refresh:5; url=https://app.cvlcondorcet.fr", true, 303); ?>
<div id="abs">
<div class="center"> 
<h1>Page non trouvée</h1><h2>Erreur 404</h2>
<p>Vous avez dû ou essayé de contourner le système, cher·ère utilisateur·rice <?php echo $_SERVER['REMOTE_ADDR']; ?>. Vous allez être redirigé·e</p>
<h4>Merci de votre visite, cordialement, le Webmaster</h4>
</div>
</div>
</body>
</html>