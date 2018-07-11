
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
	$('#posts_feed').on('click', '.article', function() {
		if ($(this).attr('id').startsWith('h')) {
			window.open($(this).attr('id'));
		} else {
			$('.loader').show();
			$('#content').load('post_display.php?id='+$(this).attr("id"), function() { $('.loader').hide(); });
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
		e.stopPropagation();
		$('#search').val("");
		$('#all').prop('checked', false);
		$('.checkbox').prop('checked', false);
		$('input[value="'+$(this).attr('href')+'"]').prop('checked', true);
		$('#send').trigger('click');
	});
	$.fn.animateRotate = function(angle, duration, easing, complete) {
  var args = $.speed(duration, easing, complete);
  var step = args.step;
  return this.each(function(i, e) {
    args.complete = $.proxy(args.complete, e);
    args.step = function(now) {
      $.style(e, 'transform', 'rotate(' + now + 'deg)');
      if (step) return step.apply(e, arguments);
    };

    $({deg: 0}).animate({deg: angle}, args);
  });
};
	$('#display_search').click(function() {
		var one, two;
		if ($(this).hasClass("icon-arrow--down")) {
			one = "icon-arrow--down";
			two = "icon-arrow--up";
			$('#form').slideDown();
		} else {
			$('#form').slideUp();
			two = "icon-arrow--down";
			one = "icon-arrow--up";
		}
		$(this).animateRotate(180, 500, "swing", function() {
			$(this).removeClass(one).addClass(two).css("transform", "");
		});
	});
});
</script>

<style>

</style>
<?php
session_start();
	$categories = json_decode($_SESSION['categories'], true);
	$categories['rss'] = "Flux RSS";
?>
<div id="content_posts">
<div id="container" class="grid-2-small-1">
<div>
<h1 id="title" >Billets et actualités</h1>
</div>

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
			<button type="button" class="btn--inverse" id="send"><i class="fa fa-search fa-x"></i></button>
			</form>
		</div>
	</div>
</div>
<div id="posts_feed" >

</div>
</div>