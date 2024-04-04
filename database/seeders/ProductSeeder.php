<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        for ($i = 1; $i <= 200; $i++) {
            DB::table('product_inventory')->insert([
                'quantity' => rand(1, 30),
                'created_at' => now(),
            ]);

            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'description' => 'Description for Product ' . $i,
                'category_id' => rand(1, 7),
                'inventory_id' => $i,
                'price' => $faker->randomNumber(5, true),
                'image' => $faker->imageUrl(800,600),
                'created_at' => now(),
            ]);
        }
    }
}
