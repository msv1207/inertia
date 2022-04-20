<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanCreateRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Models\Plan;
use App\Services\DateForUser;
use App\Services\StrInTime;
use App\Services\WebNotify;
use Inertia\Inertia;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::paginate(10);
        $plans = DateForUser::index($plans);

        return Inertia::render('Plan/Index', [
            'plans' => $plans,
        ]);
    }

    public function store(PlanCreateRequest $request)
    {
        $title = $request->title;
        auth()->user()->update(['device_token'=>$request->token]);

        $date = StrInTime::strToDate($request->calendar);
//        $date['date1']=date("l dS F Y h:i:s A", $date['date1'] );

        Plan::create([
                'name'=>$request->title,
            'description' => $request->description,
            'started_at'=> $date['date1'],
            'ended_at'=> $date['date2'],
        ]);

        WebNotify::notify($title);

        return $this->index();
    }

    public function edit(Plan $plan)
    {
        return Inertia::render('Plan/Edit', [
            'plan' => $plan->id,
        ]);
    }

    public function update(Plan $plan, PlanUpdateRequest $request)
    {
        $date = StrInTime::strToDate($request->calendar);
        $plan->update([
            'name' => $request->title,
            'description'=>$request->description,
            'started_at'=>$date['date1'],
            'ended_at'=>$date['date2'],
        ]);

        return $this->index();
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return $this->index();
    }
}
