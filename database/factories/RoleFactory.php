<?php

namespace Database\Factories;

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
            'name' => $this->faker->unique()->word,
            'display_name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_system' => false,
            'slug' => $this->faker->unique()->slug,
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
