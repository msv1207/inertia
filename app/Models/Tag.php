<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use ElasticquentTrait, HasFactory;

    protected $fillable = [
        'title',
        'post_id',
    ];
    protected ?array $mappingProperties = [
        'title' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
    ];

    public function getIndexName()
    {
        return 'tags';
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
