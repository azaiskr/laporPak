<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['status' => 'Pending'],
            ['status' => 'Validated'],
            ['status' => 'Invalid'],
            ['status' => 'Rejected'],
        ];

        foreach ($statuses as $status){
            Status::create($status);
        }
    }
}
