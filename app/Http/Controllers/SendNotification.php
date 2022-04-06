<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class SendNotification extends Controller
{
    public function index()
    {
        $notify = Plan::find(1);
        $notify->notify(new \App\Notifications\SendNotification('njnjn'));
    }
}
