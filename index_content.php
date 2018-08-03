<?php 
require_once('db_constants.php');
$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
$liste = ["tel1", "tel2", "mail", "social_networks"];
foreach ($liste as $key => $value) {
$request = $bdd->prepare("SELECT * FROM " . TABLE_GENERAL . " WHERE name = :id");
$request->bindParam(":id", $value);
if ($request->execute()) {
$row = $request->fetch();
} else { $row[$key] = ''; $row['value'] = ""; }
$_SESSION[$value] = $row['value'];
}
?>
<style>
#contact div i {
	vertical-align: middle;
	margin-right: 1rem;
}
#social_networks img {
	min-width: 10rem;
	margin: auto;
}
#social_networks a {
	display: inherit;
}
#social_networks img:hover {
	box-shadow: 2px 2px 1px 1px #ccc;
}
#contact div {
	padding: 0.6rem;
	background-color: #EFEFEF;
	border: solid 1px #EFEFEF;
	box-shadow: 2px 2px 1px 1px #C0C0C0;
	border-radius: 7px;
}
#contact a {
	text-decoration: none;
}
#contact div:hover {
	background-color: #DCDCDC;
	border-color:  #DCDCDC;
	cursor: pointer;
	box-shadow-color: #A9A9A9;
}
@media screen and (min-width: 768px) {
	#fb {
		width: 9.5rem;
	}
}
@media screen and (max-width: 767px) {
	#contact div {
		margin: 10px auto;
	}
	#social_networks img {
		width: auto;
	}
	#social_networks {
		text-align: center;
	}
}
</style>
<div class="grid-2-tiny-1 has-gutter-l">
	<div id="contact" class="flex-container--column">
		<div class="center item-center">
			<i class="fa fa-2x fa-phone" aria-hidden="true"></i>
			<a href="tel:<?php echo $_SESSION['tel1']; ?>"><?php echo $_SESSION['tel1']; ?></a>
		</div>
		<div class="center item-center">
			<i class="fa fa-2x fa-phone" aria-hidden="true"></i>
			<a href="tel:<?php echo $_SESSION['tel2']; ?>"><?php echo $_SESSION['tel2']; ?></a>
		</div>
		<div class="center item-center">
			<i class="fa fa-2x fa-at" aria-hidden="true"></i>
			<a href="mailto:<?php echo $_SESSION['mail']; ?>"><?php echo $_SESSION['mail']; ?></a>
		</div>
	</div>
	<div id="social_networks" class="grid-4-small-3-tiny-2 has-gutter-xl">
	<?php 	
	$table = json_decode($row['value'], true);
	foreach ($table as $key=>$value) {
	?>
		<a target="_blank" rel="noopener noreferrer" href="<?php echo $value['link'];?>"><img src="<?php echo HOST."uploads/".$value['image']; ?>" alt="<?php echo $value['title'];?>"/></a>
		
	<?php } ?>
	</div>
</div>