<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use ElasticquentTrait;

    protected $fillable = ['title', 'body', 'tags'];

    protected ?array $mappingProperties = [
        'title' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'body' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'tags' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
    ];
}
