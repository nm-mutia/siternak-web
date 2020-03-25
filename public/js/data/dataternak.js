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
    var ternak_id;
    $(document).on('click', '.delete', function(){
    	ternak_id = $(this).attr('id');
    	$('#confirmModal').modal('show');
 	});

 	$('#ok_button').click(function(){
  		$.ajax({
   			url:"/admin/ternak/"+ternak_id,
   			method: "DELETE",
   			beforeSend: function(){
    			$('#ok_button').text('Deleting...');
   			},
	   		success: function(data){
	    		setTimeout(function(){
	     			$('#confirmModal').modal('hide');
	     			$('#ternak-table').DataTable().ajax.reload();
	     			alert('Data Deleted');
                    $('#ok_button').text('OK');
	    		}, 1000);
	   		},
            error: function (jqXHR, textStatus, errorThrown) { 
                console.log(jqXHR); 
            }
  		});
  	});
