<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Worker;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        Post::addAllToIndex();
        $posts = Post::latest()->paginate(20);
        $category=SubCategory::with('categories.posts')->get();
        return Inertia::render('Post/Index', [
            'posts' => $posts,
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
       $mainCat= SubCategory::create(['title' => $request->mainCategoryTittle]);
       $cat= $mainCat->categories()->save(Category::create(['title' => $request->categoryTitle]));
          $cat->posts()->save(Post::create(['title' => $request->title,
            'description'=> $request->description]));

        return Redirect::route('posts.index');
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
            'description' => $post->description
    ]]);

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
                'mainCategoryTitle' => $post->category()->get()[0]->title,
                'categoryTitle' => $post->category()->get()[0]->sub_category()->get()[0]->title,
                'description' => $post->description
            ]
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
        $post->category()->get()[0]
            ->update(['title' => $request->categoryTitle]);
        $post->category()->get()[0] ->sub_category()
            ->update(['title' => $request->mainCategoryTitle]);
        $post->update($request->all());


        return Redirect::route('posts.index');
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

        return Redirect::route('posts.index');
    }
}