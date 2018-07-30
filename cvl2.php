<?php 
require_once('db_constants.php');
$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
$request = $bdd->prepare("SELECT * FROM " . TABLE_GENERAL . " WHERE name = 'cvl'");
if ($request->execute()) {
$row = $request->fetch();
} else { $row['value'] = ""; }
?>
<style>
#cvl_presentation {
	padding: 0 6%;
}
</style>
<div id="cvl_presentation">
<?php echo file_get_contents(HOST."uploads/".$row['value']);?>
</div>