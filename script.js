const website = 'https://app.cvlcondorcet.fr/';
function change(state) {
	$('.loader').show();
	if (state == null) {
		$('#content').load('index_content.php');
		$('nav a').removeClass('active');
		$('nav a[href="index_content.php"]').addClass('active');
	} else {
		$('#content').load(website+state.url);
		$('nav a').removeClass('active');
		$('nav a[href="'+state.url+'"]').addClass('active');
	}
}
$('document').ready(function() { /*Displaying home*/
	$(window).on("popstate", function(e) { /* Managing history */
		change(e.originalEvent.state);
	});
	var loading = $('.loader').hide();
	$(document)
		.ajaxStart(function() {
			loading.show();
		})
		.ajaxStop(function() {
			loading.hide()
		});
	(function(original) {
		history.pushState = function(state) {
			if (arguments[3] == true) {
			change(state);
			}	
			console.debug(arguments);
			return original.apply(this, arguments);
		};
	})(history.pushState);
	$('nav a').click(function(e) {
		e.preventDefault();
		history.pushState({url: $(this).attr('href')}, "", website+$(this).attr('data-id'), true)
	});
	$('#mentions').click(function(e) {
		e.preventDefault();
		history.pushState({url: $(this).attr('href')}, "", website+$(this).attr('id')+"/", true);
	});
});