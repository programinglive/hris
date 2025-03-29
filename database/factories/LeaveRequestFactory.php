<?php

namespace Database\Factories;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LeaveRequestFactory extends Factory
{
    protected $model = LeaveRequest::class;

    public function definition(): array
    {
        $startDate = Carbon::now()->addDays(rand(1, 30));
        $endDate = $startDate->copy()->addDays(rand(1, 5));
        
        return [
            'user_id' => User::factory(),
            'leave_type_id' => LeaveType::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $startDate->diffInDays($endDate) + 1,
            'reason' => $this->faker->sentence,
            'status' => 'pending',
        ];
    }
}
