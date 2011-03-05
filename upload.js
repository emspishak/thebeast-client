$(window).load(function() {
	//alert("loaded!");
	jQuery.ajax({
		url: url,
		type: 'post',
		data: {
			uuid: uuid,
			session_id: sessionID,
			movies: movies
		}
		success: display_result
	});
});

function display_results(data) {
	$('#area').html = data;
}