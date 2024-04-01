<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert(
            [
                'blog_id' =>  2,
                'user_id' =>  2,
                'content' =>  "This is the best blog.",
                'likes' =>  12,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('comments')->insert(
            [
                'blog_id' =>  2,
                'user_id' =>  2,
                'content' =>  "You wrote everything.",
                'likes' =>  5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
