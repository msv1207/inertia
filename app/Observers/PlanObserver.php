<?php

namespace App\Observers;
use App\Models\Plan;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class PlanObserver
{

    /**
     * Handle the plan "created" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function creating(Plan $plan)
    {

//        $plan->slug = \Str::slug($plan->name);
    }

    /**
     * Handle the plan "created" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function created(Plan $plan)
    {
        $event_id=Event::create([
            'name' => $plan->name,
            'description' => $plan->description,
            'startDateTime' => Carbon::parse($plan->started_at),
            'endDateTime' => Carbon::parse($plan->ended_at),
        ])->id;

        $plan->event_id=$event_id;
        $plan->save();

    }

    /**
     * Handle the plan "updated" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function updated(Plan $plan)
    {
        $event = Event::find($plan->event_id);

        $event->update([
            'name' => $plan->name,
            'description' => $plan->description,
            'startDateTime' => Carbon::parse($plan->started_at),
            'endDateTime' => Carbon::parse($plan->ended_at),
        ]);
    }

    /**
     * Handle the plan "deleted" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function deleted(Plan $plan)
    {
        $event = Event::find($plan->event_id);

        $event->delete();
    }

    /**
     * Handle the plan "restored" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function restored(Plan $plan)
    {

    }

    /**
     * Handle the plan "force deleted" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function forceDeleted(Plan $plan)
    {

    }
}