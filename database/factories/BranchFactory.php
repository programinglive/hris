<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'B001',
            'name' => fake()->word(),
            'phone' => fake()->phoneNumber,
            'address' => fake()->streetAddress,
            'type' => fake()->randomElement(['branch', 'partner']),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
