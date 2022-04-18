<?php

namespace App\Http\Controllers;

//use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostSingleController extends Controller
{
    public function store(Request $request)
    {
        Post::create(['title'=>$request->title, 'description'=>$request->description, 'category_id'=>$request->categoryId]);
        return (new PostController)->index();
    }

    public function update($id, Request $request)
    {

        $post=Post::find($id);

        $post->update(['title'=>$request->title, 'description'=>$request->description]);

        $post->save();
        return (new PostController)->index();

    }
}
