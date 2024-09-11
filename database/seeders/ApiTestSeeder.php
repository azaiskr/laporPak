<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create a personal access token for the user
        PersonalAccessToken::create([
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class,
            'name' => 'Default API Key',
            'token' => hash('sha256', 'johndoeapikey'),
            'abilities' => json_encode(['*']),
            'last_used_at' => Carbon::now()->subDays(2),
            'expires_at' => Carbon::now()->addDays(30),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Faker instance for generating random data
        $faker = Faker::create();

        // Get all user IDs including the newly created user
        $userIds = User::pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $statusIds = DB::table('statuses')->pluck('id')->toArray();

        // Seed reports and ratings
        foreach (range(1, 10) as $index) {
            $reportId = DB::table('reports')->insertGetId([
                'user_id' => $faker->randomElement($userIds),
                'title' => $faker->sentence,
                'category_id' => $faker->randomElement($categoryIds),
                'description' => $faker->paragraph,
                'media' => $faker->imageUrl,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'status_id' => $faker->randomElement($statusIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Get a list of all users except the one who created the report
            $remainingUserIds = array_diff($userIds, [$reportId]);

            // Seed report ratings
            foreach ($remainingUserIds as $userId) {
                DB::table('report_ratings')->updateOrInsert([
                    'laporan_id' => $reportId,
                    'user_id' => $userId,
                ], [
                    'rating_type' => $faker->randomElement(['up', 'down']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
