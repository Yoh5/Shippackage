<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationCountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => $this->faker->country,
            'address' => $this->faker->address,
            'email' => $this->faker->safeEmail(),
            'PhoneNumber' => $this->faker->phoneNumber(),
            'email_verified_at' => now()
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
