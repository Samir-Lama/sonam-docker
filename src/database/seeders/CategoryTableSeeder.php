<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        Category::insert(array_map(function ($category) {
            return array_merge($category, [
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }, [
            [
                "brand_id" => 1,
                "name" => "Men's shoes",
            ],
            [
                "brand_id" => 1,
                "name" => "Women's shoes",
            ],
            [
                "brand_id" => 1,
                "name" => "Series A",
            ],
            [
                "brand_id" => 1,
                "name" => "Series B",
            ],
        ]));
    }
}
