<?php

namespace App\Http\Controllers\Admin;

use App\Peternak;
use App\Peternakan;
use App\User;
use App\DataTables\PeternakDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Validator;

class PeternakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PeternakDataTable $dataTable)
    {
        $title = 'PETERNAK';
        $page = 'Peternak';
        $peternakan = Peternakan::orderBy('nama_peternakan', 'asc')->get();

        return $dataTable->render('data.peternak', [
            'title' => $title, 
            'page' => $page,
            'peternakan' => $peternakan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'peternakan_id' => 'required',
            'nama_peternak' => 'required',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $password = Str::random(8);

        $form_data = array(
            'peternakan_id' => $request->peternakan_id,
            'nama_peternak' => $request->nama_peternak,
            'username' => $request->username,
            'password' => $password
        );

        // register peternak
        User::create([
            'name' => $request->nama_peternak,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        Peternak::create($form_data);

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
            $data = Peternak::findOrFail($id);
            return response()->json(['result' => $data]);
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
            $data = Peternak::findOrFail($id);
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
            'peternakan_id' => 'required',
            'nama_peternak' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'peternakan_id' => $request->peternakan_id,
            'nama_peternak' => $request->nama_peternak
        );

        Peternak::whereId($id)->update($form_data);

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
        $data = Peternak::findOrFail($id);
        $data->delete();
    }
}
