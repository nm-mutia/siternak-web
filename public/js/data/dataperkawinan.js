$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
});

$('#tambah_data').click(function(){
	$('.modal-title').text('Tambah Data - Perkawinan');
	$('#action_button').val('Add');
	$('#action').val('Add');
	$('#form_result').html('');

    $('#tambah_data_form')[0].reset();
    $('#necktag').val('').change();
    $('#necktag_psg').val('').change();

	$('#formModal').modal('show');
});

$('#tambah_data_form').on('submit', function(event){
	event.preventDefault();
	var action_url = '';
	var method_form = '';

	//tambah
	if($('#action').val() == 'Add'){
		action_url = "/admin/perkawinan";
		method_form = "POST";
	}

	//edit
	if($('#action').val() == 'Edit'){
		var updateId = $('#hidden_id').val();
		action_url = "/admin/perkawinan/"+updateId;
		method_form = "PUT";
	}

	$.ajax({
		url: action_url,
		method: method_form,
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
				$('#tambah_data_form')[0].reset();
				$('#perkawinan-table').DataTable().ajax.reload();
			}
			$('#form_result').html(html);
		},
        error: function (jqXHR, textStatus, errorThrown) { 
            console.log(jqXHR); 
        }
	});
});

//edit
$(document).on('click', '.edit', function(){
	var id = $(this).attr('id');
	$('#form_result').html('');
	$.ajax({
		url: "/admin/perkawinan/"+id+"/edit",
		datatype: "json",
		success: function(data){
			$('#necktag').val(data.result.necktag).change();
			$('#necktag_psg').val(data.result.necktag_psg).change();
            $('#tgl').val(data.result.tgl);

			$('#hidden_id').val(id);
	    	$('#action').val('Edit');
			$('#action_button').val('Edit');
			$('.modal-title').text('Edit Data - Perkawinan');
	    	$('#formModal').modal('show');
		},
        error: function (jqXHR, textStatus, errorThrown) { 
            console.log(jqXHR); 
        }
	});
});

//delete
$(document).on('click', '.delete', function(){
	var perkawinan_id = $(this).attr('id');
	
    swal({
        title: "Anda yakin ingin menghapus data perkawinan ini?",
        text: "Data tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus!",
        closeOnConfirm: false
    }, function(){
        $.ajax({
            url:"/admin/perkawinan/"+perkawinan_id,
            method: "DELETE",
            success: function(data){
                $('#perkawinan-table').DataTable().ajax.reload();
                swal("Terhapus!", "Data perkawinan id "+perkawinan_id+" telah terhapus.", "success");
            },
            error : function(){
                swal({
                    title: 'Opps...',
                    text : data.message,
                    type : 'error',
                    timer : '1500'
                })
            }
        });
    });
    
});