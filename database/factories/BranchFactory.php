<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = Company::first();

        return [
            'company_id' => $company->id,
            'code' => $this->faker->unique()->ean8,
            'name' => $this->faker->name,
            'type' => 'branch',
            'company_code' => $company->code,
            'company_name' => $company->name,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
