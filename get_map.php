<?php 
if (isset($_GET['query'])) {
	require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$request = $bdd->prepare("SELECT * FROM " . TABLE_MAPS . " WHERE name = :name");
	$request->bindParam(":name", $_GET['query']);
	if ($request->execute()) {
		$row = $request->fetch(PDO::FETCH_ASSOC);
	} else { $row = ""; }
	echo json_encode($row);
}
?>