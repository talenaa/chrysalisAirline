<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AirplaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date" => fake()->date(),
            "departure" => fake()->country(),
            "arrival" => fake()->country(),
            "airplane_id" => fake()->randomDigitNot(0),
            "aviable" => fake()->boolean()
        ];
    }
}
