<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_categories')->insert(
            [
                'name' => 'Furniture Design & Trends',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('blog_categories')->insert(
            [
                'name' => 'DIY Furniture Projects',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('blog_categories')->insert(
            [
                'name' => 'Furniture Maintenance & Care',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
