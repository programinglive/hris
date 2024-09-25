<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\SubDivision;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Level>
 */
class LevelFactory extends Factory
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
            'department_id' => Department::first()->id,
            'division_id' => Division::first()->id,
            'sub_division_id' => SubDivision::first()->id,
            'code' => $this->faker->unique()->word(),
            'name' => $this->faker->word(),
        ];
    }
}
