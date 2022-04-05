<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use DateTime;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class PlanController extends Controller
{
    public function index()
    {
//        $m= Carbon::now();
//        dd($m);
        $plans = Plans::latest()->paginate(20);
//        Event::create([
//            'name' => 'A new event',
//            'startDateTime' => Carbon\Carbon::now(),
//            'endDateTime' => Carbon\Carbon::now()->addHour(),
//        ]);
//        dd( Event::get());
//        $plans=Plans::all();
        return Inertia::render('Plan/Index', [
            'plans' => $plans,
        ]);

    }

    public function store(Request $request)
    {
// dump($request);
//        protected $fillable = ['google_id', 'name', 'description', 'allday', 'started_at', 'ended_at'];
//dd($request->all());
$test= DateTime::createFromImmutable('Y-m-d h:i:s', strtotime($request[0]));
//        Event::create([
//            'name' => 'A new event',
//            'startDateTime' => date('Y-m-d h:i:s',strtotime($request[0])),
//            'endDateTime' => date('Y-m-d h:i:s',strtotime($request[1])),
//        ]);
        Plans::create([
                'name'=>'ds',
            'description' => 'ewf',
            'started_at'=>date('Y-m-d h:i:s', $test),
            'ended_at'=>date('Y-m-d h:i:s',strtotime($request[1]))
        ]);
    }

    public function update(Plans $plan, Request $request)
    {
    }
}
