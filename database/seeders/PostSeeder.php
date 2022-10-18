<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for($j = 0; $j < 5; $j++)
        {
            Post::create([
                'title'  => $faker->catchPhrase(),
                'content' => $faker->paragraphs(5, true),
                'categories' => json_encode([rand(1, 10)]),
                'tags' => json_encode([rand(1, 5)])
            ]);
        }
    }
}
