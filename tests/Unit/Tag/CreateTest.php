<?php

namespace Tests\Unit\Tag;

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
        $faker = Factory::create('App\Tag');
        $title = $faker->sentence();
//        $description = implode($faker->paragraphs(5));
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $this->tester->haveRecord(
            'tags',
            ['title' => $title,  'created_at' => $created_at, 'updated_at' => $updated_at]
        );

        $this->tester->seeRecord(
            'tags',
            ['title' => $title,  'created_at' => $created_at, 'updated_at' => $updated_at]
        );
    }
}
