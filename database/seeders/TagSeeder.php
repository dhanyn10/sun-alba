<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        for($j = 0; $j < 5; $j++)
        {
            Tag::create([
                'name'  => $faker->vehicleType
            ]);
        }
    }
}
