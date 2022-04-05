<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
        'post_id',
    ];
    use HasFactory;

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
