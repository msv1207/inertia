<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = Faker::create('App/Post');
//
//        DB::table('posts')->insert([
//            'title'         => $faker->sentence(),
//            'description'   => implode($faker->paragraphs(5)),
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now(),
//        ]);
//        factory(Post::class, 20)->create();
        Post::factory()->count(20)->create();
//        Category::factory()->count(10)->create();
//       SubCategory::factory()->count(3)->create();

        // Populate users
//        factory(Category::class, 10)->create();
//        factory(SubCategory::class, 3)->create();

        // Get all the roles attaching up to 3 random roles to each user
        $roles = Category::all();

        // Populate the pivot table
        Post::all()->each(function ($user) use ($roles) {
            $user->categories()->attach(
                $roles->random(rand(1, 10))->pluck('id')->toArray()
            );
        });

        $roles = SubCategory::all();

        // Populate the pivot table
        Category::all()->each(function ($user) use ($roles) {
            $user->sub_categories()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
