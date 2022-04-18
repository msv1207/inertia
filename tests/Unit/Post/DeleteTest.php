<?php

namespace Tests\Unit\Post;

use App\Models\Post;
use \Tests\Support\UnitTester;

class DeleteTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {

    }

    // tests
    public function testSomeFeature()
    {
        $post = $this->tester->have(Post::class, ['title' => 'cfcfcf']);
        $post=Post::find($post->id);
        $post->delete();
//        $this->tester->dontSee('posts', ['title' => 'cfcfcf']);
//        $this->tester->cantSeeRecord('posts', ['title' => 'cfcfcf']);

    }
}
