<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Division::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a department with valid company_id and branch_id
        $department = Department::factory()->create();
        
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph,
            'department_id' => $department->id,
            'manager_id' => null, // Optional, can be set to User::factory() if needed
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
