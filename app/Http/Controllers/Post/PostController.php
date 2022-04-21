<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;

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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
//        dd($request->all());
        Post::create(['title'=>$request->title, 'description'=>$request->description, 'category_id'=>$request->categoryId]);

        return (new PostController)->index();
    }

    public function update($id, PostUpdateRequest $request)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;

        $post->save();

        return (new PostController)->index();
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
