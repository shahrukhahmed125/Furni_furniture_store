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
        if (!Schema::hasTable('users')) 
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id(); // Creates an unsigned big integer column named 'id'
                $table->string('name');
                $table->string('email')->unique();
                $table->foreignId('user_type')->default(3)->constrained('roles'); // Creates a foreign key column referencing 'id' column of 'roles' table
                $table->string('phone')->nullable();
                $table->string('address')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('profile_img')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
