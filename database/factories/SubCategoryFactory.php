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
        return [
            'code' => $this->faker->ean8,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}