<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ElasticquentTrait;

    protected $fillable = [
    'title',
    'description',
        'category_id'
    ];
    protected ?array $mappingProperties = array(
        'title' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
    );
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
