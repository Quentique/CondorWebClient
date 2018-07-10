<?php 
session_start();
if (isset($_GET['id'])) {
	require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$categories = json_decode($_SESSION['categories'], true);
	$request = $bdd->prepare("SELECT * FROM ".TABLE_POSTS." WHERE id = :id");
	$request->bindParam(":id", $_GET['id']);
	
	if($request->execute()) {
		$row = $request->fetch();
		
		$to_display = "";
		foreach (json_decode($row['categories'], true) as $i) { $to_display .= $categories[$i].", "; }
		$days = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&#251;t', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		$date = getdate(strtotime($row['date']));
		?>
		<div class="article" id="<?php echo $row['id'];?>">
				<div class="short_desc">
					<h1><?php echo $row['name'];?></h1>
					<p>Publié le <?php echo $date['mday'] ." ".strtolower($days[$date['mon']]). " ".$date['year'];?> | <?php echo rtrim($to_display, ", "); ?> </p>
				</div>
			<div id="content">
				<img class="img_pra fl"  src="<?php echo $row['picture'];?>"/>
				<div><?php echo $row['content']; ?></div>
			</div>
		</div>
		<?php 
	}
} ?>
<style>
#content div {
	text-align: justify;
}
#content img {
	max-width: 500px;
	max-height: 500px;
	width: auto;
	height: auto;
}
.article {
	margin: 0 40px;
}
</style>