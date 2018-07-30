const site = "https://cvlcondorcet.fr/"
function resize(xper, yper) {
	$("#place").css("top", $('#map').height()*yper-$('#place').height());
	$("#place").css("left", $('#map').width()*xper-$('#place').width()/2);
}
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
$('document').ready(function(){
	$("#place").toggle();
	$('#search').keypress(function(e) {
    if(e.which == 13) {
        $('#launch').trigger('click');
    }
	});
	$('#select_map').click(function() {
		$('#map').attr('src', site+'maps/'+$('#select_map option:selected').val()+".png");
		$('#place').slideUp();
		history.pushState({url: 'maps.php?map='+$('#select_map option:selected').val()}, '', '/maps/location/'+$('#select_map option:selected').val(), false);
	});

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
	$('#launch').click(function(){
		if ($('#search').val() !== "") {
			$.ajax({
				url: 'search.php',
				type: 'GET',
				data: 'query='+$('#search').val(),
				
				datatype: 'json',
				success: function(data, code) {

					obj = $.parseJSON(data);
					$('#results').empty();
					$.each(obj, function() {
						$('#results').append('<option class="select_result" value="'+this['name']+'" data-plan="'+this['map']+'">'+this['display_name']+'</option>');
					});
					if (obj.length == 1) {
						$('#results option:first-child').attr('selected', true);
						$('#results').trigger('change');
					}
				}
			});
		}
	});
	
	$('#results').on('change click', function() {
		
		$('#map').attr('src', site+"maps/"+$('#results option:selected').attr('data-plan').substr(0,$('#results option:selected').attr('data-plan').indexOf("."))+".png");

		$.ajax({
			url: 'get_map.php',
			type: 'GET',
			data: 'query='+$('#results option:selected').val(),
			
			datatype: 'json',
			success: function(result, code) {
				data = $.parseJSON(result);
				$('#title').text(data['display_name']);
				$('#desc').text(data['description']);
				var obj = $.parseJSON(data['pos']);
				$('#map').ready(function() {
					$('#script_to_replace').replaceWith("<script id=\"script_to_replace\"> $('document').ready(function() { $(window).on('resize', function() { resize("+obj['x']+","+obj['y']+"); }); $('#place').slideDown(); }); <\/script>");
					resize(obj['x'], obj['y']);
				});
				obj2 = $.parseJSON(data['mark']);
				var toshow;
				switch (obj2[0]) {
					case "0":
						toshow = "Rez-de-chaussée";
						break;
					case "1":
						toshow = "1<sup>er</sup> étage";
						break;
					default:
						toshow = obj2[0]+"<sup>ème</sup> étage";
				}
				switch (obj2[1]) {
					case "NU":
						toshow = "Bâtiment du Lycée";
						break;
					case "GL":
						toshow += " du Grand Lycée";
						break;
					case "IN":
						toshow += " de l'Internat";
						break;
					case "PL": 
						toshow += " du Petit Lycée";
						break;
				}
				$('#location').empty().append("<strong>Emplacement : </strong>"+toshow);
				history.pushState({url: 'maps.php/'+data['name']}, '', '/maps/'+data['name'], false);
			}
		});
	});
});