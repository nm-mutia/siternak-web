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
	<table id="riwayat-table" class="table table-bordered table-condensed table-striped">
		<thead>
		    <tr>
		    	<th>No.</th>
		        <th>Penyakit</th>
		        <th>Necktag</th>
		        <th>Tanggal Sakit</th>
		        <th>Obat</th>
		        <th>Lama Sakit</th>
		        <th>Keterangan</th>
		        <th>Created At</th>
		        <th>Updated At</th>
		        <th>Action</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
		    	<th>No.</th>
		        <th>Penyakit</th>
		        <th>Necktag</th>
		        <th>Tanggal Sakit</th>
		        <th>Obat</th>
		        <th>Lama Sakit</th>
		        <th>Keterangan</th>
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
						<label class="control-label">Penyakit</label>
						<div>
							<select class="form-control js-select-search" name="penyakit_id" id="penyakit_id">
								<option></option>
							  	@foreach ($penyakit as $pid)
							    <option value="{{ $pid->id }}">{{ $pid->nama_penyakit }}</option>
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Necktag</label>
						<div>
							<select class="form-control js-select-search" name="necktag" id="necktag">
								<option></option>
							  	@foreach ($ternak as $tid)
							    <option value="{{ $tid->necktag }}">{{ $tid->necktag }} - Ras {{ $tid->ras_id }}</option>
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Sakit</label>
						<div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="tgl_sakit" id="tgl_sakit" class="datepicker form-control" placeholder="Pilih tanggal...">
                            </div>
                        </div>
					</div>
					<div class="form-group">
						<label class="control-label">Obat</label>
						<div class="form-line col-md-8">
							<input type="text" name="obat" id="obat" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Lama Sakit</label>
						<div class="form-line col-md-8">
							<input type="text" name="lama_sakit" id="lama_sakit" class="form-control" placeholder="dalam hari">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Keterangan</label>
						<div class="form-line col-md-8">
							<input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="kosongkan jika tidak ada">
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
	$('#riwayat-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.riwayat.index') }}",
        columns: [
	        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'penyakit_id', name: 'penyakit_id'},
            {data: 'necktag', name: 'necktag'},
            {data: 'tgl_sakit', name: 'tgl_sakit'},
            {data: 'obat', name: 'obat'},
            {data: 'lama_sakit', name: 'lama_sakit'},
            {data: 'keterangan', name: 'keterangan'},
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
<script src="{{ asset('/js/data/datariwayat.js') }}"></script>
@endpush