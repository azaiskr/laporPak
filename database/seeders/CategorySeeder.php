<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category' => 'Jalan Rusak'],
            ['category' => 'Tumpukan Sampah'],
            ['category' => 'Fasilitas Publik Tidak Berfungsi/Berkerja Baik'],
            ['category' => 'Lainnya'],
        ];

        foreach ($categories as $category){
            Category::create($category);
        }
    }
}
