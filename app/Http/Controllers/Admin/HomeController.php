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

    public function search(Request $request)
    {
        $inst = DB::select('SELECT public."search_inst"(?)', [$request->necktag]);

    	if($inst != null){
    		$sp = preg_split("/[(),]/", $inst[0]->search_inst); 
	    	//split karena hasil bukan array, tapi string
	    	//0: kosong, 1:necktag, 2:jenis_kelamin, 3:ras, 4:tgl_lahir, 5:blood, 6:ayah, 7:ibu, 8:kosong

    		$parent = DB::select('SELECT public."search_parent"(?,?)', [$sp[6], $sp[7]]);
	        $sibling = DB::select('SELECT public."search_sibling"(?,?,?)', [$sp[1], $sp[6], $sp[7]]);
	        $child = DB::select('SELECT public."search_child"(?)', [$sp[1]]);
	        $gparent = DB::select('SELECT public."search_gparent"(?,?)', [$sp[6], $sp[7]]);
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

    //fitur perkawinan
    public function p_index()
    {
        $ternak = Ternak::all();
        return view('perkawinan.kawin')->with('ternak', $ternak);
    }

    public function p_match(Request $request)
    {
        // $ternak = Ternak::all();
        return response()->json(['result' => 'berhasil']);
    }
}
