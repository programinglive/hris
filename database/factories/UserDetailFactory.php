<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'religion' => $this->faker->randomElement(['Islam', 'Protestan', 'Katolik', 'Hindu', 'Budha']),
            'last_education' => $this->faker->sentence(),
            'marriage_status' => $this->faker->randomElement(['single', 'married']),
            'place_of_birth' => $this->faker->address(),
            'date_of_birth' => $this->faker->date('Y-m-'.mt_rand(1, (int) date('t'))),
            'probation_in' => $this->faker->date(),
            'probation_out' => $this->faker->date(),
            'date_in' => $this->faker->date(),
            'date_out' => $this->faker->date(),
            'ktp' => $this->faker->ean8(),
            'npwp' => $this->faker->ean8(),
            'role' => $this->faker->randomElement(['administrator', 'employee']),
            'bank_account' => $this->faker->ean8(),

        ];
    }
}
