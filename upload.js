$(window).load(function() {
	//alert("loaded!");
	var data = {
		uuid: uuid,
		session_id: sessionId,
		movies: movies
	};
	alert(data);
	$('#debug').html(data);
	jQuery.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: display_results
	});
});

function display_results(data) {
	$('#area').html = data;
}