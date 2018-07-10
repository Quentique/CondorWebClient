<link rel="stylesheet" href="style_posts.css"/>
<script>
$('document').ready(function() {
	
	$('#posts_feed').load('posts_search.php?search=&all=on', function() { $('.loader').hide(); });
	$('#all').prop('checked', true);
	$('#real_form').submit(function(e) {
		e.preventDefault();
	});
	$('#search').keypress(function(e) {
		if(e.which == 13) {
			$('#send').trigger('click');
		}
	});
	$('.article').click(function() {
		if ($(this).attr('id').startsWith('h')) {
			window.open($(this).attr('id'));
		}
	});
	
	$("#all").change(function() {
		if(this.checked) {
			$('.checkbox').prop('checked', false);
		}
	});
	$(".checkbox").change(function() {
		if (this.checked) {
			$('#all').prop('checked', false);
		}
	});
	$('#send').click(function() {
		$('.loader').show();
		$.get('posts_search.php', $('#real_form').serialize()).done(function(data) {
			$('#posts_feed').empty().append(data);
			$('.loader').hide();
		});
	});
	$('#posts_feed').on('click', '.link_cat', function(e) {
		e.preventDefault();
		$('#search').val("");
		$('#all').prop('checked', false);
		$('.checkbox').prop('checked', false);
		$('input[value="'+$(this).attr('href')+'"]').prop('checked', true);
		$('#send').trigger('click');
	});
});
</script>

<style>
#search_block {

}
#content {
	position: relative;
	z-index: 0;
}
#search_block {
	width: 25%;
	padding: 10px;
	position: absolute;
	right: 20px;
	top: 0px;
	z-index: 2;
	
	background-color:white;
	border: solid 1px white;
	border-radius: 5px;
	box-shadow: 2px 2px 1px #F3F3F3;
}
#form {
	
}
#form table {
	margin-top: 10px;
	display: block;
	overflow: scroll;
	overflow-x: auto;
	overflow-y: scroll;
	height: 100px;
}
#mobile_search {
	display: none;
}
#form table tr td:first-child {
	text-align: center;
}
#form table tr td:nth-child(2) {
	padding-left: 10px;
}
.loader {
	position: absolute;
	left: 50%;
	z-index: 3;
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s ease-in infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<?php
	require_once('db_constants.php');
	$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
	$request = $bdd->query("SELECT * FROM " . TABLE_GENERAL . " WHERE name = 'categories'");
	$categories = $request->fetch();
	$categories = json_decode($categories['value'], true);
	$categories['rss'] = "Flux RSS";
?>
<div id="content">
<div id="container" class="grid-2-small-1">
<div>
<h1>Billets et actualités</h1>
</div>
<div class="loader"></div>
<div id="search_block">
		<div id="mobile_search" class="flex-container"><span class="item-fluid">Recherche<i class="fa fa-search" style="padding-left: 5px;"></i></span><i id="display_search" class="icon-arrow--down item-last" style="cursor: pointer"></i></div>
		<div id="form" class="right">
			<form id="real_form">
			<div id="field" class="flex-container">
				<input type="search" class="item-fluid" name="search" id="search"/>
				<div class="w10 flex-container"><i class="fa fa-search item-center" id="launch" ></i></div>
			</div>
			<table id="selector">
			<tr><td><input type="checkbox" name="all" id="all" class="switch"/></td><td>Tout</td></tr>
			<?php 
				foreach ($categories as $key=>$value) {
					?><tr><td><input type="checkbox" class="checkbox" name="cat[]" value="<?php echo $key; ?>"></td><td><?php echo $value; ?></td></tr><?php
				}
			?>
			</table>
			<button type="button" class="btn right" id="send"><i class="fa fa-search fa-x"></i></button>
			</form>
		</div>
	</div>
</div>
<div id="posts_feed" >

</div>
</div>