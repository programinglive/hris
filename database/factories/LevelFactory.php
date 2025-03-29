<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Level::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'level_order' => $this->faker->numberBetween(1, 10),
            'company_id' => Company::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
