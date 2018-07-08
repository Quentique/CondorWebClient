<?php 
require_once('db_constants.php');
$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
$request = $bdd->prepare("SELECT * FROM " . TABLE_GENERAL . " WHERE name = 'canteen'");
if ($request->execute()) {
$row = $request->fetch();
} else { $row['value'] = ""; }
?>
<iframe src="http://docs.google.com/gview?url=<?php echo HOST ."uploads/". $row['value']; ?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>