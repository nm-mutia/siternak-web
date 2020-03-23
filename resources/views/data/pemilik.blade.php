@extends('data.index')

@section('table')
<table id="pemilik-table" class="table table-bordered table-condensed table-striped">
	<thead>
	    <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>KTP</th>
            <th>Action</th>
	    </tr>
	</thead>
	<tfoot>
	    <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>KTP</th>
            <th>Action</th>
	    </tr>
	</tfoot>
</table>
@endsection

@push('script2')
<script>
	$('#pemilik-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.pemilik.index') }}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_pemilik', name: 'nama_pemilik'},
            {data: 'ktp', name: 'ktp'},
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
@endpush