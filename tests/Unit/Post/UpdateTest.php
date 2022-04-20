<?php

namespace Tests\Unit\Post;

use App\Models\Post;
use Tests\Support\UnitTester;

class UpdateTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $post = $this->tester->have(Post::class, ['title' => 'cfcfcf']);
        // access model
//        dd($id);
        $post = Post::find($post->id);
        //$post->update(['title'=>])
        $post->title = 'bill';
        $post->save();
//        dd($post);
//        $this->assertEquals('bill', $post->getName());
        // verify data was saved using framework methods
        $this->tester->seeRecord('posts', ['title' => 'bill']);
//        $this->tester->dontSeeRecord('posts', ['title' => 'cfcfcf']);
    }
}
