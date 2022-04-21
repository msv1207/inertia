<?php

namespace App\Http\Controllers\Post;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainCategoryController extends Controller
{
    public function store(Request $request)
    {
        SubCategory::create(['title'=>$request->mainCategoryTitle]);

        return (new PostController)->index();
    }

    public function update($id, Request $request)
    {
        $mainCategory = SubCategory::find($id);
        $mainCategory->update(['title'=>$request->title]);

        $mainCategory->save();

        return (new PostController)->index();
    }
}
