<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'company_id' => Company::first()->id,
            'branch_id' => Branch::first()->id,
            'code' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->company(),
            'company_code' => Company::first()->code,
            'company_name' => Company::first()->name,
            'branch_code' => Branch::first()->code,
            'branch_name' => Branch::first()->name,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
