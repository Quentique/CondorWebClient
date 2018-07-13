<?php 
session_start();
require_once('db_constants.php');
$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
$liste = ["name", "adresse", "cover", "adresse", "color", "categories"];
foreach ($liste as $key => $value) {
	$request = $bdd->prepare("SELECT * FROM " . TABLE_GENERAL . " WHERE name = :id");
	$request->bindParam(":id", $value);
	if ($request->execute()) {
		$row = $request->fetch();
	} else { $row['value'] = ""; }
	$_SESSION[$value] = $row['value'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="knacss-unminified.css">
		<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="script.js"></script>
		<title>Condor</title>
	</head>
	<body>
			<?php 
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
					$var = $_GET['module'].'.php?';
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
			
		<?php include('header.php'); include('navbar.php');?>
		<div class="loader"></div>
		<div id="content">
			
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>