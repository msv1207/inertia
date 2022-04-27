<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreeRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;

class TreeController extends Controller
{
    public function store(StoreTreeRequest $request)
    {
        $sub_category_id = SubCategory::firstOrCreate(['title' => $request->mainCategoryTitle])->id;
        $category_id = Category::firstOrCreate(['title' => $request->categoryTitle, 'sub_category_id' => $sub_category_id])->id;
        Post::Create(['title' => $request->title,
            'description'=> $request->description,
            'category_id' => $category_id,
        ]);

        return (new PostController)->index();
    }
}
