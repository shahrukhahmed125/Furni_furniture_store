<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Nordic Chair',
            'description' => $this->faker->paragraph(),
            'product_img' => $this->faker->imageUrl(),
            'category' => $this->faker->numberBetween(1,3),
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->numberBetween(10, 1000),
            'discount_price' => $this->faker->numberBetween(5, 500),
            'username' => $this->faker->name(),
            'user_type' => $this->faker->numberBetween(1,3),
        ];
    }
}
