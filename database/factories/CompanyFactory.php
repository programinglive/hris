<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Models\WorkSchedule;
use App\Models\WorkShift;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use function fake;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyName = fake()->company();
        $companyCode = Str::upper(Str::slug($companyName, '-'));

        return [
            'name' => $companyName,
            'code' => $companyCode,
            'legal_name' => fake()->company().' '.fake()->companySuffix(),
            'tax_id' => fake()->numerify('##-#######'),
            'registration_number' => fake()->numerify('REG-########'),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'website' => fake()->url(),
            'description' => fake()->paragraph(),
            'is_active' => fake()->boolean(80), // 80% chance of being active
            'owner_id' => null, // Will be set when creating first user
        ];
    }

    /**
     * Configure company with initial data
     */
    public function configureInitialData(): static
    {
        return $this->afterCreating(function (Company $company) {
            // Create default work schedule
            WorkSchedule::create([
                'name' => 'Default Work Schedule',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'grace_period_minutes' => 15,
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'is_default' => true,
                'company_id' => $company->id,
                'is_active' => true,
            ]);

            // Create work shifts
            WorkShift::create([
                'name' => 'Morning Shift',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'code' => 'WSH'.str_pad($company->id.'1', 4, '0', STR_PAD_LEFT),
                'company_id' => $company->id,
                'is_active' => true,
            ]);

            WorkShift::create([
                'name' => 'Evening Shift',
                'start_time' => '17:00:00',
                'end_time' => '23:00:00',
                'code' => 'WSH'.str_pad($company->id.'2', 4, '0', STR_PAD_LEFT),
                'company_id' => $company->id,
                'is_active' => true,
            ]);

            // Create default roles
            $roles = [
                'admin' => [
                    'name' => 'admin',
                    'display_name' => 'Administrator',
                    'description' => 'Full access to all company features',
                ],
                'manager' => [
                    'name' => 'manager',
                    'display_name' => 'Manager',
                    'description' => 'Manage employees and departments',
                ],
                'employee' => [
                    'name' => 'employee',
                    'display_name' => 'Employee',
                    'description' => 'Basic employee access',
                ],
            ];

            foreach ($roles as $role) {
                Role::create([
                    'name' => $role['name'],
                    'display_name' => $role['display_name'],
                    'description' => $role['description'],
                    'company_id' => $company->id,
                ]);
            }
        });
    }

    /**
     * Indicate that the company is active.
     *
     * @return static
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    /**
     * Indicate that the company is inactive.
     *
     * @return static
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }

    /**
     * Attach an owning user after the company is created.
     *
     * `owner_id` is nullable at insert time because the owner is created
     * afterwards, so it is assigned in a second step.
     */
    public function withOwner(?User $owner = null): static
    {
        return $this->afterCreating(function (Company $company) use ($owner) {
            $owner ??= User::factory()->create();

            $company->forceFill(['owner_id' => $owner->id])->save();
        });
    }
}
