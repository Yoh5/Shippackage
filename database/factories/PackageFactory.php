<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trackingNumber' => $this->faker->unique()->word,
            'weight' => $this->faker->randomFloat(2, 0.1, 100),
            'height' => $this->faker->randomFloat(2, 1, 10),
            'width' => $this->faker->randomFloat(2, 1, 10),
            'length' => $this->faker->randomFloat(2, 1, 10),
            'value' => $this->faker->randomFloat(2, 10, 1000),
            'type' => $this->faker->randomElement(['express', 'normal']),
            'arrivalDate' => $this->faker->date,
        ];
    }
}
