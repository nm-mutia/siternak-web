<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ternak;

class HomeController extends Controller
{
    public function index()
    {
    	$ternak = DB::table('total_ternak')->first();
    	$lahir = DB::select('SELECT public."kelahiran_baru"(?)', [30]); //interval 1 bulan (30 hari) from today
    	$kawin = DB::select('SELECT public."perkawinan_baru"(?)', [30]); //interval 1 bulan (30 hari) from today
    	$mati = DB::select('SELECT public."kematian_baru"(?)', [30]); //interval 1 bulan (30 hari) from today

        return view('admin.dashboard')->with('total_ternak', $ternak)
        							  ->with('kelahiran_baru', $lahir)
        							  ->with('perkawinan_baru', $kawin)
        							  ->with('kematian_baru', $mati);
    }
}
