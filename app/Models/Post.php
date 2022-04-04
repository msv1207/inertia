<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use ElasticquentTrait, Notifiable;

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    protected $fillable = [
    'title',
    'description',
        'category_id',
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

    use HasFactory;
}
