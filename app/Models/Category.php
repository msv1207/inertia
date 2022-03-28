<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'sub_category_id'
    ];
    use HasFactory;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
