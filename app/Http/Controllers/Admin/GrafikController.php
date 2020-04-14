<?php

namespace App\Http\Controllers\Admin;

use App\Ras;
use App\Ternak;
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
        $yearNow = date('Y');
        $year = array();

        for($i = $yearNow; $i > $yearNow-5; $i--){
            $year[] = $i;
        }

        return view('grafik.grafik')->with([
            'ras' => $ras,
            'umur' => $umur,
            'lahir'=> $lahir,
            'mati' => $mati,
            'years' => $year,
        ]);
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
        $chart->title('Grafik Ternak - Ras');
        $chart->displayLegend(true);
        $chart->labels($label);
	    $chart->dataset('Jumlah Ternak', 'bar', $data)->options([
            'responsive' => true,
			'fill' => true,
            'backgroundColor' => '#B2DFDB',
			'borderColor' => '#009688',
            'tooltip' => [
                'show' => true
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
        $chart->title('Grafik Ternak - Umur');
        $chart->labels($label);
	    $chart->dataset('Jumlah Ternak', 'bar', $data)->options([
            'responsive' => true,
			'fill' => true,
            'backgroundColor' => '#CDDC39',
			'borderColor' => '#8BC34A',
            'legend' => [
                'show' => true,
             ],
             'tooltip' => [
                'show' => true
            ],
		]);

		return $chart;
    }

    public function grafikLahir(Request $request)
    {
    	$label = array();
    	$data = array();
        $jantan = array();
        $betina = array();
        $yearNow = date('Y');

        if ($request->ajax()) {
           $yearNow = $request->tahun;
        }

        $count = Ternak::whereYear('tgl_lahir', '=' , $yearNow)
                        ->selectRaw('count(*) as jumlah, coalesce(extract(month from tgl_lahir), 0) as lahir')
                        ->groupBy('lahir')
                        ->orderBy('lahir')
                        ->get();

        $count_jantan = Ternak::whereYear('tgl_lahir', '=' , $yearNow)
                        ->where('jenis_kelamin', '=', 'Jantan')
                        ->selectRaw('count(*) as jumlah, coalesce(extract(month from tgl_lahir), 0) as lahir')
                        ->groupBy('lahir')
                        ->orderBy('lahir')
                        ->get();

        $count_betina = Ternak::whereYear('tgl_lahir', '=' , $yearNow)
                        ->where('jenis_kelamin', '=', 'Betina')
                        ->selectRaw('count(*) as jumlah, coalesce(extract(month from tgl_lahir), 0) as lahir')
                        ->groupBy('lahir')
                        ->orderBy('lahir')
                        ->get();

        for($i=0; $i<12; $i++){
            $data[$i] = 0;
            $jantan[$i] = 0;
            $betina[$i] = 0;
        }
    
        foreach($count as $lahir){
        	$data[$lahir->lahir - 1] = $lahir->jumlah;
        }

        foreach($count_jantan as $lahir){
            $jantan[$lahir->lahir - 1] = $lahir->jumlah;
        }

        foreach($count_betina as $lahir){
            $betina[$lahir->lahir - 1] = $lahir->jumlah;
        }

        $chart = new KelahiranChart;
        $chart->title('Grafik Ternak - Kelahiran ('. $yearNow .')');
        $chart->labels(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
        
        $chart->dataset('Jantan','bar', $jantan)->options([
            'responsive' => true,
            'fill' => 'true',
            'backgroundColor' => '#36A7C9',
            'borderColor' => '#1A89B4',
             'tooltip' => [
                'show' => 'true'
            ],
        ]);

        $chart->dataset('Betina','bar', $betina)->options([
            'responsive' => true,
            'fill' => 'true',
            'backgroundColor' => '#F8B195',
            'borderColor' => '#f67280',
             'tooltip' => [
                'show' => 'true'
            ],
        ]);

        $chart->dataset('Jumlah Ternak','line', $data)->options([
            'responsive' => true,
            // 'fill' => 'true',
            // 'backgroundColor' => '#1A535C',
            'borderColor' => '#607D8B',
             'tooltip' => [
                'show' => true
            ],
        ]);

        if ($request->ajax()) {
           return response()->json(['data' => $data, 'jantan' => $jantan, 'betina' => $betina]);
        }

		return $chart;
    }

    public function grafikMati(Request $request)
    {
    	$label = array();
    	$data = array();
        $jantan = array();
        $betina = array();
        $yearNow = date('Y');

        if ($request->ajax()) {
           $yearNow = $request->tahun;
        }

        $count = Ternak::join('kematians', 'kematians.id', '=', 'ternaks.kematian_id')
                        ->whereNotNull('kematian_id')
                        ->whereYear('tgl_kematian', '=', $yearNow)
                        ->selectRaw('count(*) as jumlah, coalesce(extract(month from kematians.tgl_kematian), 0) as mati')
                        ->groupBy('mati')
                        ->orderBy('mati')
                        ->get();

        $count_jantan = Ternak::join('kematians', 'kematians.id', '=', 'ternaks.kematian_id')
                        ->whereNotNull('kematian_id')
                        ->whereYear('tgl_kematian', '=', $yearNow)
                        ->where('ternaks.jenis_kelamin', '=', 'Jantan')
                        ->selectRaw('count(*) as jumlah, coalesce(extract(month from kematians.tgl_kematian), 0) as mati')
                        ->groupBy('mati')
                        ->orderBy('mati')
                        ->get();

        $count_betina = Ternak::join('kematians', 'kematians.id', '=', 'ternaks.kematian_id')
                        ->whereNotNull('kematian_id')
                        ->whereYear('tgl_kematian', '=', $yearNow)
                        ->where('ternaks.jenis_kelamin', '=', 'Betina')
                        ->selectRaw('count(*) as jumlah, coalesce(extract(month from kematians.tgl_kematian), 0) as mati')
                        ->groupBy('mati')
                        ->orderBy('mati')
                        ->get();

        for($i=0; $i<12; $i++){
            $data[$i] = 0;
            $jantan[$i] = 0;
            $betina[$i] = 0;
        }

        foreach($count as $mati){
        	$data[$mati->mati - 1] = $mati->jumlah;
        }

        foreach($count_jantan as $lahir){
            $jantan[$lahir->mati - 1] = $lahir->jumlah;
        }

        foreach($count_betina as $lahir){
            $betina[$lahir->mati - 1] = $lahir->jumlah;
        }

        $chart = new KematianChart;
        $chart->title('Grafik Ternak - Kematian ('. $yearNow .')');
        $chart->labels(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);

        $chart->dataset('Jantan','bar', $jantan)->options([
            'responsive' => true,
            'fill' => true,
            'backgroundColor' => '#36A7C9',
            'borderColor' => '#1A89B4',
             'tooltip' => [
                'show' => true
            ],
        ]);

        $chart->dataset('Betina','bar', $betina)->options([
            'responsive' => true,
            'fill' => true,
            'backgroundColor' => '#F8B195',
            'borderColor' => '#f67280',
             'tooltip' => [
                'show' => true
            ],
        ]);

	    $chart->dataset('Jumlah Ternak', 'line', $data)->options([
            'responsive' => true,
			// 'fill' => 'true',
			// 'backgroundColor' => '#FFE0B2',
            'borderColor' => '#FF9800',
             'tooltip' => [
                'show' => true
            ],
		]);

        if ($request->ajax()) {
           return response()->json(['data' => $data, 'jantan' => $jantan, 'betina' => $betina]);
        }
        
		return $chart;
    }

}
