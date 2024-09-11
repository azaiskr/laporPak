<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PersonalAccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password'),
        ]);

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
    }
}
