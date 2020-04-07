<?php

namespace App\Http\Controllers\Admin;

use App\Ternak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domPDF;
use DNS1D;

class BarcodeController extends Controller
{
    public function index(Request $request)
    {
    	$ternak = Ternak::latest()->paginate(15); 
        // $ternak = Ternak::latest()->get(); 
	    $no = 1; 

        return view('admin.barcode')->with('ternak', $ternak)->with('no', $no);
    }

    public function generatePdf()
    {
        $ternak = Ternak::latest()->get();
        $no = 1;
        $html = '<h2 align="center">SITERNAK - Barcode Necktag</h2>';
        $html .= '<table>';
        $html .= '<tr>';

        foreach($ternak as $data){

            $html .= '<td>'.$no.'</td>';
            $html .= '<td align="center" style="border: lpx solid #ccc; padding-left: 10px; padding-right: 10px;">'.$data->necktag.'<br>';
            $html .= '<img style="padding: 10px;" src="data:image/png;base64,'.DNS1D::getBarcodePNG($data->necktag, "C128", 2, 40).'" alt="barcode"/>';
            $html .= '<br>'.$data->necktag.'</td>';

            if($no++ %3 == 0){
                $html .= '</tr>';
                $html .= '<tr style="margin-bottom: 10px;">';
            }
        }

        $html .= '</tr>';
        $html .= '</table>';

        $pdf = domPDF::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('SITERNAK-Barcode.pdf');
	}

}
