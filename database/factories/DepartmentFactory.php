<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'D001',
            'name' => 'Department '.fake()->name,
            'description' => fake()->text(100),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
