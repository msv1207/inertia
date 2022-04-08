<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct()
    {
Tag::reindex();
        Post::reindex();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        cache()->remember('posts', 200, function () {
            return Post::latest()->paginate(200);
        });

        $category =SubCategory::with('categories.posts')->get();
        $posts = Cache::get('posts');

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
    public function store(PostCreateRequest $request)
    {
        $mainCat = SubCategory::create(['title' => $request->mainCategoryTittle]);
        $cat = $mainCat->categories()->save(Category::create(['title' => $request->categoryTitle]));
        $cat->posts()->save(Post::create(['title' => $request->title,
            'description'=> $request->description, ]));
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
                'mainCategoryTitle' => $post->category()->get()[0]->title,
                'categoryTitle' => $post->category()->get()[0]->sub_category()->get()[0]->title,
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
