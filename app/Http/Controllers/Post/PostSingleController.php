<?php

namespace App\Http\Controllers\Post;

//use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostSingleController extends Controller
{
    public function store(Request $request)
    {
        Post::create(['title'=>$request->title, 'description'=>$request->description, 'category_id'=>$request->categoryId]);

        return (new PostController)->index();
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;

        $post->save();

        return (new PostController)->index();
    }
}
