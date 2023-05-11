<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::create([
            "brand_id" => 1,
            "name" => "Nike Air Max",
            "sku" => "NIK-001",
            "description" => "The Nike Air Max goes bigger than ever before with Nike's taller Air unit yet, offering more air underfoot for unimaginable, all-day comfort. Has Air Max gone too far? We hope so.",
            "quantity" => 10,
            "price" => 200.00,
            "discount" => null,
        ]);

        $product->categories()->attach([1, 2]);

        $product = Product::create([
            "brand_id" => 1,
            "name" => "Nike Pegasus",
            "sku" => "NIK-002",
            "description" => "The Nike Pegasus is an iconic sneaker from Nike. The upper features a classic suede upper with a mesh upper and a Nike Air unit. The midsole is made of a lightweight foam and the outsole is constructed of a lightweight foam.",
            "quantity" => 10,
            "price" => 150.00,
            "discount" => null,
        ]);

        $product->categories()->attach([1, 2]);

        $product = Product::create([
            "brand_id" => 1,
            "name" => "Nike GK",
            "sku" => "NIK-003",
            "description" => "The Nike GK is a classic sneaker from Nike. The upper features a classic suede upper with a mesh upper and a Nike Air unit. The midsole is made of a lightweight foam and the outsole is constructed of a lightweight foam.",
            "quantity" => 10,
            "price" => 100.00,
            "discount" => null,
        ]);

        $product->categories()->attach([1, 2]);
    }
}
