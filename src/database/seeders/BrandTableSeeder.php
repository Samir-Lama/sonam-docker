<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    public function run(): void
    {
        Brand::create([
            "name" => "Nike"
        ]);
    }
}
