<?php

namespace App\Http\Controllers\Admin;

use Ternak;
use Perkawinan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        
        $lahir = $this->lahir();
	    $mati = $this->mati();
	    $kawin = $this->kawin();
	    $sakit = $this->sakit();
	    $ada = $this->ada();

        return view('laporan.laporan');
    }

    public function lahir()
    {
    	// $lahir = Ternak::whereBetween('tgl_lahir', [$start, $end])->get();

    	// $data = Datatables::of($lahir)
     	//    		->addIndexColumn()
     	//          ->make(true);

        // return $data;
    }

    public function mati()
    {
    	// $mati = Ternak::join('public.kematians', 'kematians.id', '=', 'ternaks.kematian_id')
        // 			->whereBetween('tgl_lahir', [$start, $end])
        // 			->get();
    }

    public function kawin()
    {
    	// $kawin = Perkawinan::whereBetween('tgl', [$start, $end])->get();
    }

    public function sakit()
    {
    	// $sakit = DB::table('riwayat_penyakits')->join('public.penyakits', 'penyakits.id', '=', 'riwayat_penyakits.penyakit_id')
        //             ->select('riwayat_penyakits.id', 'penyakits.nama_penyakit as penyakit_id', 'riwayat_penyakits.necktag', 'riwayat_penyakits.tgl_sakit', 'riwayat_penyakits.obat', 'riwayat_penyakits.lama_sakit', 'riwayat_penyakits.keterangan', 'riwayat_penyakits.created_at', 'riwayat_penyakits.updated_at')
        //             ->get();
    }

    public function ada()
    {
    	// $ada = Ternak::where('status_ada', true)->get();
    }

}
