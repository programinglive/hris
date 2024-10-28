<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'C001',
            'name' => fake()->company(),
            'npwp' => fake()->regexify('[0-9]{15}'),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}