<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyId = Company::factory()->create()->id;
        $branchId = Branch::factory()->create([
            'company_id' => $companyId,
        ])->id;

        $category = Category::factory()->create([
            'company_id' => $companyId,
            'branch_id' => $branchId,
        ]);
        
        return [
            'company_id' => $companyId,
            'branch_id' => $branchId,
            'category_id' => $category->id,
            'category_code' => $category->code,
            'code' => $this->faker->ean8,
            'name' => $this->faker->name,
        ];
    }
}