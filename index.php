<?php 
require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$request = $bdd->query('SELECT * FROM '.TABLE_GENERAL.' WHERE name = "emergency" ');
	if ($request->rowCount() == 1) {
		$test = $request->fetch();
	} else {
		$test = array('value' => 'NORMAL');
	}
if ($test['value'] == 'NORMAL') {
session_start();
$liste = ["name", "adresse", "cover", "adresse", "color", "categories"];
foreach ($liste as $key => $value) {
	$request = $bdd->prepare("SELECT * FROM " . TABLE_GENERAL . " WHERE name = :id");
	$request->bindParam(":id", $value);
	if ($request->execute()) {
		$row = $request->fetch();
	} else { $row['value'] = ""; }
	$_SESSION[$value] = $row['value'];
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="https://app.cvlcondorcet.fr">
		<meta charset="utf-8"/>
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="knacss-unminified.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cvlcondorcet.fr/ckeditor/plugins/slideshow/3rdParty/fancybox2/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script>
		<script src="https://cvlcondorcet.fr/ckeditor/plugins/slideshow/3rdParty/jquery.min.js" type="text/javascript"></script>
		<script src="https://cvlcondorcet.fr/ckeditor/plugins/slideshow/3rdParty/ad-gallery/jquery.ad-gallery.min.js" type="text/javascript"></script>
		<script src="script.js"></script>
		<title>Condor</title>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Ce site internet utilise des cookies pour fonctionner.  Vous avez cependant la possibilité de les refuser.",
    "dismiss": "Okay ! ",
    "link": "En savoir plus...",
    "href": "https://app.cvlcondorcet.fr/mentions"
  }
})});
</script>
	</head>
	<body>
			<?php 
			if ($test['value'] == 'NORMAL') {
			$data = array("posts", "events", "maps", "cvl", "transport", "canteen", 'mentions');
			if(isset($_GET['module']) && in_array($_GET['module'], $data, true)) {
				$var = "";
				if (isset($_GET['id'])) {
					switch ($_GET['module']) {
						case 'posts':
								$var = 'post_display.php?id='.$_GET['id'];
						break;
					}
				} else {				
					$var = $_GET['module'].'2.php?';
					foreach($_GET as $key => $value)
					{
						$var .= $key."=".$value."&";
					}
				}
				?>
				<script>$('document').ready(function() { $('nav a[data-id="<?php echo $_GET['module']; ?>/"]').addClass('active');});</script>
				<?php
			} else {
				$var = 'index_content.php';
				?>
				<script>$('document').ready(function() { $('nav a[data-id=""]').addClass('active');});</script>
				<?php
			}
			?>
			 <script>$('document').ready(function() { $('#content').load("<?php echo $var; ?>"); });</script>
			<?php } ?>
		<?php include('header.php'); if ($test['value'] =='NORMAL') { include('navbar.php'); }?>
		<div class="loader"></div>
		<div id="content">
			<?php
				if ($test['value'] != 'NORMAL') {
					?><div style="margin: 0 auto; width: 60%;">
					<h1>418 - I'm a teapot</h1>
					<p style="text-align: justify;" >Condor est actuellement indisponible. Nos équipes travaillent actuellement à la remise en service de Condor. Nous nous excusons de la gêne occasionnée.</p>
					<p style="text-align: justify;" >Bien cordialement, le Webmaster.</p><br/><br/>
					<p style="text-align: justify;" >Condor is actually unavailable. Our staff is currently working on this issue. Please excuse us for the inconvenience.</p>
					
					</div>
					<?php
				}
			?>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>