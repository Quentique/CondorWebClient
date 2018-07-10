<link rel="stylesheet" href="style_events.css"/>
<?php 
	require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$request = $bdd->prepare("SELECT * FROM ". TABLE_EVENTS . " WHERE state = 'published'");
	if ($request->execute()) {
		$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
		while($row = $request->fetch()) {
			$date3 = strtotime($row['start']);
			$date4 = strtotime($row['end']);
			$date1 = getdate(strtotime($row['start']));
			$date2 = getdate(strtotime($row['end']));
			$bool = ($date1['yday'] == $date2['yday']) ? false : true;
			
			?>
				<div class="event <?php if ($bool) { echo "two"; } ?>">
					<div class="times">
						<span class="margin"><?php echo ($bool) ? 'Du' : 'Le'; ?></span>
						<div class="post-date">
							<span class="wday"><?php echo substr($days[$date1['wday']],0,3); ?></span>
							<span class="day"><?php echo date("d", $date3) ?></span>
							<span class="month"><?php echo date("M", $date3) ?></span>
						</div>
						<?php echo ($bool) ? '' :'<span class="margin">de</span>'; ?>
						<?php if (!$bool) { ?><span class="begin_time"><?php echo date("H:i", $date3) ?></span><?php }
						if ($bool) { ?>
							<span class="margin">au</span>
							<div class="post-date">
								<span class="wday"><?php echo substr($days[$date2['wday']],0,3); ?></span>
								<span class="day"><?php echo date("d", $date4) ?></span>
								<span class="month"><?php echo date("M", $date4) ?></span>
							</div>
						<?php } else {?>
						<span class="margin">à</span>
						<span class="end_time"><?php echo date("H:i", $date4); ?></span>
						<?php } ?>
					</div>
					<div class="content_event">
						<h1><?php echo $row['name']; ?></h1>
						<div class="place"> <i class="fa fa-map-marked-alt fa-2x"></i><h3> <?php echo $row['place']; ?></h3></div>
						<p class="description"><?php echo $row['description']; ?></p>
						<img src="<?php echo $row['picture'];?>" class="fl"/>
					</div>
				</div>
			<?php
		}
	}
	echo 'test';
?>
<style>

</style>