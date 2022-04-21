<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        Post::addAllToIndex();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = SubCategory::with('categories.posts')->get();

        return Inertia::render('Post/Index', [
            'categories' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mainCat = SubCategory::create(['title' => $request->mainCategoryTittle]);
        $cat = $mainCat->categories()->save(Category::create(['title' => $request->categoryTitle]));
        $cat->posts()->save(Post::create(['title' => $request->title,
            'description'=> $request->description, ]));

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return Inertia::render('Post/Show', [
            'posts' => [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
    ], ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'mainCategoryTitle' => $post->category->title,
                'categoryTitle' => $post->category->sub_category->title,
                'description' => $post->description,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post
           ->update(['title' => $request->title, 'description'=>$request->description]);
        $post->category
           ->update(['title' => $request->categoryTitle]);
        $post->category->sub_category
            ->update([['title' => $request->mainCategoryTitle]]);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $this->index();
    }
}
