@extends('data.index')

@section('table-content')
<div align="right">
    <button type="button" name="tambah_data" id="tambah_data" class="btn btn-success btn-sm">
		Tambah Data
	</button>
</div>
<br>
<!-- tabel -->
<div class="table-responsive">
	<table id="ternak-table" class="table table-bordered table-condensed table-striped">
		<thead>
		    <tr>
		    	<th>No.</th>
		        <th>Necktag</th>
		        <th>ID Pemilik</th>
		        <th>ID Ras</th>
		        <th>ID Kematian</th>
		        <th>Jenis Kelamin</th>
		        <th>Tanggal Lahir</th>
		        <th>Bobot Lahir</th>
		        <th>Pukul Lahir</th>
		        <th>Lama di Kandungan</th>
		        <th>Lama Laktasi</th>
		        <th>Tanggal Lepas Sapih</th>
		        <th>Blood</th>
		        <th>Ayah</th>
		        <th>Ibu</th>
		        <th>Bobot Tubuh</th>
		        <th>Panjang Tubuh</th>
		        <th>Tinggi Tubuh</th>
		        <th>Cacat Fisik</th>
		        <th>Ciri Lain</th>
		        <th>Status Ada</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th>Action</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
		    	<th>No.</th>
		        <th>Necktag</th>
		        <th>ID Pemilik</th>
		        <th>ID Ras</th>
		        <th>ID Kematian</th>
		        <th>Jenis Kelamin</th>
		        <th>Tanggal Lahir</th>
		        <th>Bobot Lahir</th>
		        <th>Pukul Lahir</th>
		        <th>Lama di Kandungan</th>
		        <th>Lama Laktasi</th>
		        <th>Tanggal Lepas Sapih</th>
		        <th>Blood</th>
		        <th>Ayah</th>
		        <th>Ibu</th>
		        <th>Bobot Tubuh</th>
		        <th>Panjang Tubuh</th>
		        <th>Tinggi Tubuh</th>
		        <th>Cacat Fisik</th>
		        <th>Ciri Lain</th>
		        <th>Status Ada</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th>Action</th>
		    </tr>
		</tfoot>
	</table>
</div>

<!-- form modal -->
<div id="formModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Data - {{ $page }}</h4>
			</div>
			<div class="modal-body">
				<span id="form_result"></span>
				<form method="post" id="tambah_data_form" class="form-horizontal">
					@csrf

					<div class="form-group">
						<label class="control-label">Nama Penyakit</label>
						<div class="form-line col-md-8">
							<input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Keterangan</label>
						<div class="form-line col-md-8">
							<input type="text" name="ket_penyakit" id="ket_penyakit" class="form-control">
						</div>
					</div>
					<br>
					<div class="form-group" align="center">
						<input type="hidden" name="action" id="action" value="Add">
						<input type="hidden" name="hidden_id" id="hidden_id">
						<input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal delete -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
            	<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script2')
<script>
	$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
	});

	$('#penyakit-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.penyakit.index') }}",
        columns: [
	        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'id', name: 'id'},
            {data: 'nama_penyakit', name: 'nama_penyakit'},
            {data: 'ket_penyakit', name: 'ket_penyakit'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
    });

    $('#tambah_data').click(function(){
    	$('.modal-title').text('Tambah Data - Penyakit');
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
    		action_url = "{{ route('admin.penyakit.store') }}";
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
	    		}, 1000);
	   		}
  		});
  	});

</script>
@endpush