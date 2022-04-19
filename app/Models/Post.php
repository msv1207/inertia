<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ElasticquentTrait, HasFactory;

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    protected $fillable = [
    'title',
    'description',
        'category_id',
        'tag'
    ];
    protected ?array $mappingProperties = [
        'title' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'description' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
