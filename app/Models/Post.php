<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'title',
    'description'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
