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
        $plans=[];
        $i=0;
       foreach ($events as $event) {
           $plans[$i]['event_id']=$event->id;
           $plans[$i]['name']=$event->name;
           $plans[$i]['description']=$event->description;
           $plans[$i]['started_at']=$event->startDateTime->toDateTimeString();
           $plans[$i]['ended_at']=$event->endDateTime->toDateTimeString();

           $i++;
       }
//       dd(json_encode( $plans));
//        $events=array($events);
//        var_dump($events);
//        die();
//        dd( $plans[5]['ended_at']->toDateTimeString());
           Plan::upsert(
              $plans,
               [
                   'event_id',
                   'name',
                   'description',
                   'started_at',
                   'ended_at'

               ],
               [
                   'event_id',
                   'name',
                   'description',
                   'started_at',
                   'ended_at'
               ]

           );

    }
}
