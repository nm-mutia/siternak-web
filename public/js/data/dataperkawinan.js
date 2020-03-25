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
    var ras_id;
    $(document).on('click', '.delete', function(){
    	ras_id = $(this).attr('id');
    	$('#confirmModal').modal('show');
 	});

 	$('#ok_button').click(function(){
  		$.ajax({
   			url:"/admin/perkawinan/"+ras_id,
   			method: "DELETE",
   			beforeSend: function(){
    			$('#ok_button').text('Deleting...');
   			},
	   		success: function(data){
	    		setTimeout(function(){
	     			$('#confirmModal').modal('hide');
	     			$('#perkawinan-table').DataTable().ajax.reload();
	     			alert('Data Deleted');
	    		}, 1000);
	   		},
            error: function (jqXHR, textStatus, errorThrown) { 
                console.log(jqXHR); 
            }
  		});
  	});