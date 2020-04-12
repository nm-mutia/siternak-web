$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var start = moment().subtract(29, 'days');
var end = moment();
var from = '', to = '';

function cb(start, end) {
    $('#reportrange').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    from = start.format('YYYY-MM-DD');
    to = end.format('YYYY-MM-DD');
}

$('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    locale: {
    	"format": "YYYY-MM-DD"
    }
}, function(start, end, label) {
    $.ajax({
        url: "/admin/laporan",
        method: "GET", 
        data: {
            datefrom: start.format('YYYY-MM-DD'), 
            dateto: end.format('YYYY-MM-DD')
        },
        dataType: "json",
        success:function(data) {
            from = start.format('YYYY-MM-DD');
            to = end.format('YYYY-MM-DD');
            $('#date-span').html(data.start + ' sampai ' + data.end);

            $('#lahir-table').DataTable().ajax.reload();
            $('#mati-table').DataTable().ajax.reload();
            $('#kawin-table').DataTable().ajax.reload();
            $('#sakit-table').DataTable().ajax.reload();
            $('#ada-table').DataTable().ajax.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) { 
            console.log(jqXHR); 
        }
    });
});

cb(start, end);

$('#lahir-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/laporan/lahir',
        method: 'GET',
        data: function(d){
            d.datefrom = from;
            d.dateto = to;
        },
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'necktag', name: 'necktag'},
        {data: 'pemilik_id', name: 'pemilik_id'},
        {data: 'ras_id', name: 'ras_id'},
        {data: 'kematian_id', name: 'kematian_id'},
        {data: 'jenis_kelamin', name: 'jenis_kelamin'},
        {data: 'tgl_lahir', name: 'tgl_lahir'},
        {data: 'bobot_lahir', name: 'bobot_lahir'},
        {data: 'pukul_lahir', name: 'pukul_lahir'},
        {data: 'lama_dikandungan', name: 'lama_dikandungan'},
        {data: 'lama_laktasi', name: 'lama_laktasi'},
        {data: 'tgl_lepas_sapih', name: 'tgl_lepas_sapih'},
        {data: 'blood', name: 'blood'},
        {data: 'necktag_ayah', name: 'necktag_ayah'},
        {data: 'necktag_ibu', name: 'necktag_ibu'},
        {data: 'bobot_tubuh', name: 'bobot_tubuh'},
        {data: 'panjang_tubuh', name: 'panjang_tubuh'},
        {data: 'tinggi_tubuh', name: 'tinggi_tubuh'},
        {data: 'cacat_fisik', name: 'cacat_fisik'},
        {data: 'ciri_lain', name: 'ciri_lain'},
        {data: 'status_ada', name: 'status_ada'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
    ],
});

$('#mati-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/laporan/mati',
        method: 'GET',
        data: function(d){
            d.datefrom = from;
            d.dateto = to;
        },
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'necktag', name: 'necktag'},
        {data: 'kematian_id', name: 'kematian_id'},
        {data: 'tgl_kematian', name: 'tgl_kematian'},
        {data: 'waktu_kematian', name: 'waktu_kematian'},
        {data: 'penyebab', name: 'penyebab'},
        {data: 'kondisi', name: 'kondisi'},
        {data: 'pemilik_id', name: 'pemilik_id'},
        {data: 'ras_id', name: 'ras_id'},
        {data: 'jenis_kelamin', name: 'jenis_kelamin'},
        {data: 'tgl_lahir', name: 'tgl_lahir'},
        {data: 'bobot_lahir', name: 'bobot_lahir'},
        {data: 'pukul_lahir', name: 'pukul_lahir'},
        {data: 'lama_dikandungan', name: 'lama_dikandungan'},
        {data: 'lama_laktasi', name: 'lama_laktasi'},
        {data: 'tgl_lepas_sapih', name: 'tgl_lepas_sapih'},
        {data: 'blood', name: 'blood'},
        {data: 'necktag_ayah', name: 'necktag_ayah'},
        {data: 'necktag_ibu', name: 'necktag_ibu'},
        {data: 'bobot_tubuh', name: 'bobot_tubuh'},
        {data: 'panjang_tubuh', name: 'panjang_tubuh'},
        {data: 'tinggi_tubuh', name: 'tinggi_tubuh'},
        {data: 'cacat_fisik', name: 'cacat_fisik'},
        {data: 'ciri_lain', name: 'ciri_lain'},
        {data: 'status_ada', name: 'status_ada'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
    ],
});

$('#kawin-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/laporan/kawin',
        method: 'GET',
        data: function(d){
            d.datefrom = from;
            d.dateto = to;
        },
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'necktag', name: 'necktag'},
        {data: 'necktag_psg', name: 'necktag_psg'},
        {data: 'tgl', name: 'tgl'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
    ],
});

$('#sakit-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/laporan/sakit',
        method: 'GET',
        data: function(d){
            d.datefrom = from;
            d.dateto = to;
        },
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'penyakit_id', name: 'penyakit_id'},
        {data: 'necktag', name: 'necktag'},
        {data: 'tgl_sakit', name: 'tgl_sakit'},
        {data: 'obat', name: 'obat'},
        {data: 'lama_sakit', name: 'lama_sakit'},
        {data: 'keterangan', name: 'keterangan'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
    ],
});

$('#ada-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/laporan/ada',
        method: 'GET',
        data: function(d){
            d.datefrom = from;
            d.dateto = to;
        },
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'necktag', name: 'necktag'},
        {data: 'pemilik_id', name: 'pemilik_id'},
        {data: 'ras_id', name: 'ras_id'},
        {data: 'kematian_id', name: 'kematian_id'},
        {data: 'jenis_kelamin', name: 'jenis_kelamin'},
        {data: 'tgl_lahir', name: 'tgl_lahir'},
        {data: 'bobot_lahir', name: 'bobot_lahir'},
        {data: 'pukul_lahir', name: 'pukul_lahir'},
        {data: 'lama_dikandungan', name: 'lama_dikandungan'},
        {data: 'lama_laktasi', name: 'lama_laktasi'},
        {data: 'tgl_lepas_sapih', name: 'tgl_lepas_sapih'},
        {data: 'blood', name: 'blood'},
        {data: 'necktag_ayah', name: 'necktag_ayah'},
        {data: 'necktag_ibu', name: 'necktag_ibu'},
        {data: 'bobot_tubuh', name: 'bobot_tubuh'},
        {data: 'panjang_tubuh', name: 'panjang_tubuh'},
        {data: 'tinggi_tubuh', name: 'tinggi_tubuh'},
        {data: 'cacat_fisik', name: 'cacat_fisik'},
        {data: 'ciri_lain', name: 'ciri_lain'},
        {data: 'status_ada', name: 'status_ada'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
    ],
});

$('#dwd-btn').click(function(){
    var dateparam = {
        datefrom: from,
        dateto: to
    };
    var url = "/admin/laporan/export/" + $.param(dateparam);
    window.location = url;
});