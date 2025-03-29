<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph,
            'company_id' => Company::factory(),
            'branch_id' => Branch::factory(),
            'manager_id' => null, // Optional, can be set to User::factory() if needed
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
