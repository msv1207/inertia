<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Post;

class TagController extends Controller
{
    public function index(TagRequest $request, $id)
    {
        $post = Post::find($id);
        $post->tag = $request->tag;
        $post->save();

        return (new PostController)->index();
    }
}
