<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Defect>
 */
class DefectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => $this->faker->sentence(rand(1,2), false),
            'pattern' => $this->faker->sentence(rand(1,2), false),
            'serial' => $this->faker->sentence(rand(1,2), false),
            'defect' => $this->faker->sentence(rand(1,2), false),
            'area' => $this->faker->sentence(rand(1,2), false),
            'mold' => $this->faker->sentence(rand(1,2), false),
            'position' => $this->faker->sentence(rand(1,2), false),
            'image' => '',
            'status' => $this->faker->sentence(rand(1,2), false),
        ];
    }
}