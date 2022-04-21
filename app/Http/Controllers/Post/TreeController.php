<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreeRequest;
use App\Http\Requests\UpdateTreeRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTreeRequest  $request
     * @return \Illuminate\Http\Response
     */
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



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tree $tree)
    {
        //
    }
}
