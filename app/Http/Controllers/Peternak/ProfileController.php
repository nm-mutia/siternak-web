<?php

namespace App\Http\Controllers\Peternak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
// use App\Peternak;
use Validator;
use App\Http\Requests\ChangePasswordRequest;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = Auth::user();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email
        );

        // $form_data_ptk = array(
        //     'nama_peternak' => $request->name,
        //     'username' => $request->username
        // );

        $data = Auth::user();

        // Peternak::where('username', $data->username)->update($form_data_ptk);
        $data->update($form_data);

        return response()->json(['success' => 'Data telah berhasil diubah.']);
    }


    public function postChangePassword(Request $request)
    {
        $rules = array(
            'password' => 'required|min:8|same:password',
            'password_confirmation' => 'required|same:password',
            'current_password' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if(Auth::Check()){
            if(\Hash::check($request->current_password, Auth::User()->password)){
                $data = Auth::user();

                // $ptk = Peternak::where('username', $data->username)->update(["password" => $request->password]);
                $user = User::find($data->id)->update(["password"=> bcrypt($request->password)]);
            }else{
                return response()->json(['error' => 'Detail yang dimasukkan salah!']);
            }
        }
        return response()->json(['success' => 'Password berhasil diubah!']);
    }
}
