@extends('layouts.part')

@push('link')
<!-- <link href="{{ asset('/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->
@endpush

@section('title')
<h2>GENERATE BARCODE - NECKTAG</h2>
@endsection

@section('breadcrumb')
<li><a href="{{ route('admin') }}"><i class="material-icons">home</i> Home </a></li>
<li class="active"><i class="material-icons">view_week</i> Barcode </li>
@endsection

@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header row">
                <h2 class="col-md-9">
                    BARCODE NECKTAG 
                    <small>Barcode necktag pada ternak</small>
                </h2>
                <div class="col-md-3" align="right">
                	<a href="{{ route('admin.barcode.pdf') }}" target="_blank">
	                    <button id="bar-dwd-btn" class="btn">
	                        <i class="material-icons">file_download</i>
	                        <span class="icon-name">Download Barcode Necktag</span>
	                    </button>
                    </a>
                </div>
            </div>
            <div class="body">

                <table width="100%" id="barcode-table" class="table table-bordered"> 
                    <tbody>
                    	<tr>
                    	@foreach($ternak as $data)
                    		<td>{{ $no }}</td>		       		 
				       		<td align="center"  style="border: lpx solid #ccc">{{ $data->necktag }}<br>
				       			<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($data->necktag, 'C128')}}" height="60" width="180">
				      			<br>{{ $data->necktag }}
				      		</td>
					    	@if($no++ %3 == 0)
					    		<tr></tr>
					    	@endif
				    	@endforeach
				    	</tr>
                    </tbody>
			   </table>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('/js/barcode.js') }}"></script>

<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/js/pages/tables/jquery-datatable.js') }}"></script> -->
@endpush