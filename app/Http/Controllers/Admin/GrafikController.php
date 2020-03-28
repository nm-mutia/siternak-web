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
    public function index()
    {
	    $ras = $this->grafikRas();
	    $umur = $this->grafikUmur();
	    $lahir = $this->grafikLahir();
	    $mati = $this->grafikMati();

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
			'borderColor' => '#51C1C0'
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
			'borderColor' => '#51C1C0'
		]);

		return $chart;
    }

    public function grafikLahir()
    {
    	$label = array();
    	$data = array();

        $count = DB::table('grafik_lahir')->get();

        foreach($count as $lahir){
        	$label[] = $lahir->lahir;
        	$data[] = $lahir->jumlah;
        }

        $chart = new KelahiranChart;
        $chart->labels($label);
	    $chart->dataset('Jumlah Ternak', 'line', $data)->options([
			'fill' => 'true',
			'borderColor' => '#51C1C0'
		]);

		return $chart;
    }

    public function grafikMati()
    {
    	$label = array();
    	$data = array();

        $count = DB::table('grafik_mati')->get();

        foreach($count as $mati){
        	$label[] = $mati->mati;
        	$data[] = $mati->jumlah;
        }

        $chart = new KematianChart;
        $chart->labels($label);
	    $chart->dataset('Jumlah Ternak', 'line', $data)->options([
			'fill' => 'true',
			'borderColor' => '#51C1C0'
		]);

		return $chart;
    }

}
