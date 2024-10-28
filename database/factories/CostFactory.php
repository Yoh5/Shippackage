<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cost' => $this->faker->randomFloat(2, 0, 1000),
            'shippingId' => $this->faker->unique()->numberBetween(1, 1000),
            'status' => $this->faker->boolean ? 1 : 0,
        ];
    }
}
