<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Services\StrInTime;
use App\Models\Plan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class PlanController extends Controller
{
    public function index()
    {

        $plans = Plan::all();


        return Inertia::render('Plan/Index', [
            'plans' => $plans,
        ]);

    }

    public function store(Request $request)
    {

        $date=StrInTime::strToDate($request->calendar);

        Plan::create([
                'name'=>$request->title,
            'description' => $request->description,
            'started_at'=> $date['date1'],
            'ended_at'=> $date['date2']
        ]);
        return $this->index();

    }

    public function edit(Plan $plan)
    {
//        dd($plan->id);
        return Inertia::render('Plan/Edit', [
            'plan' => $plan->id,

        ]);
    }

    public function update(Plan $plan, Request $request)
    {
//        dd($request->all());
        $date=StrInTime::strToDate($request->calendar);
//dd($date);
        $plan->update([
            'name' => $request->title,
            'description'=>$request->description,
            'started_at'=>$date['date1'],
            'ended_at'=>$date['date2']
        ]);
//        $post->category()->get()[0] ->sub_category()
//            ->update(['title' => $request->mainCategoryTitle]);
//        $post->update($request->all());

        return $this->index();
    }

    public function destroy(Plan $plan)
    {

        $plan->delete();

        return $this->index();
    }
}
