@extends('layouts.part')

@section('link')
    <link href="{{ asset('/css/search.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="{{ asset('/adminbsb/plugins/waitme/waitMe.css') }}" rel="stylesheet" />
@endsection

@section('title')
    <h2>DASHBOARD</h2>
@endsection

@section('breadcrumb')
    <li class="active"><i class="material-icons">home</i> Home</li>
@endsection

@section('content')
    <!-- top tiles -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">all_inbox</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL TERNAK</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">KELAHIRAN BARU</div>
                    <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">supervisor_account</i>
                </div>
                <div class="content">
                    <div class="text">PERKAWINAN BARU</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-indigo hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add_disabled</i>
                </div>
                <div class="content">
                    <div class="text">KEMATIAN BARU</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

    <!-- search -->
    <div class="s130">
        <form>
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                    <input id="search" type="text" placeholder="scan atau ketikkan necktag barcode" />
                </div>
                <div class="input-field second-wrap">
                    <button class="btn-search" type="button">SEARCH</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /search -->

    <!-- result -->
    <div style="display: none;">
        <div class="block-header">
            <h2>
                Detail Kambing - { nomor necktag }
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="card">
                    <div class="header bg-light-green">
                        <h2>
                            Amber - Title <small>Description text here...</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li>
                                <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="lightgreen">
                                    <i class="material-icons">loop</i>
                                </a>
                            </li>
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
                        Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /result -->
@endsection

@section('script')
    <script src="{{ asset('/adminbsb/plugins/waitme/waitMe.js') }}"></script>
    <script src="{{ asset('/adminbsb/js/pages/cards/colored.js') }}"></script>
@endsection