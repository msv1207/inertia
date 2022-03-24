<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i=0; $i<50; $i++) {
            Article::create([
                'title' => $faker->sentence(3),
                'body' => $faker->paragraph(6),
                'tags' => join(',', $faker->words(4))
            ]);
        }
    }
}
