<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        
        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        for($j = 0; $j < 10; $j++)
        {
            Category::create([
                'name'  => $faker->vehicleBrand
            ]);
        }
    }
}
