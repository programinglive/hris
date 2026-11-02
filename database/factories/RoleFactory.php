<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word,
            'display_name' => fake()->sentence,
            'description' => fake()->paragraph,
            'is_system' => false,
            'slug' => fake()->unique()->slug,
            'company_id' => Company::factory(),
        ];
    }

    /**
     * Create a system role.
     */
    public function system(): static
    {
        return $this->state([
            'is_system' => true,
        ]);
    }
}
