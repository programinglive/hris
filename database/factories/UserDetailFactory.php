<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['active', 'inactive', 'on_leave', 'terminated'];
        
        return [
            'user_id' => null, // Will be set by UserFactory
            'employee_code' => 'EMP' . $this->faker->unique()->numerify('######'),
            'status' => $this->faker->randomElement($statuses),
            'company_id' => null, // Will be set by UserFactory
            'branch_id' => null,
            'department_id' => null,
            'division_id' => null,
            'sub_division_id' => null,
            'level_id' => null,
            'position_id' => null,
            'join_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'exit_date' => null,
            'gender' => null,
            'date_of_birth' => null,
            'place_of_birth' => null,
            'nationality' => null,
            'marital_status' => null,
            'religion' => null,
            'blood_type' => null,
            'emergency_contact_name' => null,
            'emergency_contact_phone' => null,
            'emergency_contact_relationship' => null,
            'address' => null,
            'city' => null,
            'state' => null,
            'postal_code' => null,
            'country' => null,
            'phone' => null,
            'mobile_phone' => null,
            'email' => null,
            'photo' => null,
            'notes' => null,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (UserDetail $userDetail) {
            // Additional configurations if needed
        })->afterCreating(function (UserDetail $userDetail) {
            // Additional actions after creation if needed
        });
    }
}
