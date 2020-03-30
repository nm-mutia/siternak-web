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
		    	<th>No.</th>
		        <!-- <th>ID</th> -->
		        <th>Jenis Ras</th>
		        <th>Keterangan</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th width="150">Action</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
		    	<th>No.</th>
		        <!-- <th>ID</th> -->
		        <th>Jenis Ras</th>
		        <th>Keterangan</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th width="150">Action</th>
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
				<form method="post" id="tambah_data_form">
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
						<input type="hidden" name="hidden_id" id="hidden_id">
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
	$('#ras-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.ras.index') }}",
        columns: [
	        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'id', name: 'id'},
            {data: 'jenis_ras', name: 'jenis_ras'},
            {data: 'ket_ras', name: 'ket_ras'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false,sClass:'text-center'},
        ],
        // initComplete: function () {
        //     this.api().columns().every(function () {
        //         var column = this;
        //         var input = document.createElement("input");
        //         $(input).appendTo($(column.footer()).empty())
        //         .on('change', function () {
        //             column.search($(this).val(), false, false, true).draw();
        //         });
        //     });
        // }
    });
</script>
<script src="{{ asset('/js/data/dataras.js') }}"></script>
@endpush