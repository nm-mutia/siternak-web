@extends('layouts.part')

@push('link')
<!-- <link href="{{ asset('/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->
<link href="{{ asset('/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('title')
<h2>DATA - {{ $title }}</h2>
@endsection

@section('breadcrumb')
<li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
<li><i class="material-icons">widgets</i> Data </li>
<li class="active"><i class="material-icons">attachment</i> {{ $page }} </li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $title }}
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">

                @yield('table-content')
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/datatable/dataTables.bootstrap4.min.js') }}"></script>

<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script> -->
<!-- <script src="{{ asset('/adminbsb/js/pages/tables/jquery-datatable.js') }}"></script> -->
@stack('script2')
@endpush