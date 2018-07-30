<?php
session_start();
/*<div class="post-date">
			<p class="default-date">
			<span id="wday"><?php echo $days[$date['wday']]; ?></span>
			<span id="day"><?php echo $date['mday']; ?></span>
			<span id="month"><?php echo substr($date['month'],0,3); ?></span>
			</p></div>*/
			
	if (isset($_GET['search'])) {
		$to_add = "";
		if (!empty($_GET['search'])) {
			$to_add = "AND name LIKE '%".$_GET['search']."%' ";
		}
		if (!isset($_GET['all']) && isset($_GET['cat'])) {
			$to_add .= "AND ";
			foreach ($_GET['cat'] as $cat) {
				$to_add .= "categories LIKE '%".$cat."%' OR ";
			}
			$to_add = rtrim($to_add, "OR ");
		}	
		require_once('db_constants.php');
		$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
		$request = $bdd->query("SELECT * FROM " . TABLE_GENERAL . " WHERE name = 'website'");
		$url = $request->fetch();
		$categories = json_decode($_SESSION['categories'], true);
		$categories['rss'] = "Flux RSS";
		$request = $bdd->prepare("SELECT id, name, SUBSTR(content, 1, 401) AS content, date, picture, categories FROM ".TABLE_POSTS." WHERE state = 'published' ".$to_add." LIMIT 100");
		$array = array();
		if ($request->execute()) {
			while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
				array_push($array, $row);
			}
		}
		if (isset($_GET['all']) || (isset($_GET['cat']) && in_array("rss", $_GET['cat']))) {
		$xml = simplexml_load_file($url['value']."feed") or die("feed not loading");
		foreach ($xml->channel->item as $item) {
			if (empty($_GET['search']) || strpos($item->title->__toString(), $_GET['search']) !== false || strpos($item->description->__toString(), $_GET['search']) !== false) {
				$row['name'] = $item->title->__toString();
				$row['date'] = $item->pubDate->__toString();
				$row['content'] = $item->description->__toString();
				$row['categories'] = "[\"rss\"]";
				$row['picture'] = "";
				$row['id'] = $item->link->__toString();
				array_push($array, $row);
			}
		}
		}
		function compareOrder($a, $b)
		{
			return strtotime($b['date']) - strtotime($a['date']);
		}
		usort($array, 'compareOrder');
		$days = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&#251;t', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		foreach ($array as $item) {
			$date = getdate(strtotime($item['date']));
			$to_display ="";
			foreach (json_decode($item['categories'], true) as $i) { $to_display .= '<a class="link_cat" href="'.$i.'">'.$categories[$i]."</a>, "; }
			?>
				<div class="article" id="<?php echo $item['id'];?>">
					<div class="short_desc">
						<h1><?php echo $item['name'];?></h1>
						<p>Publié le <?php echo $date['mday'] ." ".strtolower($days[$date['mon']]). " ".$date['year'];?> | <?php echo rtrim($to_display, ", "); ?> </p>
						<p><?php echo trim(strip_tags($item['content']));?>[...]</p>
					</div>
					<img class="img_pra" src="<?php echo $item['picture'];?>"/>
				</div>
			<?php
		}
		if (empty($array)) {
			?>
			<h2 class="txtcenter">Aucun résultat</h2>
			<?php
		}
	}
?>