<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveTypeFactory extends Factory
{
    protected $model = LeaveType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->word(),
            'description' => fake()->sentence(),
            'requires_approval' => fake()->boolean(),
            'is_paid' => fake()->boolean(),
            'default_days_per_year' => fake()->numberBetween(1, 30),
            'is_active' => fake()->boolean(),
            'company_id' => Company::factory(),
        ];
    }
}
