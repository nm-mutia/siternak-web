<?php

namespace App\Http\Controllers\API;

use App\Kematian;
use App\Ternak;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kematian = Kematian::orderBy("id")->get();

        return response()->json([
            'status' => 'success',
            'kematian' => $kematian,
        ], 200);
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
            'tgl_kematian' => 'required',
            'waktu_kematian' => 'required',
            'penyebab' => 'required',
            'kondisi' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([
                'status' => 'error',
                'error' => $error->errors()->all()
            ]);
        }

        $form_data = array(
            'tgl_kematian' => $request->tgl_kematian,
            'waktu_kematian' => $request->waktu_kematian,
            'penyebab' => $request->penyebab,
            'kondisi' => $request->kondisi
        );

        $kematian = Kematian::create($form_data);

        return response()->json([
            'status' => 'success',
            'kematian' => $kematian,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kematian = Kematian::find($id);
        
        return response()->json([
            'status' => 'success',
            'kematian' => $kematian,
        ], 200);
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
            'tgl_kematian' => 'required',
            'waktu_kematian' => 'required',
            'penyebab' => 'required',
            'kondisi' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([
                'status' => 'error',
                'error' => $error->errors()->all()
            ]);
        }

        $form_data = array(
            'tgl_kematian' => $request->tgl_kematian,
            'waktu_kematian' => $request->waktu_kematian,
            'penyebab' => $request->penyebab,
            'kondisi' => $request->kondisi
        );

        Kematian::whereId($id)->update($form_data);
        $kematian = Kematian::find($id);
        
        return response()->json([
            'status' => 'success',
            'kematian' => $kematian,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kematian::find($id);

        if(Ternak::where('kematian_id', $id)->exists()){
            return response()->json([
                'status' => 'error',
                'message' => "Data kematian id ". $id ." tidak dapat dihapus.",
            ], 200);
        }
        else{
            $data->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => "Data kematian id ". $id ." telah berhasil dihapus.",
        ], 200);
    }
}
