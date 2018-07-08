<style>
#header {
	background: url('<?php echo HOST."uploads/".$_SESSION['cover'];?>');
	background-position: 25% 60%;
	background-size: cover;
	background-repeat: no-repeat;
	position: relative;
	padding: 20px;
}
#condor {
	font-family: Roboto, Arial;
	font-weight: 500;
	color: #f2f2f2;
	text-shadow: 1px 1px 2px #b2b2b2;
	font-size: 5rem;
	
	overflow: visible;
	display: inline-block;
	vertical-align: middle;
}

#highschool_presentation > h1, #highschool_presentation a{
	color: <?php echo $_SESSION['color']; ?>;
	text-shadow: 2px 2px 4px black;
}
#address {
	position: absolute;
	bottom: 0;
	right: 0;
}
#header .col-40 {
	white-space: nowrap;
}

#logo {
	height: 10rem;
	display: inline-block;
}
</style>
<header id="header" class="mod autogrid" >
	<div class="col-40">
		<img id="logo" class="" src="condor.png"/>
		<h1 class="txtleft mls" id="condor">Condor</h1>
	</div>
	<div id="highschool_presentation" class="col-60">
		<h1 class="txtcenter"><?php echo $_SESSION['name'] ?></h1><br/>
		<span id="address" class="mrs mbs"><a target="_blank" rel="noopener noreferrer" href="https://www.google.fr/maps/search/<?php echo $_SESSION['name'].", ".$_SESSION['adresse'];?>"><?php echo $_SESSION['adresse'];?></a></span>
	</div>
</header>