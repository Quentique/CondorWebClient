<?php 
require_once('db_constants.php');
$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
$liste = ["tel1", "tel2", "mail", "facebook", "twitter", "website", "ent"];
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
	width: 10rem;
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
@media screen and (max-width: 767px) {
	#contact div {
		margin: 10px auto;
	}
	#social_networks img {
		width: auto;
	}
	#social_networks {
		margin: 0 auto;
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
	<div id="social_networks" class="grid-2-small-2-tiny-2">
		<a class='right' target="_blank" rel="noopener noreferrer" style="width: 9.5rem; padding-right: 0.5rem; padding-top: 0.5rem;" href="http://facebook.com/pg/<?php echo $_SESSION['facebook']; ?>"><img src="facebook.png"/></a>
		<a class='left' style="margin-right: auto;" target="_blank" rel="noopener noreferrer" href="<?php echo $_SESSION['twitter']; ?>"><img src="twitter.png"/></a>
		<a  class='right' target="_blank" rel="noopener noreferrer" href="<?php echo $_SESSION['website']; ?>"><img src="highschool.png"/></a>
		<a  class="left" style="margin-right: auto;" target="_blank" rel="noopener noreferrer" href="<?php echo $_SESSION['ent'];?>"><img src="ent_logo_foreground.png"/></a>
	</div>
</div>