<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'company_id' => Company::factory(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->userDetails()->create([
                'user_id' => $user->id,
                'employee_code' => 'EMP'.$this->faker->unique()->numerify('######'),
                'status' => 'active',
                'company_id' => $user->company_id,
                'join_date' => now(),
                'branch_id' => $user->branch_id ?? null,
                'department_id' => $user->department_id ?? null,
                'division_id' => null,
                'sub_division_id' => null,
                'level_id' => null,
                'position_id' => $user->position_id ?? null,
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
            ]);
        });
    }
}
