<?php

namespace App\Http\Controllers\Admin;

use App\Ternak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
    	$ternak = Ternak::all(); 
	    $no = 1; 
	 //    $pdf =  PDF::loadView  (  'produk. barcode'  ,  compact('produk', 'no')); 
		// $pdf->setPaper('a4',  'potrait'); 
		// return $pdf->stream(); 

        return view('admin.barcode')->with('ternak', $ternak)
        		->with('no', $no);
    }
}
