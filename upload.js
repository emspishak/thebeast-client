$(window).load(function() {
	//alert("loaded!");
	var data = {
		'uuid': uuid,
		'session_id': sessionId,
		'movies': movies
	};
	//alert(data);
	//$('#debug').html(data.toSource());
	jQuery.post(url, data);
});

function display_results(data) {
	$('#area').html = data;
}