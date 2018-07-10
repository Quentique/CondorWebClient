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
		<title>Condor</title>
	</head>
	<body>
		<?php include('header.php'); include('navbar.php');?>
		<div id="content">
		<?php include("events.php"); ?>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>