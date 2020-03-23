@extends('data.index')

@push('link2')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('/adminbsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endpush

@section('table-content')
<div align="right">
    <button type="button" name="tambah_data" id="tambah_data" class="btn btn-success btn-sm">
        Tambah Data
    </button>
</div>
<br>
<!-- tabel -->
<div class="table-responsive">
    <table id="kematian-table" class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <!-- <th>ID</th> -->
                <th>Tanggal Kematian</th>
                <th>Waktu Kematian</th>
                <th>Penyebab</th>
                <th>Kondisi</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <!-- <th>ID</th> -->
                <th>Tanggal Kematian</th>
                <th>Waktu Kematian</th>
                <th>Penyebab</th>
                <th>Kondisi</th>
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
                        <label class="control-label">Tanggal Kematian</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="tgl_kematian" id="tgl_kematian" class="datepicker form-control" placeholder="Pilih tanggal...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Waktu Kematian</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">access_time</i>
                            </span>
                            <div class="form-line">
                                <input type="text" name="waktu_kematian" id="waktu_kematian" class="timepicker form-control" placeholder="Pilih waktu...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Penyebab</label>
                        <div class="form-line col-md-8">
                            <input type="text" name="penyebab" id="penyebab" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kondisi</label>
                        <div class="form-line col-md-8">
                            <input type="text" name="kondisi" id="kondisi" class="form-control">
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
        <div class="modal-content">
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
<!-- <script src="{{ asset('/adminbsb/js/pages/forms/basic-form-elements.js') }}"></script> -->
<script>
    $(function () {
    //Textarea auto growth
    autosize($('textarea.auto-growth'));

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    }, moment());

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    }, moment());
});
</script>
<script src="{{ asset('/adminbsb/plugins/momentjs/moment.js') }}"></script>
<script src="{{ asset('/adminbsb/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('#kematian-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.kematian.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'id', name: 'id'},
            {data: 'tgl_kematian', name: 'tgl_kematian'},
            {data: 'waktu_kematian', name: 'waktu_kematian'},
            {data: 'penyebab', name: 'penyebab'},
            {data: 'kondisi', name: 'kondisi'},
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
            action_url = "{{ route('admin.kematian.store') }}";
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

</script>
@endpush