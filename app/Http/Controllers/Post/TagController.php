<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\TagRequest;
use App\Models\Post;
use App\Http\Controllers\Controller;

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
