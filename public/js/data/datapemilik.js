	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tambah_data').click(function(){
        $('.modal-title').text('Tambah Data - Pemilik');
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
            action_url = "/admin/pemilik";
            method_form = "POST";
        }

        //edit
        if($('#action').val() == 'Edit'){
            var updateId = $('#hidden_id').val();
            action_url = "/admin/pemilik/"+updateId;
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
                    $('#pemilik-table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            }
        });
    });

    //edit
    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/admin/pemilik/"+id+"/edit",
            datatype: "json",
            success: function(data){
                $('#nama_pemilik').val(data.result.nama_pemilik);
                $('#ktp').val(data.result.ktp);
                $('#hidden_id').val(id);
                $('#action').val('Edit');
                $('#action_button').val('Edit');
                $('.modal-title').text('Edit Data - Pemilik');
                $('#formModal').modal('show');
            }
        });
    });

    //delete
    var pemilik_id;
    $(document).on('click', '.delete', function(){
        pemilik_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
        $.ajax({
            url:"/admin/pemilik/"+pemilik_id,
            method: "DELETE",
            beforeSend: function(){
                $('#ok_button').text('Deleting...');
            },
            success: function(data){
                setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#pemilik-table').DataTable().ajax.reload();
                    alert('Data Deleted');
                    $('#ok_button').text('OK');
                }, 1000);
            }
        });
    });