<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreeRequest;
use App\Http\Requests\UpdateTreeRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Tree');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTreeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post= Post::find($id);
//       dd($post->category()->get()[0]->title);
        return Inertia::render('Post/Test', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'categoryTitle' => $post->category()->get()[0]->title,
                'mainCategoryTitle' => $post->category()->get()[0]->sub_category()->get()[0]->title,
                'description' => $post->description
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTreeRequest  $request
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        Route::put('/test', function (Request $request, Post $post){
//dd($request->mainCategoryTitle);
        $post= Post::find($id);

//        $post->c
        $tet=$post->category()->get()[0];
        $tet2=$post->category()->get()[0]->sub_category()->get()[0];
        if($tet2->title==$request->mainCategoryTitle)
        {
            $sub_category_id=($post->category()->get()[0]->sub_category()->get()[0]->id);

        }
        else {
            $sub_category_id=SubCategory::create(['title' => $request->mainCategoryTitle])->id;

        }
        if($tet->title==$request->categoryTitle)
        {}
        else {
            $category=Category::query();
            $tet = $category->create(
                ['title' => $request->categoryTitle, 'sub_category_id' => $sub_category_id]
            );
        }
//       dd($tt->id);
//        dd($category->get());
//            $category = new Category(['title' => $request->categoryTitle]);
//$category->save();

            Post::create(['title' => $request->title,
                'description'=> $request->description,
                'category_id' => $tet->id
            ])->save();
            return Redirect::route('posts.index');


//        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
