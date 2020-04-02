@extends('layouts.part')

@push('link')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="{{ asset('/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('title')
<h2>LAPORAN</h2>
@endsection

@section('breadcrumb')
<li><a href="{{ route('admin') }}"><i class="material-icons">home</i> Home</a></li>
<li class="active"><i class="material-icons">archive</i> Laporan </li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Rentang Waktu</h2>
            </div>
            <div class="body">
                <form method="post" id="match_form">
                    @csrf

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" name="reportrange_val" id="reportrange_val" class="datepicker form-control" placeholder="Pilih tanggal...">
                                    </div>
                                    <span class="input-group-addon">
                                        <input type="submit" name="action" id="action" class="btn btn-primary" value="Filter">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>


                <div id="reportrange" style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- data laporan -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATA TERNAK <small>Laporan data ternak berdasarkan range waktu</small>
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
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#lahir" data-toggle="tab">LAHIR</a></li>
                    <li role="presentation"><a href="#mati" data-toggle="tab">MATI</a></li>
                    <li role="presentation"><a href="#kawin" data-toggle="tab">KAWIN</a></li>
                    <li role="presentation"><a href="#sakit" data-toggle="tab">SAKIT</a></li>
                    <li role="presentation"><a href="#ada" data-toggle="tab">TOTAL ADA</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="lahir">
                        <h4><b>Data Ternak Lahir</b></h4>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="mati">
                        <h4><b>Data Ternak Mati</b></h4>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="kawin">
                        <h4><b>Data Ternak Kawin</b></h4>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="sakit">
                        <h4><b>Data Ternak Sakit</b></h4>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="ada">
                        <h4><b>Data Ternak Ada</b></h4>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/js/laporan.js') }}"></script>

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