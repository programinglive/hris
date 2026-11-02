<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WorkShift;
use Illuminate\Database\Eloquent\Factories\Factory;

use function fake;

class WorkShiftFactory extends Factory
{
    protected $model = WorkShift::class;

    public function definition(): array
    {
        return [
            'name' => fake()->jobTitle,
            'start_time' => fake()->time('H:i:s'),
            'end_time' => fake()->time('H:i:s'),
            'code' => 'WSH'.str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'company_id' => Company::factory(),
            'is_active' => true,
        ];
    }
}
