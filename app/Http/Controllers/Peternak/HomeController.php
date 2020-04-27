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


    public function search(Request $request)
    {
        $inst = DB::select('SELECT public."search_inst"(?)', [$request->necktag]);

        // $user = Auth::user();
        // $peternak = Peternak::where('username', '=', $user->username);
        // $ternak = Ternak::where('necktag', '=', $request->necktag);
        // && ($ternak->peternakan_id == $peternak->peternakan_id)

        if($inst != null ){
            $sp = preg_split("/[(),]/", $inst[0]->search_inst); 
            //split karena hasil bukan array, tapi string
            //0: kosong, 1:necktag, 2:jenis_kelamin, 3:ras, 4:tgl_lahir, 5:blood, 6:peternakan, 7:ayah, 8:ibu, 9:kosong

            $parent = DB::select('SELECT public."search_parent"(?,?)', [$sp[7], $sp[8]]);
            $sibling = DB::select('SELECT public."search_sibling"(?,?,?)', [$sp[1], $sp[7], $sp[8]]);
            $child = DB::select('SELECT public."search_child"(?)', [$sp[1]]);
            $gparent = DB::select('SELECT public."search_gparent"(?,?)', [$sp[7], $sp[8]]);
            $gchild = DB::select('SELECT public."search_gchild"(?)', [$sp[1]]);
            
            $data = [
                'inst' => $inst,
                'parent' => $parent,
                'sibling' => $sibling,
                'child' => $child,
                'gparent' => $gparent,
                'gchild' => $gchild
            ];  
        }
        else{
            $data = [
                'result' => 'Tidak ada data ternak dengan necktag ' .$request->necktag. '.',
                'necktag' => $request->necktag
            ];
            return response()->json(['errors' => $data]);
        }
        return response()->json(['result' => $data]);
    }
}
