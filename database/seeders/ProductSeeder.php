<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory()->count(5)->create();
        // DB::table('products')->insert(
        //     [
        //         'title' => 'Nordic Chair',
        //         'description' => 'Nordic Chair is the best chair.',
        //         'product_img' => 'image',
        //         'category' => 3,
        //         'quantity' => 30,
        //         'price' => 350,
        //         'discount_price' => 300,
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
