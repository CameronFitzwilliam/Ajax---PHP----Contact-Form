

// Jquery handles input data + sends it to mailer.php
$("#formContact").submit(function(event) {
	var name = $('#name').val();
	var from = $('#from').val();
	var subject = $('#subject').val();
	var verifyBox = $('#verif_box').val();
	var message = $('#message').val();

	event.preventDefault();

	var empty = $("#formContact").find("input").filter(function() {
		return this.value === "";
	});
	if(empty.length) {
		$('#contactMessage').append("<div class='alert alert-danger' role='alert'><p>Please type in all input fields!</p></div>");
	} else {
		$.ajax({
			url: 'php/mailer.php',
			type: 'POST',
			dataType: 'html',
			data: {
				name: name,
				subject: subject,
				message, message,
				from: from,
				verif_box: verifyBox
			},
		})
		.done(function(data) {
			$('#contactMessage').html('');
			$('#contactMessage').append(data);
		});
	}
});

