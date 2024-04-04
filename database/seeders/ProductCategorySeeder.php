<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $categories = [
            'Desktop PCs',
            'Laptop',
            'Monitors',
            'Keyboards',
            'Gaming Mice',
            'Gaming Headphones',
            'Video Cards'
        ];

        foreach ($categories as $category) {
            DB::table('product_category')->insert([
                'name' => $category,
                'description' => $faker->sentence(),
            ]);
        }
    }
}
