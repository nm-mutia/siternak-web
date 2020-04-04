@extends('data.index')

@section('table-content')
<div align="left">
    <button type="button" name="tambah_data" id="tambah_data" class="btn btn-success btn-sm">
		Tambah Data
	</button>
</div>
<br>
<!-- tabel -->
<div class="table-responsive">
	{{ $dataTable->table(['class' => 'table table-bordered table-condensed table-striped']) }}
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

					<div class="form-group" id="necktag_form">
						<label class="control-label">Necktag</label>
						<div class="form-line col-md-8">
							<input type="text" name="necktag" id="necktag" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Pemilik</label>
						<div>
							<select class="form-control js-select-search" name="pemilik_id" id="pemilik_id">
								<option></option>
							  	@foreach ($pemilik as $pid)
							    <option value="{{ $pid->id }}">{{ $pid->nama_pemilik }}</option>
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Ras</label>
						<div>
							<select class="form-control js-select-search" name="ras_id" id="ras_id">
								<option></option>
							  	@foreach ($ras as $rid)
							    <option value="{{ $rid->id }}">{{ $rid->jenis_ras }}</option>
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group" id="kematian_form">
						<label class="control-label">Kematian</label>
						<div>
							<select class="form-control js-select-search" name="kematian_id" id="kematian_id">
								<option></option>
							  	@foreach ($kematian as $kid)
							    <option value="{{ $kid->id }}">{{ $kid->tgl_kematian }} - {{ $kid->waktu_kematian }} - {{ $kid->penyebab }} - {{ $kid->kondisi }}</option>
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Jenis Kelamin</label>
						<div class="form-line col-md-8">
							<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" class="form-control">
								<option value="Jantan">Jantan</option>
							    <option value="Betina">Betina</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Lahir</label>
						<div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="datepicker form-control" placeholder="Pilih tanggal...">
                            </div>
                        </div>
					</div>
					<div class="form-group">
						<label class="control-label">Bobot Lahir</label>
						<div class="form-line col-md-8">
							<input type="text" name="bobot_lahir" id="bobot_lahir" class="form-control" placeholder="dalam kilogram">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Pukul Lahir</label>
						<div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">access_time</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="pukul_lahir" id="pukul_lahir" class="timepicker form-control" placeholder="Pilih waktu...">
                            </div>
                        </div>
					</div>
					<div class="form-group">
						<label class="control-label">Lama di Kandungan</label>
						<div class="form-line col-md-8">
							<input type="text" name="lama_dikandungan" id="lama_dikandungan" class="form-control" placeholder="dalam hari">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Lama Laktasi</label>
						<div class="form-line col-md-8">
							<input type="text" name="lama_laktasi" id="lama_laktasi" class="form-control" placeholder="dalam hari">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Lepas Sapih</label>
						<div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="tgl_lepas_sapih" id="tgl_lepas_sapih" class="datepicker form-control" placeholder="Pilih tanggal...">
                            </div>
                        </div>
					</div>
					<div class="form-group">
						<label class="control-label">Blood</label>
						<div class="form-line col-md-8">
							<input type="text" name="blood" id="blood" class="form-control" placeholder="golongan darah">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Ayah</label>
						<div>
							<select class="form-control js-select-search" name="necktag_ayah" id="necktag_ayah">
								<option></option>
							  	@foreach ($data as $tay)
								  	@if ($tay->jenis_kelamin == 'Jantan')
									    <option value="{{ $tay->necktag }}">{{ $tay->necktag }} - Ras {{ $tay->ras_id }}</option>
								    @endif
								@endforeach    
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Ibu</label>
						<div>
							<select class="form-control js-select-search" name="necktag_ibu" id="necktag_ibu">
								<option></option>
							  	@foreach ($data as $tib)
								    @if ($tib->jenis_kelamin == 'Betina')
									    <option value="{{ $tib->necktag }}">{{ $tib->necktag }} - Ras {{ $tib->ras_id }}</option>
								    @endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Bobot Tubuh</label>
						<div class="form-line col-md-8">
							<input type="text" name="bobot_tubuh" id="bobot_tubuh" class="form-control" placeholder="dalam kilogram">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Panjang Tubuh</label>
						<div class="form-line col-md-8">
							<input type="text" name="panjang_tubuh" id="panjang_tubuh" class="form-control" placeholder="dalam centimeter">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Tinggi Tubuh</label>
						<div class="form-line col-md-8">
							<input type="text" name="tinggi_tubuh" id="tinggi_tubuh" class="form-control" placeholder="dalam centimeter">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Cacat Fisik</label>
						<div class="form-line col-md-8">
							<input type="text" name="cacat_fisik" id="cacat_fisik" class="form-control" placeholder="kosongkan bila tidak ada">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Ciri Lain</label>
						<div class="form-line col-md-8">
							<input type="text" name="ciri_lain" id="ciri_lain" class="form-control" placeholder="kosongkan bila tidak ada">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Status Kambing</label>
						<div class="form-line col-md-8">
							<select class="form-control" name="status_ada" id="status_ada">
								<option value="true">Ada</option>
							    <option value="false">Tidak ada</option>
							</select>
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

