<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Level;
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
            'name' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'level_order' => fake()->numberBetween(1, 10),
            'company_id' => Company::factory(),
            'is_active' => fake()->boolean(80),
        ];
    }
}
