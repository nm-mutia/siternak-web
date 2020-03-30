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
	<table id="perkawinan-table" class="table table-bordered table-condensed table-striped">
		<thead>
		    <tr>
		    	<th>No.</th>
		        <!-- <th>ID</th> -->
		        <th>Necktag</th>
		        <th>Necktag Pasangan</th>
		        <th>Tanggal Kawin</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th width="150">Action</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
		    	<th>No.</th>
		        <!-- <th>ID</th> -->
		        <th>Necktag</th>
		        <th>Necktag Pasangan</th>
		        <th>Tanggal Kawin</th>
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
						<label class="control-label">Necktag</label>
						<div>
							<select class="form-control js-select-search" name="necktag" id="necktag">
								<option></option>
							  	@foreach ($ternak as $tid)
							  	@if ($tid->jenis_kelamin == 'Jantan')
								    <option value="{{ $tid->necktag }}">{{ $tid->necktag }} - Ras {{ $tid->ras_id }} - {{ $tid->jenis_kelamin }}</option>
							    @endif
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Necktag Pasangan</label>
						<div>
							<select class="form-control js-select-search" name="necktag_psg" id="necktag_psg">
								<option></option>
							  	@foreach ($ternak as $tid)
							  	@if ($tid->jenis_kelamin == 'Betina')
								    <option value="{{ $tid->necktag }}">{{ $tid->necktag }} - Ras {{ $tid->ras_id }} - {{ $tid->jenis_kelamin }}</option>
							    @endif
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Kawin</label>
						<div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="tgl" id="tgl" class="datepicker form-control" placeholder="Pilih tanggal...">
                            </div>
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
	$('#perkawinan-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.perkawinan.index') }}",
        columns: [
	        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'id', name: 'id'},
            {data: 'necktag', name: 'necktag'},
            {data: 'necktag_psg', name: 'necktag_psg'},
            {data: 'tgl', name: 'tgl'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false, sClass:'text-center'},
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
<script src="{{ asset('/js/data/dataperkawinan.js') }}"></script>
@endpush