<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Worker;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $sub_category_id = SubCategory::firstOrCreate(['title' => $request->mainCategoryTitle])->id;
        $category_id = Category::firstOrCreate(['title' => $request->categoryTitle, 'sub_category_id' => $sub_category_id])->id;
        Post::firstOrCreate(['title' => $request->title,
            'description'=> $request->description,
            'category_id' => $category_id,
        ]);

        return 'success';
    }

    public function update(Request $request)
    {
        $posts = Post::find($request->id);
        $posts->category_id = $request->category_id;
        $posts->save();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
