<?php

namespace App\Http\Controllers\Admin;

use App\Ras;
use App\Charts\RasChart;
use App\Charts\UmurChart;
use App\Charts\KelahiranChart;
use App\Charts\KematianChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function index(Request $request)
    {
	    $ras = $this->grafikRas();
	    $umur = $this->grafikUmur();
	    $lahir = $this->grafikLahir($request);
	    $mati = $this->grafikMati($request);

        return view('grafik.grafik')->with('ras', $ras)
        							->with('umur', $umur)
        							->with('lahir', $lahir)
        							->with('mati', $mati);
    }

    public function grafikRas()
    {
    	$label = array();
    	$data = array();

        $count = DB::table('grafik_ras')->get();

        foreach($count as $ras){
        	$label[] = $ras->ras;
        	$data[] = $ras->jumlah;
        }

        $chart = new RasChart;
        $chart->labels($label);
	    $chart->dataset('Jumlah Ternak', 'bar', $data)->options([
			'fill' => 'true',
            'backgroundColor' => '#B2DFDB',#CDDC39
			'borderColor' => '#009688',
            'legend' => [
                'show' => 'true',
                'show' => 'true',
             ],
             'tooltip' => [
                'show' => 'true'
            ],
		]);

		return $chart;
    }

    public function grafikUmur()
    {
    	$label = array();
    	$data = array();

        $count = DB::table('grafik_umur')->get();

        foreach($count as $umur){
        	$label[] = $umur->tahun;
        	$data[] = $umur->jumlah;
        }

        $chart = new UmurChart;
        $chart->labels($label);
	    $chart->dataset('Jumlah Ternak', 'bar', $data)->options([
			'fill' => 'true',
            'backgroundColor' => '#CDDC39',
			'borderColor' => '#8BC34A',
            'legend' => [
                'show' => 'true',
                'show' => 'true',
             ],
             'tooltip' => [
                'show' => 'true'
            ],
		]);

		return $chart;
    }

    public function grafikLahir(Request $request)
    {
    	$label = array();
    	$data = array();
        $flag = 0;

        $count = DB::table('grafik_lahir')->get(); //tahun terbaru

        if ($request->ajax()) {
            $count = DB::select('SELECT public."grafik_lahir_tahun"(?)', [$request->tahun]);
            $flag = 1;
        }

        for($i=0; $i<12; $i++){
            $data[$i] = 0;
        }
    
        foreach($count as $lahir){
            if($flag == 1){
                $sp = preg_split("/[(),]/", $lahir->grafik_lahir_tahun);
                //1: jumlah, 2: bulan lahir

                $data[$sp[2]-1] = $sp[1];
            }
            else{
            	$data[$lahir->lahir - 1] = $lahir->jumlah;
            }
        }

        $chart = new KelahiranChart;
        $chart->labels(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
	    $chart->dataset('Jumlah Ternak', 'line', $data)->options([
			'fill' => 'true',
			'backgroundColor' => '#CFD8DC',
            'borderColor' => '#607D8B',
            'legend' => [
                'show' => 'true',
                'show' => 'true',
             ],
             'tooltip' => [
                'show' => 'true'
            ],
		]);

		return $chart;
    }

    public function grafikMati(Request $request)
    {
    	$label = array();
    	$data = array();
        $flag = 0;

        $count = DB::table('grafik_mati')->get(); //tahun terbaru

        if ($request->ajax()) {
            $count = DB::select('SELECT public."grafik_mati_tahun"(?)', [$request->tahun]);
            $flag = 1;
        }

        for($i=0; $i<12; $i++){
            $data[$i] = 0;
        }

        foreach($count as $mati){
            if($flag == 1){
                $sp = preg_split("/[(),]/", $mati->grafik_mati_tahun);
                //1: jumlah, 2: bulan mati

                $data[$sp[2]-1] = $sp[1];
            }
            else{
            	$data[$mati->mati - 1] = $mati->jumlah;
            }
        }

        $chart = new KematianChart;
        $chart->labels(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
	    $chart->dataset('Jumlah Ternak', 'line', $data)->options([
			'fill' => 'true',
			'backgroundColor' => '#FFE0B2',
            'borderColor' => '#FF9800',
            'legend' => [
                'show' => 'true',
                'show' => 'true',
             ],
             'tooltip' => [
                'show' => 'true'
            ],
		]);

		return $chart;
    }

}
