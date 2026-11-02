<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WorkingCalendar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingCalendar>
 */
class WorkingCalendarFactory extends Factory
{
    protected $model = WorkingCalendar::class;

    public function definition(): array
    {
        $start = now()->startOfYear();

        return [
            'name' => 'Calendar '.fake()->unique()->numerify('####'),
            'start_date' => $start->toDateString(),
            'end_date' => $start->copy()->endOfYear()->toDateString(),
            'description' => fake()->sentence(),
            'is_active' => true,
            'company_id' => Company::factory(),
        ];
    }
}
