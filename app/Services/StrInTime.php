<?php

namespace App\Services;
use Carbon\Carbon;

class StrInTime
{
    public static function strToDate($date)
    {

        $date1=Carbon::parse($date[0])->format('Y-m-d H:i:s');
        $date2=Carbon::parse($date[1])->format('Y-m-d H:i:s');
        return compact( 'date1', 'date2' );
    }
}
