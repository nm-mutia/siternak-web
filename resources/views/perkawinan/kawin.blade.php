@extends('layouts.part')

@push('link')
    <link href="{{ asset('/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- Dropzone Css -->
    <link href="{{ asset('/adminbsb/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <!-- Multi Select Css -->
    <link href="{{ asset('/adminbsb/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">
    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('/adminbsb/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">
    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('title')
    <h2>PERKAWINAN - KECOCOKAN TERNAK</h2>
@endsection

@section('breadcrumb')
    <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
    <li class="active"><i class="material-icons">attachment</i> Perkawinan</li>
@endsection

@section('content')
	 <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Pilih Kode Ternak yang Ingin Dipasangkan</h2>
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
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <p>
                                <b>Jantan</b>
                            </p>
                            <select class="form-control show-tick" data-live-search="true">
                                <option>Hot Dog, Fries and a Soda</option>
                                <option>Burger, Shake and a Smile</option>
                                <option>Sugar, Spice and all things nice</option>
                            </select>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <p>
                                <b>Betina</b>
                            </p>
                            <select class="form-control show-tick" data-live-search="true">
                                <option>Hot Dog, Fries and a Soda</option>
                                <option>Burger, Shake and a Smile</option>
                                <option>Sugar, Spice and all things nice</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
	<script src="{{ asset('/adminbsb/js/pages/forms/advanced-form-elements.js') }}"></script>
	<!-- Dropzone Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/dropzone/dropzone.js') }}"></script>
    <!-- Input Mask Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <!-- Jquery Spinner Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/jquery-spinner/js/jquery.spinner.js') }}"></script>
    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
@endpush