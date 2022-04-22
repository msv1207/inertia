<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\SearchRequest;
use App\Models\Post;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $result = Post::search($request->search);

//        $result = Post::searchByQuery(['match' => ['title' => $request->search]]);
dump($result);
        return Inertia::render('Post/Index', [
        'searchRes' =>$result,
    ]);
    }
}
