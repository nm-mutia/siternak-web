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
		        <th>Action</th>
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
				<form method="post" id="tambah_data_form">
					@csrf

					<div class="form-group">
						<label class="control-label">Necktag</label>
						<div class="form-line col-md-8">
							<select class="form-control js-select-search" name="necktag" id="necktag">
								<option></option>
							  	@foreach ($ternak as $tid)
							    <option value="{{ $tid->necktag }}">{{ $tid->necktag }} - {{ $tid->ras_id }}</option>
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Necktag Pasangan</label>
						<div class="form-line col-md-8">
							<select class="form-control js-select-search" name="necktag_psg" id="necktag_psg">
								<option></option>
							  	@foreach ($ternak as $tid)
							    <option value="{{ $tid->necktag }}">{{ $tid->necktag }} - {{ $tid->ras_id }}</option>
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

<!-- modal delete -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" data-type="confirm">
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
</script>
<script src="{{ asset('/js/data/dataperkawinan.js') }}"></script>
@endpush