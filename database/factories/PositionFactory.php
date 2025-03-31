<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph,
            'company_id' => Company::factory(),
            'department_id' => Department::factory(),
            'division_id' => Division::factory(),
            'sub_division_id' => SubDivision::factory(),
            'level_id' => Level::factory(),
            'is_active' => true,
        ];
    }
}
