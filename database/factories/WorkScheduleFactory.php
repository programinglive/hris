<?php

namespace Database\Factories;

use App\Models\WorkSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkScheduleFactory extends Factory
{
    protected $model = WorkSchedule::class;

    public function definition(): array
    {
        return [
            'name' => fake()->jobTitle(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'company_id' => fake()->randomNumber(),
            'is_active' => true,
        ];
    }
}
