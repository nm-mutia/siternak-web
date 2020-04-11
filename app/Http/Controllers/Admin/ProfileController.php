<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function edit()
    {
        $data = Auth::user();
        return response()->json(['result' => $data]);
    }

    public function update(Request $request)
    {
    	$rules = array(
            'name' => 'required',
            'email' => 'required'
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

        $data = Auth::user();
        $data->update($form_data);

        return response()->json(['success' => 'Data telah berhasil diubah.']);
    }

    public function changePassword()
    {
        return response()->json(['email' => Auth::user()->email]);
    }

    public function postChangePassword(Request $request)
    {
    	$rules = array(
            'password' => 'required|min:6|same:password',
            'password_confirmation' => 'required|same:password',
            'current_password' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

    	if(Auth::Check()){	 
            if(\Hash::check($request->current_password, Auth::User()->password)){
    			$user = User::find(Auth::user()->id)->update(["password"=> bcrypt($request->password)]);    	
  			}else{
  				return response()->json(['errors' => 'Detail yang dimasukkan salah!']);
  			}
  		}
        return response()->json(['success' => 'Password berhasil diubah!']);
    }
}
