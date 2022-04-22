<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Elasticquent\ElasticquentTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

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
