<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ApiReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->toArray(); // Get all user IDs
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $statusIds = DB::table('statuses')->pluck('id')->toArray();

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
