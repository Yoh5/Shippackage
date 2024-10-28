<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'package_id' => $this->faker->numberBetween(1, 10),
            'shippingType' => $this->faker->randomElement(['boat', 'airplane', 'vehicule']),
            'company_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'origin_country_id' => $this->faker->numberBetween(1, 10),
            'destination_country_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
