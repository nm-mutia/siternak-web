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
	<table id="ras-table" class="table table-bordered table-condensed table-striped">
		<thead>
		    <tr>
		        <th>ID</th>
		        <th>Jenis Ras</th>
		        <th>Keterangan</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th>Action</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
		        <th>ID</th>
		        <th>Jenis Ras</th>
		        <th>Keterangan</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th>Action</th>
		    </tr>
		</tfoot>
	</table>
</div>

<!-- form tambah data -->
<div id="formModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Data - {{ $page }}</h4>
			</div>
			<div class="modal-body">
				<span id="form-result"></span>
				<form method="post" id="tambah_data_form" class="form-horizontal">
					@csrf

					<div class="form-group">
						<label class="control-label">Jenis Ras</label>
						<div class="form-line col-md-8">
							<input type="text" name="jenis_ras" id="jenis_ras" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Keterangan</label>
						<div class="form-line col-md-8">
							<input type="text" name="ket_ras" id="ket_ras" class="form-control">
						</div>
					</div>
					<br>
					<div class="form-group" align="center">
						<input type="hidden" name="action" id="action" value="Add">
						<input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script2')
<script>
// $(document).ready(function(){
	$('#ras-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.ras.index') }}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'jenis_ras', name: 'jenis_ras'},
            {data: 'ket_ras', name: 'ket_ras'},
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
    	$('#formModal').modal('show');
    });

    $('#tambah_data_form').on('submit', function(event){
    	event.preventDefault();

    	var action_url = '';
    	if($('action').val() == 'Add'){
    		action_url = "{{ route('admin.ras.store') }}";
    	}

    	$.ajax({
    		url: action_url,
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
    				$('#tambah_data_form')[0].reset();
    				$('#ras-table').DataTable().ajax.reload();
    			}

    			$('#form-result').html(html);
    		}
    	});
    });
// });
</script>
@endpush