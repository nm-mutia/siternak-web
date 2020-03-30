$('#g-lahir-2018').click(function(){

	$.ajax({
		url: "/admin/grafik/lahir",
		method: "GET",
		data: {
			tahun: '2018'
		},
		datatype: "json",
		success: function(data){
			console.log("sukses");
		},
		error: function (jqXHR, textStatus, errorThrown) { 
			console.log(jqXHR); 
		}
	});

});