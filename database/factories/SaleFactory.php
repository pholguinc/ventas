<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomFloat(2,0,100),
            'items'=> $this->faker->numberBetween(0,8),
            'cash' => $this->faker->randomFloat(2,0,100),
            'price' => $this->faker->randomFloat(2,0,100),
            'change' => $this->faker->numberBetween(0,8),
            'status' => $this->faker->randomElement( ['PAID', 'PENDING', 'CANCELLED'])->default('PAID'),
            'user_id' => User::all()->random()->id,
        ];
    }
}
