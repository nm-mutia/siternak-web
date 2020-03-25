<?php

namespace App\Http\Controllers\Admin;

use App\Penyakit;
use App\Ternak;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;

class RiwayatPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'RIWAYAT PENYAKIT';
        $page = 'Riwayat Penyakit';
        $ternak = Ternak::all();
        $penyakit = Penyakit::all();
        
        if ($request->ajax()) {
            $data = DB::table('riwayat_penyakits')->latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" name="edit" id="'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $btn .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('data.riwayat')->with('title', $title)
                                  ->with('ternak', $ternak)
                                  ->with('penyakit', $penyakit)
                                  ->with('page', $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'penyakit_id' => 'required',
            'necktag' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $s_penyakit = Penyakit::find($request->penyakit_id);

        $s_penyakit->ternak()->attach($request->necktag, [
            'tgl_sakit' => $request->tgl_sakit,
            'obat' => $request->obat,
            'lama_sakit' => $request->lama_sakit,
            'keterangan' => $request->keterangan 
        ]);

        return response()->json(['success' => 'Data telah berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax()){
            $data = DB::table('riwayat_penyakits')->find($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'penyakit_id' => 'required',
            'necktag' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'tgl_sakit' => $request->tgl_sakit,
            'obat' => $request->obat,
            'lama_sakit' => $request->lama_sakit,
            'keterangan' => $request->keterangan
        );

        $u_ternak = Ternak::findOrFail($request->necktag);
        $u_ternak->penyakit()->updateExistingPivot($request->penyakit_id, $form_data);

        return response()->json(['success' => 'Data telah berhasil diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('riwayat_penyakits')->where('id', $id)->delete();
    }
}
