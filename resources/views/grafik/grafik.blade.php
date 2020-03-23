@extends('layouts.part')

@push('link')
    <link href="{{ asset('/adminbsb/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
    <link href="{{ asset('/bootstrap/css/bootstrap.css.map') }}" rel="stylesheet" />
@endpush

@section('title')
    <h2>GRAFIK</h2>
@endsection

@section('breadcrumb')
    <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
    <li class="active"><i class="material-icons">attachment</i> Grafik </li>
@endsection

@section('content')
    <!-- Line Chart -->
    <div>
        <div class="card">
            <div class="header">
                <h2>Berdasarkan UMUR</h2>
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
                <div id="bar_chart" class="graph"></div>
            </div>
        </div>
    </div>
    <!-- #END# Line Chart -->
    <!-- Bar Chart -->
    <div>
        <div class="card">
            <div class="header">
                <h2>Berdasarkan RAS</h2>
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
                <div id="bar_chart" class="graph"></div>
            </div>
        </div>
    </div>
    <!-- #END# Bar Chart -->
    <!-- Area Chart -->
    <div>
        <div class="card">
            <div class="header">
                <h2>Berdasarkan KELAHIRAN</h2>
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
                <div id="area_chart" class="graph"></div>
            </div>
        </div>
    </div>
    <!-- #END# Area Chart -->
    <!-- Donut Chart -->
    <div>
        <div class="card">
            <div class="header">
                <h2>Berdasarkan KEMATIAN</h2>
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
                <div id="area_chart" class="graph"></div>
            </div>
        </div>
    </div>
    <!-- #END# Donut Chart -->
@endsection

@push('script')
	<script src="{{ asset('/adminbsb/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/adminbsb/plugins/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('/adminbsb/js/pages/charts/morris.js') }}"></script>
@endpush