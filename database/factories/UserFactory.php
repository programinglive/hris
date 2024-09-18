<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
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
     * Configures the factory to create a new user with associated company,
     * branch, department, division, level, position, and user detail.
     *
     * @return Factory|UserFactory
     */
    public function configure(): Factory|UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $company = Company::first();
            $branch = Branch::factory()->create([
                'company_id' => $company->id
            ]);
            $department = Department::factory()->create([
                'company_id' => $company->id,
                'branch_id' => $branch->id
            ]);
            $division = Division::factory()->create([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'department_id' => $department->id
            ]);
            $level = Level::factory([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'department_id' => $department->id,
                'division_id' => $division->id
            ])->create();
            $position = Position::factory([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'department_id' => $department->id,
                'division_id' => $division->id,
                'level_id' => $level->id
            ])->create();

            UserDetail::create([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'department_id' => $department->id,
                'division_id' => $division->id,
                'level_id' => $level->id,
                'position_id' => $position->id,
                'user_id' => $user->id,
                'code' => $this->faker->unique()->ean8(),
                'first_name' => $user->name,
                'last_name' => $user->faker->lastName(),
                'role' => 'employee',
                'phone' => $this->faker->phoneNumber(),
            ]);

            $user->assignRole('root');
            echo "User [$user->name] created successfully." . PHP_EOL;
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
            'name' => fake()->firstName(),
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