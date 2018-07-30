<!DOCTYPE html>
<html>
<head>
<title>403 ERROR</title>
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
h1 , h2 {
	text-transform: upper-case;
}
</style>
</head>
<body>
<div id="abs">
<div class="center"> 
<h1>Accès Interdit</h1><h2>Erreur 403</h2>
<p>Bonjour cher·ère utilisateur·rice, vous avez demandé le fichier &laquo; <?php echo $_SERVER['REQUEST_URI']; ?> &raquo;. L'accès à ce fichier vous a malheureusement été refusé. En effet, vous avez provoqué une <strong>erreur 403</strong> du serveur.<br/><br/> Je vous invite à aller relire nos conditions générales d'utilisations (<a href="https://app.cvlcondorcet.fr/mentions">ici</a>) afin de vous familiariser avec la loi et le fait que ce travail est protégé par le droit d'auteur. <br/><br/>Soyez au courant que des poursuites pénales se pourraient d'être engagées contre vous. Vous vous êtes connecté·e avec les identifiants ci-dessous : IP address <?php echo $_SERVER['REMOTE_ADDR']; ?> sur le port <?php echo $_SERVER['REMOTE_PORT']; ?>. RESOLVED IP <?php echo $_SERVER['REMOTE_HOST']; ?> HTTP HEAD <?php echo $_SERVER['HTTP_USER_AGENT']; ?> </p> 
<h4>Merci de votre visite, cordialement, le Webmaster</h4>
</div>
</div>
</body>
</html>