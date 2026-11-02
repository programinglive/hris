<?php

namespace Database\Factories;

use Database\Factories\Concerns\HasFaker;
use App\Models\Company;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveTypeFactory extends Factory
{
    use HasFaker;

    protected $model = LeaveType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker()->unique()->word(),
            'code' => $this->faker()->unique()->word(),
            'description' => $this->faker()->sentence(),
            'requires_approval' => $this->faker()->boolean(),
            'is_paid' => $this->faker()->boolean(),
            'default_days_per_year' => $this->faker()->numberBetween(1, 30),
            'is_active' => $this->faker()->boolean(),
            'company_id' => Company::factory(),
        ];
    }
}
