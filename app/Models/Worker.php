<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'role',
        'birth',
        'team_of_people_id',
    ];
    use HasFactory;

    public function teamOfPeople()
    {
        return $this->belongsTo(TeamOfPeople::class);
    }
}
