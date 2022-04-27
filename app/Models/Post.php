<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    protected $fillable = [
    'title',
    'description',
        'category_id',
        'tag',
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->name,
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
