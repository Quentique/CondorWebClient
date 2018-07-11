<?php 
if (isset($_GET['query'])) {
	require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$request = $bdd->prepare("SELECT name, display_name, map FROM " . TABLE_MAPS . " WHERE display_name LIKE '%".$_GET['query']."%' OR name = '".$_GET['query']."'");
	$array = array();
	if ($request->execute()) {
		while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
			array_push($array, $row);
		}
	}
	echo json_encode($array);
}
?>
