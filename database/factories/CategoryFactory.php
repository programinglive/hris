<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyId = Company::factory()->create()->id;

        return [
            'company_id' => $companyId,
            'branch_id' => Branch::factory()->create([
                'company_id' => $companyId,
            ])->id,
            'code' => $this->faker->ean8,
            'name' => $this->faker->name,
        ];
    }
}
