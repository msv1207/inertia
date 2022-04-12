<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = Plan::all();
        $all_items = $data->all();
        $pdf = PDF::loadView('myPDF', ['all_items'=>$all_items]);

        return  $pdf->download('plans.pdf');
//          return view('myPDF');
    }
}
