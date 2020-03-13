@extends('layouts.app')

@section('content')
<!-- top tiles -->
<div class="row" style="display: inline-block;" >
    <div class="tile_count">
        <div class="col-md-3 col-sm-3  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Ternak</span>
            <div class="count">2500</div>
            <span class="count_bottom"><i class="green">4% </i> All</span>
        </div>
        <div class="col-md-3 col-sm-3  tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Total Kelahiran</span>
            <div class="count">123.50</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
        <div class="col-md-3 col-sm-3  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Kematian</span>
            <div class="count green">2,500</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-3 col-sm-3  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Kawin</span>
            <div class="count">4,567</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
    </div>
</div>
<!-- /top tiles -->
@endsection