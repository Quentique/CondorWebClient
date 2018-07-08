<?php 
session_start();
require_once('db_constants.php');
$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
$liste = ["name", "adresse", "cover", "adresse", "color"];
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<title>Condor</title>
	</head>
	<body>
		<?php include('header.php'); include('navbar.php'); include('maps.php'); include('footer.php');?>
	</body>
</html>