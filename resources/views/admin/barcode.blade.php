@extends('layouts.part')

@push('link')

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
	<table  width="100%"> 
    	<tr> 
       		@foreach($ternak  as $data) 
       		<td align="center"  style="border: lpx solid #ccc">{{$data->necktag}}<br>
       			<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($data->necktag, 'C39')}}" height="60" width="180">
      			<br>{{$data->necktag }}
      		</td>
     		@if ($no++ %3 ==0)
           		</tr><tr>
      		@endif
    		@endforeach
    	</tr>
   </table>
</div>
@endsection

@push('script')

@endpush