<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $result =Post::all()->filter(function ($post) use ($request) {
             if($post->tag==$request->tag)
            return $post;
        });
        return Inertia::render('Post/Index', [
            'searchRes' => $result,
        ]);
    }
}
