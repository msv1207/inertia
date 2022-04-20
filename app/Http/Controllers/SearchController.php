<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Post;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $result = Post::searchByQuery(['match' => ['title' => $request->search]]);

        return Inertia::render('Post/Index', [
        'searchRes' =>$result,
    ]);
    }
}
