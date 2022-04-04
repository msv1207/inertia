<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamOfPeople extends Model
{
    protected $fillable = [
        'name',
        'departments_id',
    ];
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
