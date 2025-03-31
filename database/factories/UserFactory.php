<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Company;
use App\Models\User;
use App\Models\UserBrand;
use App\Models\UserDetail;
use App\Models\UserRole;
use App\Models\WorkSchedule;
use App\Models\WorkShift;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'primary_company_id' => null, // Will be set when creating first user
        ];
    }

    /**
     * Configure user with initial data
     */
    public function configureInitialData(): static
    {
        return $this->afterCreating(function (User $user) {
            // Create user details
            $user->userDetails()->create([
                'user_id' => $user->id,
                'phone' => $this->faker->phoneNumber(),
                'address' => $this->faker->address(),
                'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-20 years'),
            ]);

            // Assign default work schedule
            $defaultSchedule = WorkSchedule::where('is_default', true)
                ->where('company_id', $user->primary_company_id)
                ->first();

            if ($defaultSchedule) {
                $user->workSchedules()->attach($defaultSchedule->id, [
                    'effective_date' => now(),
                    'is_active' => true,
                ]);
            }

            // Assign work shift for today
            $shifts = WorkShift::where('company_id', $user->primary_company_id)
                ->where('is_active', true)
                ->get();

            if ($shifts->count() > 0) {
                $randomShift = $shifts->random();
                $user->workShifts()->attach($randomShift->id, [
                    'date' => now()->toDateString(),
                ]);
            }

            // Assign default role
            $defaultRole = \App\Models\Role::where('name', 'employee')
                ->first();

            if ($defaultRole) {
                $user->roles()->attach($defaultRole->id, [
                    'company_id' => $user->primary_company_id,
                ]);
            }
        });
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
}
