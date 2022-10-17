<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for($j = 0; $j < 10; $j++)
        {
            User::create([
                'name'  => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => app('hash')->make('password')
            ]);
        }
    }
}
