<?php

namespace App\Http\Controllers\API;

use App\Ternak;
use Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TernakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ternak = Ternak::all();

        return response()->json([
            'status' => 'success',
            'ternak' => $ternak,
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
            'ras_id' => 'required',
            'jenis_kelamin' => 'required',
            'blood' => 'required',
            'status_ada' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['error' => $error->errors()]);
        }

        $necktag = Str::random(6);
        while(Ternak::where('necktag', $necktag)->exists()) {
            $necktag = Str::random(6);
        }

        $form_data = array(
            'necktag' => $necktag,
            'pemilik_id' => $request->pemilik_id,
            'ras_id' => $request->ras_id,
            'kematian_id' => $request->kematian_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'bobot_lahir' => $request->bobot_lahir,
            'pukul_lahir' => $request->pukul_lahir,
            'lama_dikandungan' => $request->lama_dikandungan,
            'lama_laktasi' => $request->lama_laktasi,
            'tgl_lepas_sapih' => $request->tgl_lepas_sapih,
            'blood' => $request->blood,
            'necktag_ayah' => $request->necktag_ayah,
            'necktag_ibu' => $request->necktag_ibu,
            'bobot_tubuh' => $request->bobot_tubuh,
            'panjang_tubuh' => $request->panjang_tubuh,
            'tinggi_tubuh' => $request->tinggi_tubuh,
            'cacat_fisik' => $request->cacat_fisik,
            'ciri_lain' => $request->ciri_lain,
            'status_ada' => $request->status_ada
        );

        $ternak = Ternak::create($form_data);

        return response()->json([
            'status' => 'success',
            'ternak' => $ternak,
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
        $ternak = Ternak::find($id);
        
        return response()->json([
            'status' => 'success',
            'ternak' => $ternak,
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
            'ras_id' => 'required',
            'jenis_kelamin' => 'required',
            'blood' => 'required',
            'status_ada' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['error' => $error->errors()]);
        }

        if($request->necktag_ayah == $id || $request->necktag_ibu == $id){
            $err = 'Individu tidak bisa menjadi orangtua untuk dirinya sendiri';
            return response()->json(['error' => $err]);
        }

        $form_data = array(
            'necktag' => $id,
            'pemilik_id' => $request->pemilik_id,
            'ras_id' => $request->ras_id,
            'kematian_id' => $request->kematian_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'bobot_lahir' => $request->bobot_lahir,
            'pukul_lahir' => $request->pukul_lahir,
            'lama_dikandungan' => $request->lama_dikandungan,
            'lama_laktasi' => $request->lama_laktasi,
            'tgl_lepas_sapih' => $request->tgl_lepas_sapih,
            'blood' => $request->blood,
            'necktag_ayah' => $request->necktag_ayah,
            'necktag_ibu' => $request->necktag_ibu,
            'bobot_tubuh' => $request->bobot_tubuh,
            'panjang_tubuh' => $request->panjang_tubuh,
            'tinggi_tubuh' => $request->tinggi_tubuh,
            'cacat_fisik' => $request->cacat_fisik,
            'ciri_lain' => $request->ciri_lain,
            'status_ada' => $request->status_ada
        );

        Ternak::where('necktag',$id)->update($form_data);
        $ternak = Ternak::find($id);
        
        return response()->json([
            'status' => 'success',
            'ternak' => $ternak,
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
        $data = Ternak::find($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Data ternak id ". $id ." telah berhasil dihapus.",
        ], 200);
    }
}