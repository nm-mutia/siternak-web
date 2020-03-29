<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Penyakit;
use Yajra\Datatables\Datatables;
use Validator;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'PENYAKIT';
        $page = 'Penyakit';

        if ($request->ajax()) {
            $data = Penyakit::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" name="view" id="'.$row->id.'" class="view btn btn-warning btn-sm">View</button>';
                        $btn .= '<button type="button" name="edit" id="'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $btn .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('data.penyakit')->with('title', $title)
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
            'nama_penyakit' => 'required',
            'ket_penyakit' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nama_penyakit' => $request->nama_penyakit,
            'ket_penyakit' => $request->ket_penyakit
        );

        Penyakit::create($form_data);

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
        if(request()->ajax()){
            $data = Penyakit::findOrFail($id);

            $rp = DB::select('SELECT public."rp_penyakit"(?)', [$data->id]);

            return response()->json(['result' => $data, 'riwayat' => $rp]);
        }
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
            $data = Penyakit::findOrFail($id);
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
            'nama_penyakit' => 'required',
            'ket_penyakit' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nama_penyakit' => $request->nama_penyakit,
            'ket_penyakit' => $request->ket_penyakit
        );

        Penyakit::whereId($id)->update($form_data);

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
        $data = Penyakit::findOrFail($id);
        $data->delete();
    }
}
