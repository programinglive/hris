<?php

namespace Database\Factories;

use Database\Factories\Concerns\HasFaker;
use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubDivisionFactory extends Factory
{
    use HasFaker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubDivision::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker()->unique()->words(3, true),
            'description' => $this->faker()->paragraph,
            'division_id' => Division::factory(),
            'is_active' => true,
        ];
    }
}
