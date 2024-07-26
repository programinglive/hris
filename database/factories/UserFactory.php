<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Configures the factory and creates a new user after creation.
     *
     * This function is called after creating a new user instance.
     * It creates a new company using the `Company::factory()->create()` method.
     * Then, it creates a new branch using the `Branch::factory()->create()` method with the `company_id`
     * set to the id of the created company.
     * Finally, it creates a new `UserDetail` instance with the `company_id`,
     * `branch_id`, `user_id`, and `first_name` properties set accordingly.
     *
     * @return Factory|UserFactory The configured factory instance.
     */
    public function configure(): Factory|UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $company = Company::factory()->create();
            UserDetail::create([
                'company_id' => $company->id,
                'branch_id' => Branch::factory()->create([
                    'company_id' => $company->id
                ])->id,
                'user_id' => $user->id,
                'first_name' => $user->name,
            ]);
        });
    }
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
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
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
}