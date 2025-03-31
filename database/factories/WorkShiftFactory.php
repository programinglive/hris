<?php

namespace Database\Factories;

use App\Models\WorkShift;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkShiftFactory extends Factory
{
    protected $model = WorkShift::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle,
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'code' => 'WSH' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'company_id' => Company::factory(),
            'is_active' => true,
        ];
    }
}
