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
            'size' => $this->faker->text,
            'pattern' => $this->faker->text,
            'serial' => $this->faker->text,
            'defect' => $this->faker->text,
            'area' => $this->faker->text,
            'mold' => $this->faker->text,
            'position' => $this->faker->text,
            'image' => '',
            'status' => $this->faker->text,
        ];
    }
}