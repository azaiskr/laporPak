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
            ['status' => 'on_review'],
            ['status' => 'verived'],
            ['status' => 'rejected'],
            ['status' => 'irrelevant'],
        ];

        foreach ($statuses as $status){
            Status::create($status);
        }
    }
}
