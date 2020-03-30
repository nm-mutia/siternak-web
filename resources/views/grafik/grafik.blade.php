@extends('layouts.part')

@push('link')
<link href="{{ asset('/bootstrap/css/bootstrap.css.map') }}" rel="stylesheet" />
@endpush

@section('title')
<h2>GRAFIK</h2>
@endsection

@section('breadcrumb')
<li><a href="{{ route('admin') }}"><i class="material-icons">home</i> Home</a></li>
<li class="active"><i class="material-icons">pie_chart</i> Grafik </li>
@endsection

@section('content')
<div>
    <div class="card">
        <div class="header">
            <h2>Berdasarkan UMUR</h2>
        </div>
        <div class="body">
            <div style="width: 80%;margin: 0 auto;">
                {{ $umur->container() }}
            </div>
        </div>
    </div>
</div>
<div>
    <div class="card">
        <div class="header">
            <h2>Berdasarkan RAS</h2>
        </div>
        <div class="body">
            <div style="width: 80%;margin: 0 auto;">
                {{ $ras->container() }}
            </div>
        </div>
    </div>
</div>
<div>
    <div class="card">
        <div class="header">
            <h2>Berdasarkan KELAHIRAN</h2>
            <ul class="header-dropdown m-r--5">
                <!-- <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" id="g-lahir-2018">2018</a></li>
                        <li><a href="javascript:void(0);" id="g-lahir-2019">2019</a></li>
                        <li><a href="javascript:void(0);" id="g-lahir-2020">2020</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <div class="body">
            <div style="width: 80%;margin: 0 auto;" id="g-lahir">
                {{ $lahir->container() }}
            </div>
        </div>
    </div>
</div>
<div>
    <div class="card">
        <div class="header">
            <h2>Berdasarkan KEMATIAN</h2>
            <ul class="header-dropdown m-r--5">
                <!-- <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" id="g-mati-2018">2018</a></li>
                        <li><a href="javascript:void(0);" id="g-mati-2019">2019</a></li>
                        <li><a href="javascript:void(0);" id="g-mati-2020">2020</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <div class="body">
            <div style="width: 80%;margin: 0 auto;" id="g-mati">
                {{ $mati->container() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="{{ asset('/js/grafik.js') }}"></script>
{{ $ras->script() }}
{{ $umur->script() }}
{{ $lahir->script() }}
{{ $mati->script() }}
@endpush