const website = 'http://127.0.0.1:81/condor_web/';
function change(state) {
	$('.loader').show();
	if (state == null) {
		$('#content').load('index_content.php');
	} else {
		$('#content').load(website+state.url);
	}
}
$('document').ready(function() { /*Displaying home*/
	$(window).on("popstate", function(e) { /* Managing history */
		//change(e.originalEvent.state);
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
			change(state);
			return original.apply(this, arguments);
		};
	})(history.pushState);
	$('nav a').click(function(e) {
		e.preventDefault();
		$('nav a').removeClass('active');
		$(this).addClass('active');
		history.pushState({url: $(this).attr('href')}, "", website+$(this).attr('data-id'))
	});
	
});