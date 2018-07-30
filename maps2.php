<script src="script_maps.js"></script>
<link rel="stylesheet" href="style_maps.css"/>
<script id="script_to_replace">

</script>
<?php 
if (isset($_GET['place'])) {
	?>
	<script>
		$('document').ready(function() {
			$('#search').val("<?php echo $_GET['place']; ?>");
			$('#launch').trigger('click');
		});
	</script>
	<?php
}
$to_show = "GEN.png";
if (isset($_GET['map'])) {
	$to_show = $_GET['map'].'.png';
}
?>
<div id="mobile_container" class="grid-2-small-1">
	<div id="info"> <p id="information_text">Cette page vous permet de rechercher des lieux spécifiques du lycée, ou bien simplement de visualiser les plans de celui-ci.</p>

	<h2 id="title">Cartes & Plans</h2>
	<p id="desc"></p>
	<p id="location"></p>
	</div>
	<div id="form_container">
		<div id="mobile_search" class="flex-container"><span class="item-fluid">Recherche<i class="fa fa-search" style="padding-left: 5px;"></i></span><i id="display_search" class="icon-arrow--down item-last" style="cursor: pointer"></i></div>
		<div id="form" class="right">
			<div id="field" class="flex-container">
				<input type="search" class="item-fluid" id="search"/>
				<div class="w10 flex-container"><i class="fa fa-search item-center" id="launch" ></i></div>
			</div>
			<select size="5" id="results">
				<?php
				require_once('db_constants.php');
				$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
				$request = $bdd->query("SELECT * FROM " . TABLE_MAPS . " ORDER BY RAND() LIMIT 5");
					while ($row = $request->fetch()) {
						echo '<option class="select_result" value="'.$row['name'].'" data-plan="'.$row['map'].'">'.$row['display_name'].'</option>'; 
					}
				
				 ?>
			</select>
			<hr/>
			<select id="select_map"><optgroup label="Grand Lycée"><option value="0EGL">Rez-de-chaussée</option><option value="1EGL">1er étage</option><option value="2EGL">2ème étage</option><option value="3EGL">3ème étage</option></optgroup><optgroup label="Petit Lycée"><option value="0EPL">Rez-de-chaussée</option><option value="1EPL">1er étage</option><option value="2EPL">2ème étage</option><option value="3EPL">3ème étage</option></optgroup><optgroup label="Internat"><option value="0EIN">Rez-de-chaussée</option><option value="1EIN">1er étage</option></optgroup><option value="GEN" selected>Général</option></select>
		</div>
	</div>
</div>
<div id="map_container">
	<img id="place" src="place.png" style="position:absolute; top:0; left:0;"/>
	<img id="map" src="<?php echo HOST."maps/".$to_show;?>"/>
</div>