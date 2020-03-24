	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tambah_data').click(function(){
        $('.modal-title').text('Tambah Data - Ternak Mati');
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
            action_url = "/admin/kematian";
            method_form = "POST";
        }

        //edit
        if($('#action').val() == 'Edit'){
            var updateId = $('#hidden_id').val();
            action_url = "/admin/kematian/"+updateId;
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
                    $('#kematian-table').DataTable().ajax.reload();
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
            url: "/admin/kematian/"+id+"/edit",
            datatype: "json",
            success: function(data){
                $('#tgl_kematian').val(data.result.tgl_kematian);
                $('#waktu_kematian').val(data.result.waktu_kematian);
                $('#penyebab').val(data.result.penyebab);
                $('#kondisi').val(data.result.kondisi);
                $('#hidden_id').val(id);
                $('#action').val('Edit');
                $('#action_button').val('Edit');
                $('.modal-title').text('Edit Data - Ternak Mati');
                $('#formModal').modal('show');
            }
        });
    });

    //delete
    var kematian_id;
    $(document).on('click', '.delete', function(){
        kematian_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
        $.ajax({
            url:"/admin/kematian/"+kematian_id,
            method: "DELETE",
            beforeSend: function(){
                $('#ok_button').text('Deleting...');
            },
            success: function(data){
                setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#kematian-table').DataTable().ajax.reload();
                    alert('Data Deleted');
                }, 1000);
            }
        });
    });