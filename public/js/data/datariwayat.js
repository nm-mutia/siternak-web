$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
});

$('#tambah_data').click(function(){
	$('.modal-title').text('Tambah Data - Riwayat Penyakit');
	$('#action_button').val('Add');
	$('#action').val('Add');
	$('#form_result').html('');

	$('#tambah_data_form')[0].reset();
	$('#penyakit_id').val('').change();
	$('#necktag').val('').change();
	
	$('#formModal').modal('show');
});

$('#tambah_data_form').on('submit', function(event){
	event.preventDefault();
	var action_url = '';
	var method_form = '';

	//tambah
	if($('#action').val() == 'Add'){
		action_url = "/admin/riwayat";
		method_form = "POST";
	}

	//edit
	if($('#action').val() == 'Edit'){
		var updateId = $('#hidden_id').val();
		action_url = "/admin/riwayat/"+updateId;
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
				$('#riwayat-table').DataTable().ajax.reload();
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
		url: "/admin/riwayat/"+id+"/edit",
		datatype: "json",
		success: function(data){
			$('#penyakit_id').val(data.result.penyakit_id).change();
			$('#necktag').val(data.result.necktag).change();
			$('#tgl_sakit').val(data.result.tgl_sakit);
			$('#obat').val(data.result.obat);
			$('#lama_sakit').val(data.result.lama_sakit);
			$('#keterangan').val(data.result.keterangan);

			$('#hidden_id').val(id);
	    	$('#action').val('Edit');
			$('#action_button').val('Edit');
			$('.modal-title').text('Edit Data - Riwayat Penyakit');
	    	$('#formModal').modal('show');
		},
		error: function (jqXHR, textStatus, errorThrown) { 
			console.log(jqXHR); 
		}
	});
});

//delete
$(document).on('click', '.delete', function(){
	var riwayat_id = $(this).attr('id');
	
    swal({
        title: "Anda yakin ingin menghapus data riwayat penyakit ini?",
        text: "Data tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus!",
        closeOnConfirm: false
    }, function(){
        $.ajax({
            url:"/admin/riwayat/"+riwayat_id,
            method: "DELETE",
            success: function(data){
                $('#riwayat-table').DataTable().ajax.reload();
                swal("Terhapus!", "Data riwayat penyakit id "+riwayat_id+" telah terhapus.", "success");
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