<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(TagRequest $request, $id)
    {
        Tag::updateOrCreate(
            ['title' => $request->tag],
            ['post_id' => $id]
        );

     return 'updated';
    }
}
