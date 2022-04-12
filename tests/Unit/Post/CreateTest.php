<?php

namespace Tests\Unit\Post;

use Carbon\Carbon;
use Faker\Factory;
use Tests\Support\UnitTester;

class CreateTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $faker = Factory::create('App\Post');
        $title = $faker->sentence();
        $description = implode($faker->paragraphs(5));
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $this->tester->haveRecord(
            'posts',
            ['title' => $title, 'description' => $description, 'created_at' => $created_at, 'updated_at' => $updated_at]
        );

        $this->tester->seeRecord(
            'posts',
            ['title' => $title, 'description' => $description, 'created_at' => $created_at, 'updated_at' => $updated_at]
        );
    }
}
