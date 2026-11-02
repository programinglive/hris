<?php

namespace Database\Factories;

use App\Models\User;
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
        ];
    }

    /**
     * Configure user with initial data
     */
    public function configureInitialData(): static
    {
        return $this->afterCreating(function (User $user) {
            // Create user details only when there is none yet; forCompany() may
            // have created one already and a second row makes hasOne resolve an
            // arbitrary record.
            $user->userDetails()->firstOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $this->faker->phoneNumber(),
                    'address' => $this->faker->address(),
                    'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-20 years'),
                ]
            );

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

            // Deliberately no role assignment here. configureInitialData() is
            // opt-in via ->configureInitialData(), and silently granting the
            // employee role made every factory user look like staff, which
            // broke every list/filter assertion. Tests attach roles explicitly.
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

    /**
     * Place the user in a company.
     *
     * Company membership lives on `user_details`, not `users`; `User::company()`
     * resolves it through `hasOneThrough`. Accepting `company_id` here keeps the
     * intent of `User::factory()->forCompany($company)` readable without
     * pretending the column exists on the users table.
     */
    public function forCompany($company): static
    {
        $companyId = $company instanceof \App\Models\Company ? $company->id : $company;

        return $this->afterCreating(function (User $user) use ($companyId) {
            $details = $user->userDetails;

            if ($details) {
                $details->forceFill(['company_id' => $companyId])->save();
            } else {
                $user->userDetails()->create([
                    'user_id' => $user->id,
                    'company_id' => $companyId,
                    'status' => 'active',
                ]);
            }

            WorkSchedule::where('is_default', true)
                ->where('company_id', $companyId)
                ->get()
                ->each(function ($schedule) use ($user) {
                    $user->workSchedules()->syncWithoutDetaching([
                        $schedule->id => ['effective_date' => now(), 'is_active' => true],
                    ]);
                });
        });
    }
}
