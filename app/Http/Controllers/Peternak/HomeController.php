<?php

namespace App\Http\Controllers\Peternak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ternak;
use App\Perkawinan;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$ternak = Ternak::join('peternaks', 'peternaks.peternakan_id', '=', 'ternaks.peternakan_id')
    					->where('peternaks.username', '=', $user->username)
    					->count();

        $lahir = Ternak::join('peternaks', 'peternaks.peternakan_id', '=', 'ternaks.peternakan_id')
        				->where('peternaks.username', '=', $user->username)
				        ->where('tgl_lahir', '>', date("Y-m-d", strtotime('-29 days')))
                        ->whereNotNull('tgl_lahir')
                        ->selectRaw('count(*)')->first();

        $kawin = Perkawinan::join('ternaks', 'ternaks.necktag', '=', 'perkawinans.necktag')
				        ->join('peternaks', 'peternaks.peternakan_id', '=', 'ternaks.peternakan_id')
        				->where('peternaks.username', '=', $user->username)
				        ->where('tgl', '>', date("Y-m-d", strtotime('-29 days')))
                        ->whereNotNull('tgl')
                        ->selectRaw('count(*)/2 as count')->first();

        $mati = Ternak::join('kematians', 'kematians.id', '=', 'ternaks.kematian_id')
				        ->join('peternaks', 'peternaks.peternakan_id', '=', 'ternaks.peternakan_id')
        				->where('peternaks.username', '=', $user->username)
                        ->whereNotNull('ternaks.kematian_id')
                        ->where('kematians.tgl_kematian', '>', date("Y-m-d", strtotime('-29 days')))
                        ->selectRaw('count(*)')->first();

        return view('home.dashboard')->with('total_ternak', $ternak)
        							  ->with('kelahiran_baru', $lahir)
        							  ->with('perkawinan_baru', $kawin)
        							  ->with('kematian_baru', $mati);
    }
}
