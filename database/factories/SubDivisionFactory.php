<?php

namespace Database\Factories;

use App\Models\SubDivision;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubDivision>
 */
class SubDivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'SDIV001',
            'name' => 'Sub Division A',
            'description' => fake()->text(100),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
