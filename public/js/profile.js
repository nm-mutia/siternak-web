$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('#edit_profil').click(function(){	
	$('#form_result').html('');

	$.ajax({
		url: "/admin/profile/edit",
		datatype: "json",
		success: function(data){
			$('#name').val(data.result.name);
			$('#username').val(data.result.username);
			$('#email').val(data.result.email);
			$('#hidden_id').val(data.result.id);
	    	$('#ubahProfilModal').modal('show');
		}
	});
});

$('#ubah_data_form').on('submit', function(event){
	event.preventDefault();
	var updateId = $('#hidden_id').val();

	$.ajax({
		url: "/admin/profile/edit",
		method: "PUT",
		data: $(this).serialize(),
		datatype: "json",
		success: function(data){
			var html = '';
			if (data.errors) {
				html = '<div class="alert alert-danger">';
				for (var count = 0; count < data.errors.length; count++) {
					html += '<p>' + data.errors[count] + '</p>';
				}
				html += '</div>';
			}
			if (data.success) {
				html = '<div class="alert alert-success">' + data.success + '</div>';
				location.reload();
			}
			$('#form_result').html(html);
		}
	});
});

$('#edit_password').click(function(){	
	$('#form_result_pass').html('');

	$.ajax({
		url: "/admin/password/change",
		method: "GET",
		datatype: "json",
		success: function(data){
	    	$('#ubahPassModal').modal('show');
	    	// console.log(data);
		}
	});
});

$('#ubah_pass_form').on('submit', function(event){
	event.preventDefault();
	var updateId = $('#hidden_id').val();

	$.ajax({
		url: "/admin/password/change",
		method: "POST",
		data: $(this).serialize(),
		datatype: "json",
		success: function(data){
			var html = '';
			if (data.errors) {
				html = '<div class="alert alert-danger">';
				for (var count = 0; count < data.errors.length; count++) {
					html += '<p>' + data.errors[count] + '</p>';
				}
				html += '</div>';
			}
			if (data.success) {
				html = '<div class="alert alert-success">' + data.success + '</div>';
				location.reload();
			}
			$('#form_result_pass').html(html);
		},
		error : function(data){
			html = '<div class="alert alert-danger">' + data.errors + '</div>';
		}
	});
});