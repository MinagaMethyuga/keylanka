<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category' => 'locksmith-tools',
            'title' => $this->faker->sentence(3),
            'price' => $this->faker->numberBetween(500, 30000), // random price
            'brand' => 'KeyDiy',
            'stock' => $this->faker->numberBetween(0, 200), // random stock
            'description' => $this->faker->paragraph(),
            'image' => 'products/default.png',
        ];
    }
}
