<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Services\DateForUser;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = Plan::all();
        $plans = DateForUser::index($data);

        $pdf = PDF::loadView('myPDF', ['all_items'=>$plans]);

        return  $pdf->download('plans.pdf');
    }
}
