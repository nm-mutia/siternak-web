	$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
	});

	$('#tambah_data').click(function(){
    	$('.modal-title').text('Tambah Data - Penyakit');
    	$('#action_button').val('Add');
    	$('#action').val('Add');
    	$('#form_result').html('');
        $('#tambah_data_form')[0].reset();
    	$('#formModal').modal('show');
    });

    $('#tambah_data_form').on('submit', function(event){
    	event.preventDefault();
    	var action_url = '';
    	var method_form = '';

    	//tambah
    	if($('#action').val() == 'Add'){
    		action_url = "/admin/penyakit";
    		method_form = "POST";
    	}

    	//edit
    	if($('#action').val() == 'Edit'){
    		var updateId = $('#hidden_id').val();
    		action_url = "/admin/penyakit/"+updateId;
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
    				$('#penyakit-table').DataTable().ajax.reload();
    			}
    			$('#form_result').html(html);
    		}
    	});
    });

    //view
    $(document).on('click', '.view', function(){
        var id = $(this).attr('id');
        var txt = '', txt2 = '';
        var rp = [];

        txt = '<tr>';
        txt += '<th>Necktag</th>';
        txt += '<th>Tanggal Sakit</th>';
        txt += '<th>Obat</th>';
        txt += '<th>Lama Sakit</th>';
        txt += '<th>Keterangan</th>';
        txt += '</tr>';

        $.ajax({
            url: "/admin/penyakit/"+id, //show
            datatype: "json",
            success: function(data){
                $('#vnama_penyakit').val(data.result.nama_penyakit);
                $('#vketerangan').val(data.result.keterangan);
                $('#vcreated_at').val(data.result.created_at);
                $('#vupdated_at').val(data.result.updated_at);

                if(data.riwayat != ''){
                    $('#riwayat-penyakit').empty().append(txt);
                    $.each(data.riwayat, function(i, val) {
                        var rp1 = data.riwayat[i].rp_penyakit.split('(');
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
                    $('#span-rp').html('<p align="center">Tidak ada data riwayat penyakit ini pada ternak</p>');
                    $('#riwayat-penyakit').hide();
                }

                $('.modal-title').text('Data Penyakit - '+id);
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
    		url: "/admin/penyakit/"+id+"/edit",
    		datatype: "json",
    		success: function(data){
    			$('#nama_penyakit').val(data.result.nama_penyakit);
    			$('#ket_penyakit').val(data.result.ket_penyakit);
    			$('#hidden_id').val(id);
		    	$('#action').val('Edit');
    			$('#action_button').val('Edit');
    			$('.modal-title').text('Edit Data - Penyakit');
		    	$('#formModal').modal('show');
    		}
    	});
    });

    //delete
    var ras_id;
    $(document).on('click', '.delete', function(){
    	ras_id = $(this).attr('id');
    	$('#confirmModal').modal('show');
 	});

 	$('#ok_button').click(function(){
  		$.ajax({
   			url:"/admin/penyakit/"+ras_id,
   			method: "DELETE",
   			beforeSend: function(){
    			$('#ok_button').text('Deleting...');
   			},
	   		success: function(data){
	    		setTimeout(function(){
	     			$('#confirmModal').modal('hide');
	     			$('#penyakit-table').DataTable().ajax.reload();
	     			alert('Data Deleted');
                    $('#ok_button').text('OK');
	    		}, 1000);
	   		}
  		});
  	});