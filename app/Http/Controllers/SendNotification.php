<?php

namespace App\Http\Controllers;

use App\Models\Plans;

class SendNotification extends Controller
{
    public function index()
    {
        $notify = Plans::find(1);
        $notify->notify(new \App\Notifications\SendNotification('njnjn'));
    }
}
