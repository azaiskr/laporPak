<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }


        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }
    }
}
