<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'code'=> $this->faker->numberBetween(0,8),
            'cost' => $this->faker->randomFloat(2,0,100),
            'price' => $this->faker->randomFloat(2,0,100),
            'stock' => $this->faker->numberBetween(0,8),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
