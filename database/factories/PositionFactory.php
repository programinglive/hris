<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Level;
use App\Models\SubDivision;
use App\Models\Company;
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
        $minSalary = $this->faker->numberBetween(3000, 8000);
        
        return [
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'level_id' => Level::factory(),
            'sub_division_id' => SubDivision::factory(),
            'company_id' => Company::factory(),
            'min_salary' => $minSalary,
            'max_salary' => $minSalary + $this->faker->numberBetween(1000, 5000),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
