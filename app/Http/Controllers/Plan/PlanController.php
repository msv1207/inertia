<?php

namespace App\Http\Controllers\Plan;

use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
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
        $page = request()->get('page', 1);
        $limit = request()->get('limit', 10);

        Cache::remember('plans' . $page, 100, function() use ($limit){
            return DateForUser::index(DB::table('plans')->paginate($limit));
        });

        return Inertia::render('Plan/Index', [
            'plans' => Cache::get('plans'. $page),
        ]);
    }

    public function store(PlanCreateRequest $request)
    {
        $title = $request->title;
        auth()->user()->update(['device_token'=>$request->token]);

        $date = StrInTime::strToDate($request->calendar);

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
