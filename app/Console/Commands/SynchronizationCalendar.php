<?php

namespace App\Console\Commands;

use App\Models\Plan;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class SynchronizationCalendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronization:calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

       $events= Event::get();

       foreach ($events as $event) {
           Plan::updateOrCreate(
               ['name' => $event->name,
                   'description'=>$event->description,
                   'started_at'=>$event->startDateTime,
                   'ended_at'=>$event->endDateTime
               ],
               [    'name' => $event->name,
                   'description'=>$event->description,
                   'started_at'=>$event->startDateTime,
                   'ended_at'=>$event->endDateTime
               ]
           );
       }
    }
}
