<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('products')) 
        {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->string('product_img');

                $table->unsignedBigInteger('category'); // Ensure unsigned big integer for foreign key
                $table->foreign('category')->references('id')->on('categories'); // Correct formation of foreign key constraint

                $table->unsignedBigInteger('user_id'); // Add user_id column
                $table->foreign('user_id')->references('id')->on('users'); // Add foreign key constraint for user_id

                $table->string('quantity');
                $table->integer('price');
                $table->integer('discount_price');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
