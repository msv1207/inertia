<?php

namespace App\Services;

use Carbon\Carbon;

class DateForUser
{
    public static function index($plans)
    {
        foreach ($plans as $plan) {
            $plan->started_at = Carbon::parse($plan->started_at)->format('g:i a l jS F Y');
            $plan->ended_at = Carbon::parse($plan->started_at)->format('g:i a l jS F Y');
        }

        return  $plans;
    }
}
