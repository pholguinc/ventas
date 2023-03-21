<?php

namespace Database\Factories;

use App\Models\Customer;
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
        $total = $this->faker->randomFloat(2,0,5000);
        $discounrRand = $this->faker->randomElement([0,2,8,10]);
        $dto = intval(($total* $discounrRand)/100);

        return [
            'total' => $total,
            'items'=> $this->faker->numberBetween(0,10),
            'discount' => $dto,
            'cash' => $this->faker->randomFloat(2,0,100),
            'change' => $this->faker->numberBetween(0,8),
            'status' => $this->faker->randomElement( ['PAID', 'PENDING', 'CANCELLED']),
            'user_id' => User::all()->random()->id,
            //'customer_id' => Customer::all()->random()->id,
        ];
    }
}
