<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Division>
 */
class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'DIV001',
            'name' => 'Division '.fake()->word,
            'description' => fake()->text(100),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
