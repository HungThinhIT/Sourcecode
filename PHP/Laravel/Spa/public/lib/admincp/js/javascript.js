$(document).ready(function() {
	$(document).on('click','button[data-toggle="modal"]', function() {
		var URL = $(this).attr('data-url');
		var name = $(this).attr('data-title');
		console.log(URL);
		console.log(name);
		$('#at-del').attr('href',URL);
		$('#title-md-del').text(name);
	});
});