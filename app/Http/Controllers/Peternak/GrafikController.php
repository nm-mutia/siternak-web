<?php

namespace App\Http\Controllers\Peternak;

use App\Ras;
use App\Ternak;
use App\Charts\RasChart;
use App\Charts\UmurChart;
use App\Charts\KelahiranChart;
use App\Charts\KematianChart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $jantan = array();
        $betina = array();

        $count = Ternak::where('status_ada', '=', true)
                        ->rightJoin('ras', 'ras.id', '=', 'ternaks.ras_id')
                        ->groupBy('ras.jenis_ras')
                        ->orderBy('ras.jenis_ras')
                        ->selectRaw('ras.jenis_ras as ras, coalesce(count(ternaks.necktag), 0) as jumlah')
                        ->get();

        $count_jantan = Ternak::where('status_ada', '=', true)
                        ->where('jenis_kelamin', '=', 'Jantan')
                        ->rightJoin('ras', 'ras.id', '=', 'ternaks.ras_id')
                        ->groupBy('ras.jenis_ras')
                        ->orderBy('ras.jenis_ras')
                        ->selectRaw('ras.jenis_ras as ras, coalesce(count(ternaks.necktag), 0) as jumlah')
                        ->get();

        $count_betina = Ternak::where('status_ada', '=', true)
                        ->where('jenis_kelamin', '=', 'Betina')
                        ->rightJoin('ras', 'ras.id', '=', 'ternaks.ras_id')
                        ->groupBy('ras.jenis_ras')
                        ->orderBy('ras.jenis_ras')
                        ->selectRaw('ras.jenis_ras as ras, coalesce(count(ternaks.necktag), 0) as jumlah')
                        ->get();

        foreach($count as $ras){
            $label[] = $ras->ras;
            $data[] = $ras->jumlah;
        }

        foreach($count_jantan as $ras){
            $jantan[] = $ras->jumlah;
        }

        foreach($count_betina as $ras){
            $betina[] = $ras->jumlah;
        }

        $chart = new RasChart;
        $chart->title('Grafik Ternak - Ras');
        $chart->displayLegend(true);
        $chart->labels($label);

        if($count_jantan != null){
            $chart->dataset('Jantan','bar', $jantan)->options([
                'responsive' => true,
                'fill' => 'true',
                'backgroundColor' => '#36A7C9',
                'borderColor' => '#1A89B4',
                 'tooltip' => [
                    'show' => 'true'
                ],
            ]);
        }

        if($count_betina != null){
            $chart->dataset('Betina','bar', $betina)->options([
                'responsive' => true,
                'fill' => 'true',
                'backgroundColor' => '#F8B195',
                'borderColor' => '#f67280',
                 'tooltip' => [
                    'show' => 'true'
                ],
            ]);
        }

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
        $umurj = array();
        $umurb = array();
        $jantan = array();
        $betina = array();

        $count = Ternak::where('status_ada', '=', true)
                        ->selectRaw('count(*) as jumlah, coalesce((extract(year from current_date) - 
    extract(year from ternaks.tgl_lahir)), 0) as tahun')
                        ->groupBy('tahun')
                        ->orderBy('tahun')
                        ->get();

        $count_jantan = Ternak::where('status_ada', '=', true)
                        ->where('jenis_kelamin', '=', 'Jantan')
                        ->selectRaw('count(*) as jumlah, coalesce((extract(year from current_date) - 
    extract(year from ternaks.tgl_lahir)), 0) as tahun')
                        ->groupBy('tahun')
                        ->orderBy('tahun')
                        ->get();

        $count_betina = Ternak::where('status_ada', '=', true)
                        ->where('jenis_kelamin', '=', 'Betina')
                        ->selectRaw('count(*) as jumlah, coalesce((extract(year from current_date) - 
    extract(year from ternaks.tgl_lahir)), 0) as tahun')
                        ->groupBy('tahun')
                        ->orderBy('tahun')
                        ->get();

        foreach($count as $umur){
            $label[] = $umur->tahun;
            $data[] = $umur->jumlah;
        }
        
        foreach($count_jantan as $umur){
            $umurj[] = $umur->tahun;
            $jt[] = $umur->jumlah;
        }

        foreach($count_betina as $umur){
            $umurb[] = $umur->tahun;
            $bt[] = $umur->jumlah;
        }

        $j = 0;
        $b = 0;

        for($i = 0; $i < count($label); $i++){
            if($umurj != null){
                if($label[$i] == $umurj[$j]){
                    $jantan[$i] = $jt[$j];
                    $j++;
                }
                else{
                    $jantan[$i] = 0;
                }
            }

            if($umurb != null){
                if($label[$i] == $umurb[$b]){
                    $betina[$i] = $bt[$b];
                    $b++;
                }
                else{
                    $betina[$i] = 0;
                }
            }
        }

        $chart = new UmurChart;
        $chart->title('Grafik Ternak - Umur');
        $chart->labels($label);

        if($count_jantan != null){
            $chart->dataset('Jantan','bar', $jantan)->options([
                'responsive' => true,
                'fill' => 'true',
                'backgroundColor' => '#36A7C9',
                'borderColor' => '#1A89B4',
                 'tooltip' => [
                    'show' => 'true'
                ],
            ]);
        }

        if($count_betina != null){
            $chart->dataset('Betina','bar', $betina)->options([
                'responsive' => true,
                'fill' => 'true',
                'backgroundColor' => '#F8B195',
                'borderColor' => '#f67280',
                 'tooltip' => [
                    'show' => 'true'
                ],
            ]);
        }

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
