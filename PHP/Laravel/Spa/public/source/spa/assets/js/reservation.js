$(document).ready(function() {
	$('#reser-button').on('click', function() {
		var URL = $(this).attr('data-url');
		// console.log($('#reser_message').val());
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: URL,
			type: 'post',
			// dataType: 'JSON',
			data: {
				reser_name: $('#reser_name').val(),
				reser_phone: $('#reser_phone').val(),
				reser_email: $('#reser_email').val(),
				reser_date: $('#reser_date').val(),
				reser_service: $('#reser_service').val(),
				reser_gender: $('#reser_gender option:selected').attr('value'),
				reser_message: $('#reser_message').val()
			},
			success: function(msg) {
				alert(msg.success);
				$('#reser_name').val('');
				$('#reser_phone').val('');
				$('#reser_email').val('');
				$('#reser_date').val('');
				$('#reser_service').val('');
				$('#reser_message').val('');
			},
			error: function(xhr, status, err) {
				var error = JSON.parse(xhr.responseText);
				$.each(error, function(key, value) {
					$('#'+key).css('border-color','red');
					$('#'+key+"-err").text(value);
					$('#'+key+"-err").css('color','red');
				});
			}
		});
	});

	$('#button-check-service').click(function() {
		var count = $(':input[name="check-service"]').length;
		var vlue = "";
		var msg = "[";
		var c = 0;
		for(var i = 0; i < count; i++) {
			if( $(':input[name="check-service"]:eq('+i+')').prop('checked') == true ) {
				c = c + 1;
				msg = msg + $(':input[name="check-service"]:eq('+i+')').attr('data-msg') + ';';
			}
		}
		if(c > 0) {
			$('#reser_service').val(msg+']');
			// document.getElementById('reser-service').value = msg+']';
		} else {
			document.getElementById('reser_service').value = '';
		}
	});
	
});