<!-- modal view -->
<div id="viewModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Data - {{ $page }}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label">Pemilik</label>
					<div class="form-line col-md-8">
						<input type="text" name="pemilik_id" id="vpemilik_id" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Ras</label>
					<div class="form-line col-md-8">
						<input type="text" name="ras_id" id="vras_id" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group" id="kematian_form">
					<label class="control-label">Kematian</label>
					<div class="form-line col-md-8">
						<input type="text" name="kematian_id" id="vkematian_id" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Jenis Kelamin</label>
					<div class="form-line col-md-8">
						<input type="text" name="jenis_kelamin" id="vjenis_kelamin" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Tanggal Lahir</label>
					<div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" name="tgl_lahir" id="vtgl_lahir" class="form-control" readonly="true">
                        </div>
                    </div>
				</div>
				<div class="form-group">
					<label class="control-label">Bobot Lahir</label>
					<div class="form-line col-md-8">
						<input type="text" name="bobot_lahir" id="vbobot_lahir" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Pukul Lahir</label>
					<div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">access_time</i>
                        </span>
                        <div class="form-line">
                            <input type="text" name="pukul_lahir" id="vpukul_lahir" class="form-control" readonly="true">
                        </div>
                    </div>
				</div>
				<div class="form-group">
					<label class="control-label">Lama di Kandungan</label>
					<div class="form-line col-md-8">
						<input type="text" name="lama_dikandungan" id="vlama_dikandungan" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Lama Laktasi</label>
					<div class="form-line col-md-8">
						<input type="text" name="lama_laktasi" id="vlama_laktasi" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Tanggal Lepas Sapih</label>
					<div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" name="tgl_lepas_sapih" id="vtgl_lepas_sapih" class="form-control" readonly="true">
                        </div>
                    </div>
				</div>
				<div class="form-group">
					<label class="control-label">Blood</label>
					<div class="form-line col-md-8">
						<input type="text" name="blood" id="vblood" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Ayah</label>
					<div class="form-line col-md-8">
						<input type="text" name="necktag_ayah" id="vnecktag_ayah" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Ibu</label>
					<div class="form-line col-md-8">
						<input type="text" name="necktag_ibu" id="vnecktag_ibu" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Bobot Tubuh</label>
					<div class="form-line col-md-8">
						<input type="text" name="bobot_tubuh" id="vbobot_tubuh" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Panjang Tubuh</label>
					<div class="form-line col-md-8">
						<input type="text" name="panjang_tubuh" id="vpanjang_tubuh" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Tinggi Tubuh</label>
					<div class="form-line col-md-8">
						<input type="text" name="tinggi_tubuh" id="vtinggi_tubuh" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Cacat Fisik</label>
					<div class="form-line col-md-8">
						<input type="text" name="cacat_fisik" id="vcacat_fisik" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Ciri Lain</label>
					<div class="form-line col-md-8">
						<input type="text" name="ciri_lain" id="vciri_lain" class="form-control" readonly="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Status Kambing</label>
					<div class="form-line col-md-8">
						<input type="text" name="status_ada" id="vstatus_ada" class="form-control" readonly="true">
					</div>
				</div>

				<!-- riwayat -->
				<div>
					<label class="control-label">Riwayat Penyakit</label>
					<div>
						<span id="span-rp"></span>
						<table id="riwayat-penyakit" class="table">
							
						</table>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script2')
{{ $dataTable->scripts() }}
<!-- <script>
	$('#ternak-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.ternak.index') }}",
        columns: [
	        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'necktag', name: 'necktag'},
            // {data: 'pemilik_id', name: 'pemilik_id'},
            {data: 'ras_id', name: 'ras_id'},
            // {data: 'kematian_id', name: 'kematian_id'},
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            // {data: 'tgl_lahir', name: 'tgl_lahir'},
            // {data: 'bobot_lahir', name: 'bobot_lahir'},
            // {data: 'pukul_lahir', name: 'pukul_lahir'},
            // {data: 'lama_dikandungan', name: 'lama_dikandungan'},
            // {data: 'lama_laktasi', name: 'lama_laktasi'},
            // {data: 'tgl_lepas_sapih', name: 'tgl_lepas_sapih'},
            {data: 'blood', name: 'blood'},
            // {data: 'necktag_ayah', name: 'necktag_ayah'},
            // {data: 'necktag_ibu', name: 'necktag_ibu'},
            // {data: 'bobot_tubuh', name: 'bobot_tubuh'},
            // {data: 'panjang_tubuh', name: 'panjang_tubuh'},
            // {data: 'tinggi_tubuh', name: 'tinggi_tubuh'},
            // {data: 'cacat_fisik', name: 'cacat_fisik'},
            // {data: 'ciri_lain', name: 'ciri_lain'},
            {data: 'status_ada', name: 'status_ada'},
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
</script> -->
<script src="{{ asset('/js/data/dataternak.js') }}"></script>
@endpush