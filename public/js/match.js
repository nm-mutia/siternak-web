$(function () {
    $('.js-select-search').select2({ width: '100%' });
});

$('#match_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
        url: "/admin/match/ternak",
        method: "GET",
        data: $(this).serialize(),
        datatype: "json",
        success: function(data){
            if(data.result == 'gagal'){
                swal({
                    title: "Tidak Boleh!",
                    type: "error",
                    text: data.message,
                });
            }else{
                swal({
                    title: "Boleh!",
                    type: "success",
                    text: "Ternak boleh dikawinkan!",
                });
            }            
        },
        error: function (jqXHR, textStatus, errorThrown) { 
            console.log(jqXHR); 
        }
    });
});