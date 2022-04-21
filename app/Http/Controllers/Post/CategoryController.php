<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        Category::create(['title'=>$request->categoryTitle, 'sub_category_id'=>$request->sub_category_id]);

        return (new PostController)->index();
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);
        $category->update(['title'=>$request->title]);

        $category->save();

        return (new PostController)->index();
    }
}
