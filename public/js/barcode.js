// $('#barcode-table').DataTable({
//     processing: true,
//     serverSide: true,
//     ajax: {
//         url: '/admin/barcode',
//         method: 'GET',
//         data: function(d){
//             d.datefrom = from;
//             d.dateto = to;
//         },
//     },
//     columns: [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex'},
//         {data: 'necktag', name: 'necktag'},
//         {data: 'image/png;base64,{{DNS1D::getBarcodePNG($data->necktag, 'C128')}}', name: 'barcode'},
//     ],
// });

// $('#bar-dwd-btn').click(function(){
//     // var dateparam = {
//     //     datefrom: from,
//     //     dateto: to
//     // };
//     // var url = "/admin/laporan/export/" + $.param(dateparam);
//     var url = "/admin/barcode/pdf";
//     window.location = url;
// });