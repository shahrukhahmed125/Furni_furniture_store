<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                'name' => 'Chair',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('categories')->insert(
            [
                'name' => 'Table',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('categories')->insert(
            [
                'name' => 'Sofas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
