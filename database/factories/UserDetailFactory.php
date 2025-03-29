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
        $statuses = ['Active', 'On Leave', 'Probation', 'Terminated'];
        $departments = ['HR', 'Finance', 'Marketing', 'Operations', 'IT', 'Sales', 'Customer Service', 'Production'];
        $positions = ['Manager', 'Supervisor', 'Specialist', 'Coordinator', 'Officer', 'Assistant', 'Director', 'VP'];
        $genders = ['Male', 'Female'];
        $maritalStatuses = ['Single', 'Married', 'Divorced', 'Widowed'];
        
        $department = $this->faker->randomElement($departments);
        $position = $this->faker->randomElement($positions);
        
        return [
            'user_id' => User::factory(),
            'employee_id' => 'EMP' . $this->faker->unique()->numerify('######'),
            'phone' => '+62' . $this->faker->numerify('##########'),
            'address' => $this->faker->address(),
            'position' => $position . ' ' . $department,
            'department' => $department,
            'join_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'status' => $this->faker->randomElement($statuses),
            'gender' => $this->faker->randomElement($genders),
            'birth_date' => $this->faker->dateTimeBetween('-50 years', '-20 years'),
            'marital_status' => $this->faker->randomElement($maritalStatuses),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_relationship' => $this->faker->randomElement(['Spouse', 'Parent', 'Sibling', 'Friend', 'Child']),
            'emergency_contact_phone' => '+62' . $this->faker->numerify('##########'),
            'profile_image' => null,
            'company_id' => Company::factory(),
            'branch_id' => Branch::factory(),
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
