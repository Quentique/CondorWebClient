
<div id="posts_feed">
<?php
	require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$request = $bdd->query("SELECT * FROM " . TABLE_GENERAL . " WHERE name = 'website'");
	//var_dump($request->errorInfo());
	$url = $request->fetch();
	$request = $bdd->query("SELECT * FROM " . TABLE_GENERAL . " WHERE name = 'categories'");
	$categories = $request->fetch();
	$categories = json_decode($categories['value']);
	$request = $bdd->prepare("SELECT id, name, REGEXP_SUBSTR (content, '.{100}?') AS content, date, picture, categories FROM ".TABLE_POSTS." WHERE state = 'published' LIMIT 100");
	$array = array();
	if ($request->execute()) {
		while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
			array_push($array, $row);
		}
	}
	$xml = simplexml_load_file($url['value']."feed") or die("feed not loading");
	//var_dump($xml);
	foreach ($xml->channel->item as $item) {
		$row['name'] = $item->title->__toString();
		$row['date'] = $item->pubDate->__toString();
		$row['content'] = $item->description->__toString();
		$row['categories'] = "{'rss'}";
		$row['picture'] = "";
		$row['id'] = $item->link->__toString();
		array_push($array, $row);
	}
	function compareOrder($a, $b)
	{
		return strtotime($b['date']) - strtotime($a['date']);
	}
	usort($array, 'compareOrder');
	foreach ($array as $item) {
		?>
			<div class="article" id="<?php echo $item['id'];?>">
			<h1><?php echo $item['name'];?></h1>
			<p><?php echo strip_tags($item['content']);?>[...]</p>
			<img src="<?php echo $item['picture'];?>"/>
			</div>
		<?php
	}

?>
</div>