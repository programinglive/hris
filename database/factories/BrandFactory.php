<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
            'role_id' => Role::first()->id,
            'code' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->company(),
        ];
    }
}