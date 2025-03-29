<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_id' => function (array $attributes) {
                return $attributes['user_id'] ? User::find($attributes['user_id'])->userDetails->company_id : null;
            },
            'employee_id' => $this->faker->unique()->numberBetween(100000, 999999),
            'join_date' => now()->subDays(rand(1, 365)),
            'status' => 'active',
        ];
    }
}
