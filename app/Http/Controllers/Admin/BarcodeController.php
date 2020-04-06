<?php

namespace App\Http\Controllers\Admin;

use App\Ternak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domPDF;

class BarcodeController extends Controller
{
    public function index(Request $request)
    {
    	$ternak = Ternak::all(); 
	    $no = 1; 

        return view('admin.barcode')->with('ternak', $ternak)->with('no', $no);
    }

    public function generatePdf()
    {
        $ternak = Ternak::all();
        $no = 1;
        $pdf = domPDF::loadView('admin/barcode', ['ternak' => $ternak, 'no' => $no]);
        // $pdf = set_time_limit(600);
        // $pdf->setOption('enable-javascript', true);
        // $pdf->setOption('javascript-delay', 5000);
        // $pdf->setOption('enable-smart-shrinking', true);
        // $pdf->setOption('no-stop-slow-scripts', true);
        // return $pdf->stream();

        $pdf->save(storage_path().'_filename.pdf');
	    return $pdf->download('SITERNAK-Barcode.pdf');

	 //    $pdf = \App::make('dompdf.wrapper');
		// $pdf->loadHTML($this->convert_customer_data_to_html());
		// return$pdf->stream();
	}

}
