$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
});

$('#tambah_data').click(function(){
	$('.modal-title').text('Tambah Data - Ternak');
	$('#action_button').val('Add');
	$('#action').val('Add');
	$('#action').show();
	$('#action_button').show();
	$('#form_result').html('');
	
	$('#kematian_form').hide();
	$('#necktag_form').hide();

    $('#tambah_data_form')[0].reset();
    $('#necktag').val('').change();
    $('#pemilik_id').val('').change();
    $('#ras_id').val('').change();
    $('#kematian_id').val('').change();
    $('#necktag_ayah').val('').change();
    $('#necktag_ibu').val('').change();

	$('#formModal').modal('show');
});

$('#tambah_data_form').on('submit', function(event){
	event.preventDefault();
	var action_url = '';
	var method_form = '';

	//tambah
	if($('#action').val() == 'Add'){
		action_url = "/admin/ternak";
		method_form = "POST";
	}

	//edit
	if($('#action').val() == 'Edit'){
		var updateId = $('#hidden_id').val();
		action_url = "/admin/ternak/"+updateId;
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
			if (data.error) {
				html = '<div class="alert alert-danger">' + data.error + '</div>';
			}
			if (data.success) {
				html = '<div class="alert alert-success">' + data.success + '</div>';
				$('#tambah_data_form')[0].reset();
				$('#ternak-table').DataTable().ajax.reload();
			}
			$('#form_result').html(html);
		},
		error: function (jqXHR, textStatus, errorThrown) { 
			console.log(jqXHR); 
		}
	});
});

//view
$(document).on('click', '.view', function(){
	var id = $(this).attr('id');
    var txt = '', txt2 = '';
    var rp = [];

    txt = '<tr>';
    txt += '<th>Nama Penyakit</th>';
    txt += '<th>Tanggal Sakit</th>';
    txt += '<th>Obat</th>';
    txt += '<th>Lama Sakit</th>';
    txt += '<th>Keterangan</th>';
    txt += '</tr>';

	$('#form_result').html('');
	$.ajax({
		url: "/admin/ternak/"+id, //show
		datatype: "json",
		success: function(data){
			$('#vpemilik_id').val(data.result.pemilik_id);
			$('#vras_id').val(data.result.ras_id);
			$('#vkematian_id').val(data.result.kematian_id);
			$('#vjenis_kelamin').val(data.result.jenis_kelamin);
			$('#vtgl_lahir').val(data.result.tgl_lahir);
			$('#vbobot_lahir').val(data.result.bobot_lahir);
			$('#vpukul_lahir').val(data.result.pukul_lahir);
			$('#vlama_dikandungan').val(data.result.lama_dikandungan);
			$('#vlama_laktasi').val(data.result.lama_laktasi);
			$('#vtgl_lepas_sapih').val(data.result.tgl_lepas_sapih);
			$('#vblood').val(data.result.blood);
			$('#vnecktag_ayah').val(data.result.necktag_ayah);
			$('#vnecktag_ibu').val(data.result.necktag_ibu);
			$('#vbobot_tubuh').val(data.result.bobot_tubuh);
			$('#vpanjang_tubuh').val(data.result.panjang_tubuh);
			$('#vtinggi_tubuh').val(data.result.tinggi_tubuh);
			$('#vcacat_fisik').val(data.result.cacat_fisik);
			$('#vciri_lain').val(data.result.ciri_lain);
			$('#vstatus_ada').val(data.result.status_ada);
			$('#vcreated_at').val(data.result.created_at);
			$('#vupdated_at').val(data.result.updated_at);

            if(data.riwayat != ''){
                $('#riwayat-penyakit').empty().append(txt);
                $.each(data.riwayat, function(i, val) {
                    var rp1 = data.riwayat[i].rp_ternak.split('(');
                    var rp2 = rp1[1].split(')');
                    rp[i] = rp2[0].split(',');
                    //1: nama penyakit, 2: date, 3: obat, 4: lama sakit, 5: ket

                    txt2 = '<tr>'; 
                    for(var j = 1; j <= 5; j++){ 
                        if(rp[i][j-1] == ""){
                            rp[i][j-1] = '-';
                        } 
                        txt2 += '<td>' + rp[i][j-1] + '</td>';
                    }
                    txt2 += '</tr>';
                    $('#riwayat-penyakit').append(txt2);
                    $('#riwayat-penyakit').show();
                });
                $('#span-rp').empty();
            }
            else{
                $('#span-rp').html('<p align="center">Tidak ada data riwayat penyakit</p>');
                $('#riwayat-penyakit').hide();
            }

			$('.modal-title').text('Data Ternak - '+id);
	    	$('#viewModal').modal('show');
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
		url: "/admin/ternak/"+id+"/edit", //edit
		datatype: "json",
		success: function(data){
			$('#necktag').val(data.result.necktag);
			$('#pemilik_id').val(data.result.pemilik_id).change();
            $('#ras_id').val(data.result.ras_id).change();
			$('#kematian_id').val(data.result.kematian_id).change();
			$('#jenis_kelamin').val(data.result.jenis_kelamin);
			$('#tgl_lahir').val(data.result.tgl_lahir);
			$('#bobot_lahir').val(data.result.bobot_lahir);
			$('#pukul_lahir').val(data.result.pukul_lahir);
			$('#lama_dikandungan').val(data.result.lama_dikandungan);
			$('#lama_laktasi').val(data.result.lama_laktasi);
			$('#tgl_lepas_sapih').val(data.result.tgl_lepas_sapih);
			$('#blood').val(data.result.blood);
			$('#necktag_ayah').val(data.result.necktag_ayah).change();
			$('#necktag_ibu').val(data.result.necktag_ibu).change();
			$('#bobot_tubuh').val(data.result.bobot_tubuh);
			$('#panjang_tubuh').val(data.result.panjang_tubuh);
			$('#tinggi_tubuh').val(data.result.tinggi_tubuh);
			$('#cacat_fisik').val(data.result.cacat_fisik);
			$('#ciri_lain').val(data.result.ciri_lain);
			$('#status_ada').val(data.result.status_ada);

            $('#kematian_form').show();
            $('#necktag_form').show();
			$('#necktag').attr('readonly', true);
			$('#hidden_id').val(id);
	    	$('#action').val('Edit');
			$('#action_button').val('Edit');
			$('.modal-title').text('Edit Data - Ternak');
	    	$('#formModal').modal('show');
		},
        error: function (jqXHR, textStatus, errorThrown) { 
            console.log(jqXHR); 
        }
	});
});

//delete
$(document).on('click', '.delete', function(){
	var ternak_id = $(this).attr('id');
	
    swal({
        title: "Anda yakin ingin menghapus data ternak ini?",
        text: "Data tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus!",
        closeOnConfirm: false
    }, function(){
        $.ajax({
            url:"/admin/ternak/"+ternak_id,
            method: "DELETE",
            success: function(data){
                $('#ternak-table').DataTable().ajax.reload();
                swal("Terhapus!", "Data ternak id "+ternak_id+" telah terhapus.", "success");
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
