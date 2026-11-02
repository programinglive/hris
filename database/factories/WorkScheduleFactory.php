<?php

namespace Database\Factories;

use Database\Factories\Concerns\HasFaker;
use App\Models\WorkSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkScheduleFactory extends Factory
{
    use HasFaker;

    protected $model = WorkSchedule::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker()->jobTitle(),
            'start_time' => $this->faker()->time(),
            'end_time' => $this->faker()->time(),
            'company_id' => $this->faker()->randomNumber(),
            'is_active' => true,
        ];
    }
}
