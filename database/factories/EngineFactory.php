<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EngineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'cylinder' => $this->faker->randomElement([2, 4]),
            'capacity' => $this->faker->randomElement([800, 1000, 1100, 1300, 1400, 1500, 1600, 1800, 2000, 2400, 3000]),
            'horsepower' => $this->faker->randomElement([70, 90, 115, 120, 200])
        ];
    }
}
