<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Plan extends Model
{
    use HasFactory, Notifiable;

    protected $with = ['calendar'];
    protected $fillable = ['google_id', 'name', 'description', 'allday', 'started_at', 'ended_at', 'event_id'];

    public function routeNotificationForSlack($notification)
    {
        return  env('SLACK_BOT');
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

//    public function getStartedAtAttribute($start)
//    {
//        return $this->asDateTime($start)->setTimezone($this->calendar->timezone);
//    }
//
//    public function getEndedAtAttribute($end)
//    {
//        return $this->asDateTime($end)->setTimezone($this->calendar->timezone);
//    }

    public function getDurationAttribute()
    {
        return $this->started_at->diffForHumans($this->ended_at, true);
    }
}
